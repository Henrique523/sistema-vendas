<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\IUsersRepository;

class UsersRepository implements IUsersRepository
{
    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function findUserByEmail (string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function findAll()
    {
        return $this->model->all();
    }
}
