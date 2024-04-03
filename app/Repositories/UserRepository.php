<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        $users = User::all();
        return $users;
    }
    public function createData($data)
    {
        $user = User::create($data);
        return $user;
    }

    public function assignRole($user, $role)
    {
        $user->assignRole($role);
    }

    public function deleteData($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
