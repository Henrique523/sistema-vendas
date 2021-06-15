<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\IUserRepository;

class UsersRepository
{
    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function findUserByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
}
