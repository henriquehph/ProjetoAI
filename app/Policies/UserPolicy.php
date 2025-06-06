<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function view(User $user, User $account)
    {
        return $user->id == $account->id || $user->type == 'board';
    }
     public function viewMemberInfo(User $user)
    {
        return $user->type == 'member' || $user->type == 'board' || $user->type == 'pending';
    }

     public function viewEmployeeInfo(User $user)
    {
        return $user->type == 'employee' || $user->type == 'board';
    }
    public function update(User $user, User $account)
    {
        return ( ($user->id == $account->id) &&
            ($user->age >= 18) ) || $user->type == 'board';
    }
    public function create(User $user)
    {
        return $user->type == 'board';
    }
}