<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Card;

class FundsController extends Controller
{
    // Show the "Add Funds" form
    public function create()
    {
        return view('funds.add');  
    }

    // Handle the form submission and add funds
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();

        // Find the user's card 
        $card = Card::where('id', $user->id)->first();

        if (!$card) {
            return redirect()->back()->withErrors(['card' => 'No card found for your account. Please add a card first.']);
        }

        // Add amount to the card balance
        $card->increment('balance', $request->input('amount'));

        return redirect()->route('profile.edit')->with('success', 'Funds added successfully!');
    }
}