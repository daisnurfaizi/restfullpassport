<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function save($data)
    {
        $user = new $this->user;
        $user = User::create($data);
        return $user;
    }
    public function login()
    {
    }
}
