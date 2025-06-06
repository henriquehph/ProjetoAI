<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Card;

class FundsController extends Controller
{
    // Mostrar a pagina de Add Funds
    public function showAddFundsPage()
    {
        return view('add-funds');  // Retorna a view add-funds
    }

    //Tratar de adicionar os fundos
    public function addFunds(Request $request)
    {
        // Validar a quantidade
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Obter o user logged In
        $user = Auth::user();
        
        // Get the card linked to the user
        $card = Card::where('id', $user->id)->first();
        
        // Add the entered amount to the card balance
        $card->increment('balance', $request->amount);

        // Redirect back to the home page with a success message
        return redirect()->route('profile.edit')->with('success', 'Funds added successfully!');
    }
}