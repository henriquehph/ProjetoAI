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
        $allUsers = User::all();

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
        return redirect('/users');
    }

    public function edit(User $user): View
    {
        if (!$user) {
            abort(404);  // Or redirect with a custom message
        }
        return view('users.edit', [
            'user' => $user,
            'membership' => funcoesMap::mapMembershipType($user->type),
            'balance' => $user->card->balance ?? 0,
            'gender' => funcoesMap::mapGender($user->gender),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $user->update($request->all());
        return redirect('/users');
    }

}