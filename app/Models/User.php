<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = 'users';
    protected $connection = 'mysql';

    protected $fillable = ['nome', 'email'];

    public function emails()
    {
        return $this->hasMany(UserEmails::class);
    }
}
