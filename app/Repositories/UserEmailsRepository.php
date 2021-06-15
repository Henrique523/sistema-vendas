<?php

namespace App\Repositories;

use App\Dtos\LogEmailEnviadoOuAgendadoDto;
use App\Models\UserEmails;

class UserEmailsRepository
{
    private UserEmails $model;

    public function __construct(UserEmails $model)
    {
        $this->model = $model;
    }

    public function logEmailEnviadoOuAgendado(LogEmailEnviadoOuAgendadoDto $agendamentoDto)
    {
         $log = $this->model->create([
            'assunto' => $agendamentoDto->assunto(),
            'corpo_email' => $agendamentoDto->corpo_email(),
            'agendar' => $agendamentoDto->agendar(),
            'status' => $agendamentoDto->status(),
            'user_id' => $agendamentoDto->usuario()->id,
        ]);

        return $log;
    }
}
