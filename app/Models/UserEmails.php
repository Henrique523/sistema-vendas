<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmails extends Model
{
    public $table = 'user_emails';
    protected $fillable = ['assunto', 'corpo_email', 'agendar', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
