<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;

class OrderPolicy
{
    /**
     * Determine whether the user can view the order.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->type === 'board' ||
            ($user->type === 'employee' &&
                $user->blocked == 0 &&
                $user->deleted_at === null);
    }

    public function viewAny(User $user): bool
    {
        return $user->type === 'board' ||
            ($user->type === 'employee' &&
                $user->blocked == 0 &&
                $user->deleted_at === null);
    }
}