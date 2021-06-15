<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'nome' => 'Fulano da Silva',
            'email' => 'fulano@teste.com.br'
        ]);

        DB::table('users')->insert([
            'nome' => 'Ciclano de Sousa',
            'email' => 'ciclano@teste.com.br'
        ]);

        DB::table('users')->insert([
            'nome' => 'Beltrano Marques',
            'email' => 'beltrano@teste.com.br'
        ]);

    }
}
