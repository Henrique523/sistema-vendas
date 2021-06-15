<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserEmails extends Migration
{
    public function up(): void
    {
        Schema::create('user_emails', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('assunto');
            $table->longText('corpo_email');
            $table->dateTime('agendar');
            $table->string('status');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_emails');
    }
}
