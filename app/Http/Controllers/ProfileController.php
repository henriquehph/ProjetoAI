<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\FuncoesAux\funcoesMap;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
class ProfileController extends Controller
{

    use AuthorizesRequests;
    public function show()
    {

        $user = Auth::user();

        $this->authorize('view', $user);

        return view('profile.profile', [
            'user' => $user,
            'membership' => funcoesMap::mapMembershipType($user->type),
            'balance' => $user->card->balance ?? 0,
            'gender' => funcoesMap::mapGender($user->gender),

        ]);
    }
    public function edit(Request $request): View
    {
        $user = $request->user();
        $this->authorize('view', $user);

        return view('profile.edit', [
            'user' => $user,
            'balance' => $user->card->balance ?? 0,
            'membership' => funcoesMap::mapMembershipType($user->type),
        ]);
    }



    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $this->authorize('view', $user);

        $request->validate(rules: [
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'gender' => ['required', 'in:M,F,O'],
            'nif' => ['nullable', 'regex:/^\d{9}$/'],
            'default_delivery_address' => ['nullable', 'string', 'max:255'],
            'default_payment_type' => ['nullable', 'in:Visa,PayPal,MB WAY'],
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

        return Redirect::route('profile.show')->with('status', 'profile-updated');

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {


        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        $this->authorize('view', $user);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
