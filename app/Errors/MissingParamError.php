<?php


namespace App\Errors;


use Illuminate\Support\Facades\Response;

class MissingParamError
{
    public static function getError(string $parametro)
    {
        return Response::json(['error' => "Parâmetro {$parametro} não encontrado na requisicão."], 400);
    }
}
