<?php

namespace App\Repositories\Contracts;

use App\Dtos\LogEmailEnviadoOuAgendadoDto;

interface IUserEmailsRepository
{
    public function logEmailEnviadoOuAgendado(LogEmailEnviadoOuAgendadoDto $agendamentoDto);
}
