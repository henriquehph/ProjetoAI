<?php

namespace App\Http\Controllers\Auth;

use App\FuncoesAux\funcoesVerificacao;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Card;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'in:male,female,other'],
            'address' => ['nullable', 'string', 'max:255'], // Nullable -> Opcional
            'nif' => ['nullable', 'string', 'max:20'],
            'payment_info' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
        ]);

        $photoPath = funcoesVerificacao::uploadProfilePhoto($request->file('photo')); // Verifica se a foto é válida e guarda-a na pasta profile_photos

        $user = User::create([ //cria linha na base de dados
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => funcoesVerificacao::mapGender($request->gender), // Mapeia o género para M, F ou O
            'address' => $request->address,
            'nif' => $request->nif,
            'payment_info' => $request->payment_info,
            'photo' => $request->photo,
            'blocked' => 0,  // Default blocked status
        ]);

        Card::create([
            'id' => $user->id,  // Associate the card with the user
            'balance' => 0,  // Starting balance for the card
            'card_number' => rand(100000, 999999), // Generate a 6-digit card number
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
