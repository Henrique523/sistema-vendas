<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiValidationRequest;
use App\Services\SendMailSerivce;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
    private SendMailSerivce $sendMailService;

    public function __construct(SendMailSerivce  $sendMailSerivce)
    {
        $this->sendMailService = $sendMailSerivce;
    }

    public function sendMail(Request $request)
    {
        $responseValidation = ApiValidationRequest::validaDadosApi($request);

        if($responseValidation->status() === 200) {
            return $this->sendMailService->sendMailService($request);
        }

        return $responseValidation;
    }
}
