<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\FuncoesAux\funcoesMap;
use App\Http\Requests\UserFormRequest;
use Carbon\Carbon;
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
        /* User::create($request->all());
        return redirect()->route('users.index'); */

        User::create($request->validated());
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


    public function update(UserFormRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());
        return redirect()->route('users.index');
    }



    public function destroy(User $user): RedirectResponse
    {
        $now = Carbon::now();
        $user->deleted_at = $now;
        $user->save();
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