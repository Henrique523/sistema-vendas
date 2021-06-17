<?php

namespace App\Repositories\Contracts;

interface IUsersRepository
{
    public function findUserByEmail(string $email);
    public function findAll();
}
