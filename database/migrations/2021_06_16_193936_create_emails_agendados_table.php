<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsAgendadosTable extends Migration
{
    public function up(): void
    {
        Schema::create('emails_agendados', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('status');

            $table->unsignedBigInteger('user_emails_id');
            $table->foreign('user_emails_id')->references('id')->on('user_emails');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emails_agendados');
    }
}
