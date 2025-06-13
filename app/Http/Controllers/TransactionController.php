<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;
use App\Models\User;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->middleware('auth');
        $this->transactionService = $transactionService;
    }

    public function createTransactionRecord()
    {
        return view('transactions.create'); // make this blade next
    }

    // Handle transaction submission

    public function createTransaction(int $cardId, float $amount, string $transactionName): Operation
    {
        return Operation::create([
            'card_id' => $cardId,
            'type' => 'debit',          // always debit here
            'value' => $amount,
            'date' => now()->toDateString(),
            'debit_type' => $transactionName,
            'credit_type' => null,
            'payment_type' => null,
            'payment_reference' => null,
            'order_id' => null,
        ]);
    }

    public function store(Request $request)
    {
        $redirectUrl = $request->input('from') ?? route('home');

        $request->validate([
            'value' => 'required|numeric|min:0.01',
            'debit_type' => 'required|in:order,membership_fee',
        ]);

        $user = auth()->user();
        $card = $user->card;

        if (!$card) {
            return redirect($redirectUrl)->with('error', 'User does not have an associated card.');
        }

        if ($card->balance < $request->value) {
            return redirect($redirectUrl)->with('error', 'Insufficient balance on your card.');
        }

        // Deduct balance
        $card->balance -= $request->value;
        $card->save();

        // Create transaction
        Operation::create([
            'card_id' => $card->id,
            'type' => 'debit',
            'value' => $request->value,
            'date' => now()->toDateString(),
            'debit_type' => $request->debit_type,
            'credit_type' => null,
            'payment_type' => null,
            'payment_reference' => null,
            'order_id' => null,
        ]);

        // If membership_fee transaction, update user type to 'member'
        if ($request->debit_type === 'membership_fee' && $user->type === 'pending_member') {
            $user->type = 'member';
            $user->save();
        }

        return redirect($redirectUrl)->with('success', 'Transaction created!');
    }
    public function create(Request $request)
    {
        $value = $request->input('value');
        $debit_type = $request->input('debit_type');

        return view('transactions.create', compact('value', 'debit_type'));
    }

    public function history(User $account)
    {
       
        $transactions = $account->card->operations()->orderBy('date', 'desc')->get();

        return view('transactions.history', compact('transactions', 'account'));
    }

}