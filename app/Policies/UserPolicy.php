<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{

    public function before(?User $user): bool|null
    {
        if ($user?->blocked == 1 || $user?->deleted_at != null) {
            return false;
        }

        if ($user?->type == 'board') {
            return true;
        }
        // When "Before" returns null, other methods (eg. viewAny, view, etc...) will be
        // used to check the user authorizaiton
        return null;
    }
    public function viewAny(User $user, User $account)
    {
        return $user->type === 'board';
    }
  
      public function view(User $user, User $account): bool
    {
        return $user->type === 'board' || $user->id == $account->id;
    }

     public function create(User $user): bool
    {
        return $user->type === 'board';
    }

    public function update(User $user, User $account): bool
    {
        return $user->type === 'board';
    }

    public function delete(User $user, User $account): bool
    {
        return $user->type == 'board';
    }

    public function viewMemberDetails(User $user): bool
    {
        return $user->type !== 'employee';
    }

    public function editProfileMemberDetails(User $user): bool
    {
        return $user->type !== 'employee';
    }

}