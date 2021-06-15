<?php


namespace App\Services;

use App\Dtos\LogEmailEnviadoOuAgendadoDto;
use App\Errors\InvalidParamError;
use App\Repositories\UserEmailsRepository;
use App\Repositories\UsersRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SendMailSerivce
{

    private UsersRepository $usersRepository;
    private UserEmailsRepository $userEmailsRepository;

    public function __construct(UsersRepository $usersRepository, UserEmailsRepository $userEmailsRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->userEmailsRepository = $userEmailsRepository;
    }

    public function sendMailService(Request $request)
    {
        $usuario = $this->usersRepository->findUserByEmail($request->email);

        if (is_null($usuario)) {
            return InvalidParamError::getError('Nenhum usuário foi encontrado com este email.');
        }

        if($usuario->nome !== $request->nome) {
            return InvalidParamError::getError('O email enviado não pertence a este usuário.');
        }

        $agendar = new Carbon(new \DateTimeImmutable());
        $agendar->format('Y-m-d H:i:s');

        $status = 'ENVIADO';

        if (!is_null($request->agendar)) {
            $dataAgendamento = Carbon::createFromFormat('Y-m-d H:i:s', $request->agendar);

            if(!$dataAgendamento->isAfter($agendar)) {
                return InvalidParamError::getError('Não e possivel agendar um envio de email no passado.');
            }

            $agendar = $request->agendar;
            $status = 'AGENDADO';
        }

        $logEmailEnviadoOuAgendadoDto = new LogEmailEnviadoOuAgendadoDto($request->assunto, $request->corpo_email, $agendar, $status, $usuario);
        $log = $this->userEmailsRepository->logEmailEnviadoOuAgendado($logEmailEnviadoOuAgendadoDto);

        return $log;
    }
}
