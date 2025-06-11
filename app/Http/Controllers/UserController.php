<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\FuncoesAux\funcoesMap;
use App\Http\Requests\UserFormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{

    use AuthorizesRequests;
    public function __construct()
    {
        $this->authorizeResource(User::class);
    } 

    public function index(Request $request): View
    {

        $users = User::query();

        if ($request->filled('name')) {
            $users->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('nif')) {
            $users->where('nif', 'like', '%' . $request->nif . '%');
        }

        if ($request->filled('blocked')) {
            $users->where('blocked', 'like', '%' . $request->blocked . '%');
        }

        if ($request->filled('gender')) {
            $users->where('gender', 'like', '%' . $request->gender . '%');
        }


        if ($request->filled('default_payment_type')) {
            $users->where('default_payment_type', 'like', '%' . $request->default_payment_type . '%');
        }


        if ($request->filled('type')) {
            $users->where('type', 'like', '%' . $request->type . '%');
        }



        $users = $users->paginate(20)->withQueryString(); // preserve filters in pagination

        return view('users.index', compact('users'));

        //$allUsers = User::paginate(20);

        //debug($allUsers);

        //return view('users.index')->with('users', $allUsers);


    }

    public function create(): View
    {
        $user = new \App\Models\User(); // empty user object
        return view('users.create')->with('user', $user);
    }

    public function store(Request $request): RedirectResponse
    {
        /* User::create($request->all());
        return redirect()->route('users.index'); */
        //dd($request->all()); // debug

        $data = $request->validated();

        // Handle photo upload if file is present
        if ($request->hasFile('photo_file')) {
            $path = $request->file('photo_file')->store('photos', 'public');

            dd($path); // debug
            $data['photo'] = $path; // save relative path in 'photo' field
        }

        User::create($data);

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
        

        $data = $request->validated();

        if ($request->hasFile('photo_file')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            // Store new photo
            $path = $request->file('photo_file')->store('photos', 'public');
            $data['photo'] = $path;
        }

        if ($request->input('delete_photo') == '1') {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = null;
        }

        $user->update($data);

        return redirect()->route('users.index');
    }



    public function destroy(User $user): RedirectResponse
    {
        //Obter timestamp atual
        $now = Carbon::now();

        //Página atual
        $page = request()->get('page', 1);
        //dd($page); //debug

        //Verificar que o user não se está a eliminar a ele mesmo
        $current_user = Auth::user();
        if ($current_user->id === $user->id) {
            return redirect()->route('users.index', ['page' => $page])->with('error', 'You cannot delete your own account.');
        }
        $user->deleted_at = $now;
        $user->save();
        return redirect()->route('users.index', ['page' => $page]);
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