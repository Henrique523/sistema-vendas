<?php


namespace App\Services;

use App\Dtos\LogEmailEnviadoOuAgendadoDto;
use App\Dtos\MailerSendMailDto;
use App\Errors\InvalidParamError;
use App\Repositories\Contracts\IUserEmailsRepository;
use App\Repositories\Contracts\IUsersRepository;
use App\Services\Mailer\Contracts\IMailerService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SendMailSerivce
{

    private IUsersRepository $usersRepository;
    private IUserEmailsRepository $userEmailsRepository;
    private IMailerService $mailerService;

    public function __construct(IUsersRepository $usersRepository, IUserEmailsRepository $userEmailsRepository, IMailerService $mailerService)
    {
        $this->usersRepository = $usersRepository;
        $this->userEmailsRepository = $userEmailsRepository;
        $this->mailerService = $mailerService;
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

        $this->mailerService->sendMail(new MailerSendMailDto($request->email, $request->nome, $request->assunto, $request->corpo_email, $agendar));

        $logEmailEnviadoOuAgendadoDto = new LogEmailEnviadoOuAgendadoDto($request->assunto, $request->corpo_email, $agendar, $status, $usuario);
        $log = $this->userEmailsRepository->logEmailEnviadoOuAgendado($logEmailEnviadoOuAgendadoDto);

        return $log;
    }
}
