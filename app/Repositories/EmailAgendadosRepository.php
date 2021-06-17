<?php


namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class EmailAgendadosRepository implements Contracts\IEmailsAgendadosRepository
{

  public function gerarAgendamentoDeEmail(string $idUsuario, string $agendar): void
  {
      DB::unprepared(
          "CREATE EVENT agendar_email_{$idUsuario} ON SCHEDULE AT" . "'" . "{$agendar}" . "'" . "DO INSERT INTO emails_agendados
                (status, user_emails_id) VALUES('ENVIADO', {$idUsuario})"
      );
  }
}
