<?php

namespace App\Repositories;

use App\User;
use Hash;

class UserRepository 
{
    public function changePassword(User $user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
    }

}