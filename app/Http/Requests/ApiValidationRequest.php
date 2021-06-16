<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ApiValidationRequest
{
    public static function validaDadosApi(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
           'nome' => 'required',
           'email' => 'required|email',
           'assunto' => 'required',
           'corpo_email' => 'required',
           'agendar' => 'nullable|date_format:Y-m-d H:i:s',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'O campo :attribute não e um email válido.',
            'date_format' => 'O campo :attribute nao enviou uma data no formato valido.'
        ]);

        if($validator->fails()) {
            return Response::json($error = $validator->errors(), 400);
        }

        return Response::json($request, 200);
    }
}
