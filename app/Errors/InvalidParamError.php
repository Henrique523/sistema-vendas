<?php

namespace App\Errors;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class InvalidParamError
{
    public static function getError(string $message): JsonResponse
    {
        return Response::json(['error' => $message], 400);
    }
}
