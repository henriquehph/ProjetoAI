<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\FuncoesAux\funcoesMap;
class UserController extends Controller
{
    public function index(): View
    {
        $allUsers = User::paginate(20);

        //debug($allUsers);

        return view('users.index')->with('users', $allUsers);


    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        User::create($request->all());
        return redirect()->route('users.index');
    }

    public function edit(User $user): View
    {
        if (!$user) {
            abort(404);  // Or redirect with a custom message
        }
        return view('users.edit', [
            'user' => $user,
            'email' => $user->hasVerifiedEmail() && $user->email ? $user->email : 'No email provided',
            'membership' => funcoesMap::mapMembershipType($user->type),
            'blocked' => funcoesMap::mapBlocked($user->blocked),
            'gender' => funcoesMap::mapGender($user->gender),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        //$user->update($request->all());

        //dd($request->all()); //debug
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'gender' => ['required', 'in:M,F,O'],
            'nif' => ['nullable', 'regex:/^\d{9}$/'],
            'default_delivery_address' => ['nullable', 'string', 'max:255'],
            'default_payment_type' => ['nullable', 'in:Visa,PayPal,MB WAY'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
            'type' => ['required', 'in:pending_member,board,member,employee'],
            'blocked' => ['required', 'in:0,1'],
        ]);

        //dd($validated); //debug


        $user->update($validated);

        return redirect()->route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function show(User $user): View
    {

        return view('users.show', [
            'user' => $user,
            'email' => $user->hasVerifiedEmail() && $user->email ? $user->email : 'No email provided',
            'membership' => funcoesMap::mapMembershipType($user->type),
            'blocked' => funcoesMap::mapBlocked($user->blocked),
            'gender' => funcoesMap::mapGender($user->gender),
        ]);

    }
}