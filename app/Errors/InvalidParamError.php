<?php

namespace App\Errors;

use Illuminate\Support\Facades\Response;

class InvalidParamError
{
    public static function getError(string $message)
    {
        return Response::json(['error' => $message], 400);
    }
}
