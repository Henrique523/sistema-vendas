<?php

namespace App\Http\Controllers;

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
        return $this->sendMailService->sendMailService($request);
    }
}
