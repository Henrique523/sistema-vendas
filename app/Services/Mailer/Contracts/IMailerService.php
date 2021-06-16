<?php

namespace App\Services\Mailer\Contracts;

use App\Dtos\MailerSendMailDto;
use Illuminate\Http\JsonResponse;

interface IMailerService
{
    public function sendMail(MailerSendMailDto $mailerSendMailDto): void;
}
