<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MembershipController extends Controller
{
    public function showPaymentForm()
    {
        return view('membership.pay');
    }

    public function processPayment(Request $request)
    {
        $user = Auth::user();
        $card = $user->card; 

        // Verificar se o user já é membro -- Ele só vê o botão se não for membro, por isso isto é uma dupla verificação
        if ($user->type !== 'pending_member') {
            return redirect()->route('profile.show')->with('message', 'You are already a member.');
        }

        if ($card->balance >= 100) {
            $card->balance -= 100;
            $user->type = 'member';
            $card->save();
            //$user->save();

            return redirect()->route('profile.show')->with('message', 'Membership fee paid successfully!');
        }

        return redirect()->route('payments.pay')->with('error', 'Insufficient balance.');
    }
}
