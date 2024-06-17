<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function admin(User $user)
    {
        return $user->hasRole("admin");
    }

    public function superAdmin(User $user)
    {
        return $user->super_admin ? true : false;
    }

    public function userManager(User $user)
    {
        return $user->hasPermission("management","user");
    }

    public function employee(User $user)
    {
        return $user->hasPermission("management","employee");
    }
}
