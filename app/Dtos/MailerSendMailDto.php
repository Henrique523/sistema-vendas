<?php


namespace App\Dtos;


class MailerSendMailDto
{
    private string $to_email;
    private string $to_name;
    private string $subject;
    private string $text;
    private $send_at;

    public function __construct(string $to_email, string $to_name, string $subject, string $text, $send_at)
    {
        $this->to_email = $to_email;
        $this->to_name = $to_name;
        $this->subject = $subject;
        $this->text = $text;
        $this->send_at = $send_at;
    }

    public function to_email()
    {
        return $this->to_email;
    }

    public function to_name()
    {
        return $this->to_name;
    }

    public function subject()
    {
        return $this->subject;
    }

    public function text()
    {
        return $this->text;
    }

    public function send_at()
    {
        return $this->send_at;
    }

}
