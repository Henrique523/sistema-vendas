<?php

namespace App\Repositories\Contracts;

interface IEmailsAgendadosRepository
{
    public function gerarAgendamentoDeEmail(string $idUsuario, string $agendar): void;
}
