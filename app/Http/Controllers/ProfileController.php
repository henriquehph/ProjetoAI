<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\FuncoesAux\funcoesMap;
<<<<<<< HEAD

class ProfileController extends Controller
{
=======
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
class ProfileController extends Controller
{

    use AuthorizesRequests;
>>>>>>> Projeto
    public function show()
    {

        $user = Auth::user();
<<<<<<< HEAD
        if ($user->type === 'employee') {
            // Página para employees
            return view('profile.profile_employee', [
                'user' => $user,
                'photo' => $user->photo,
                'gender' => funcoesMap::mapGender($user->gender),
            ]);
        }

        return view('profile.profile', [
            'user' => $user,
            'membership' => $user->type,
=======

        $this->authorize('view', $user);

        return view('profile.profile', [
            'user' => $user,
            'membership' => funcoesMap::mapMembershipType($user->type),
>>>>>>> Projeto
            'balance' => $user->card->balance ?? 0,
            'gender' => funcoesMap::mapGender($user->gender),

        ]);
    }
    public function edit(Request $request): View
    {
        $user = $request->user();
<<<<<<< HEAD

        if ($user->type === 'employee') {
            // Página para employees
            return view('profile.edit_employee', compact('user'));
        } else {
            return view('profile.edit', [
                'user' => $user,
                'balance' => $user->card->balance ?? 0,
                'membership' => $user->type,
            ]);
        }
    }

=======
        $this->authorize('view', $user);

        return view('profile.edit', [
            'user' => $user,
            'balance' => $user->card->balance ?? 0,
            'membership' => funcoesMap::mapMembershipType($user->type),
        ]);
    }


>>>>>>> Projeto
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
<<<<<<< HEAD
=======
        $this->authorize('view', $user);
>>>>>>> Projeto

        $request->validate(rules: [
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'gender' => ['required', 'in:M,F,O'],
            'nif' => ['nullable', 'regex:/^\d{9}$/'],
            'default_delivery_address' => ['nullable', 'string', 'max:255'],
<<<<<<< HEAD
            'default_payment_type' => ['nullable', 'in: Visa,PayPal,MB WAY'],
=======
            'default_payment_type' => ['nullable', 'in:Visa,PayPal,MB WAY'],
>>>>>>> Projeto
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
        ]);


        // Debug todos os dados validados
        //dd($request->validated());

        // Debug - todos os dados do request
        //dd($request->all());

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
<<<<<<< HEAD
        
=======

>>>>>>> Projeto
        return Redirect::route('profile.show')->with('status', 'profile-updated');

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
<<<<<<< HEAD
=======


>>>>>>> Projeto
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
<<<<<<< HEAD
=======
        $this->authorize('view', $user);
>>>>>>> Projeto

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
