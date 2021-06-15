<?php

namespace App\Dtos;

class LogEmailEnviadoOuAgendadoDto
{
    private string $assunto;
    private string $corpo_email;
    private string $agendar;
    private string $status;
    private $usuario;

    public function __construct(string $assunto, string $corpo_email, string $agendar, string $status, $usuario)
    {
        $this->assunto = $assunto;
        $this->corpo_email = $corpo_email;
        $this->agendar = $agendar;
        $this->status = $status;
        $this->usuario = $usuario;
    }

    public function assunto()
    {
        return $this->assunto;
    }

    public function corpo_email()
    {
        return $this->corpo_email;
    }

    public function agendar()
    {
        return $this->agendar;
    }

    public function status()
    {
        return $this->status;
    }

    public function usuario()
    {
        return $this->usuario;
    }
}
