<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
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
 
}