<?php

namespace App\Providers;

use App\Repositories\Contracts\IEmailsAgendadosRepository;
use App\Repositories\Contracts\IUserEmailsRepository;
use App\Repositories\Contracts\IUsersRepository;
use App\Repositories\EmailAgendadosRepository;
use App\Repositories\UserEmailsRepository;
use App\Repositories\UsersRepository;
use App\Services\Mailer\Contracts\IMailerService;
use App\Services\Mailer\MailchimpMailerService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUsersRepository::class, UsersRepository::class);
        $this->app->bind(IUserEmailsRepository::class, UserEmailsRepository::class);
        $this->app->bind(IMailerService::class, MailchimpMailerService::class);
        $this->app->bind(IEmailsAgendadosRepository::class, EmailAgendadosRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
