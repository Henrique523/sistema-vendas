<?php

namespace App\Services\Mailer;

use App\Dtos\MailerSendMailDto;
use App\Services\Mailer\Contracts\IMailerService;
use MailchimpTransactional\ApiClient;

class MailchimpMailerService implements IMailerService
{
    private ApiClient $mailchimp;

    public function __construct()
    {
        $this->mailchimp = new ApiClient();
        $this->mailchimp->setApiKey(env('MAILCHIMP_KEY'));
    }

    public function sendMail(MailerSendMailDto $mailerSendMailDto): void
    {
        $this->mailchimp->messages->send([
            "message" => [
                "from_email" => "guilherme@saudeefoco.com",
                "text" => $mailerSendMailDto->text(),
                "subject" => $mailerSendMailDto->subject(),
                "to" => [
                    [
                        "email" => $mailerSendMailDto->to_email(),
                        "name" => $mailerSendMailDto->to_name()
                    ]
                ],
            ],
            "send_at" => $mailerSendMailDto->send_at(),
        ],
        );
    }
}
