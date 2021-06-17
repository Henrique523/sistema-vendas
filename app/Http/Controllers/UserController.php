<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\IUsersRepository;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    private IUsersRepository $usersRepository;

    public function __construct(IUsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function index()
    {
        try {
            $users = $this->usersRepository->findAll();
            return Response::json($users);
        } catch ( \Error $error) {
            return Response::json($error = ["message" => "Ocorreu um erro no servidor. Favor contatar a equipe de suporte"], 500);
        }

    }
}
