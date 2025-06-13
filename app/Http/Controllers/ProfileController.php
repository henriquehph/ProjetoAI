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
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{

    use AuthorizesRequests;
    public function show()
    {

        $user = Auth::user();

        $this->authorize('view', $user);

        $membershipFee = \App\Models\Setting::first()->membership_fee;

        return view('profile.profile', [
            'user' => $user,
            'membership' => funcoesMap::mapMembershipType($user->type),
            'balance' => $user->card->balance ?? 0,
            'gender' => funcoesMap::mapGender($user->gender),
            'membershipFee' => $membershipFee,

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


        $data = $request->validated();
        $user->fill($data);

        // Debug todos os dados validados
        //dd($request->validated());

        // Debug - todos os dados do request
        //dd($request->all());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->input('delete_photo') == '1') {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = null;
        }

        if ($request->hasFile('photo_file')) {
            $path = $request->file('photo_file')->store('photos', 'public');
            $user['photo'] = $path;
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
