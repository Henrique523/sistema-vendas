<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailsAgendados extends Model
{
    public $table = 'emails_agendados';

    protected $fillable = ['status', 'user_emails_id'];

    public function userEmails()
    {
        return $this->belongsTo(UserEmails::class);
    }
}
