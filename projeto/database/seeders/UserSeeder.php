<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nome' => 'Leonardo',
            'sobrenome' => 'Ferrari',
            'apelido' => 'Léo',
            'email' => 'leonardo.ferrari@unidavi.edu.br',
            'data_nasc' => '05/04/1999',
            'cpf' => '999.999.999-99',
            'crea' => '250.678',
            'celular' => '47 - 99999-9999',
            'telefone_fixo' => '47 - 99999-9999',
            'permite_projeto_terceirizado' => 1,
            'password' => Hash::make('123456'),
        ]);

        DB::table('endereco_users')->insert([
            'complemento' => 'Em frente a casa X',
            'numero_endereco' => 210,
            'cep' => '89164-322',
            'bairro' => 'Pamplona',
            'id_usuario' => 1,
            'cidade' => 4529
        ]);

        DB::table('users')->insert([
            'nome' => 'Marisa',
            'sobrenome' => 'Ferrari',
            'apelido' => 'Mari',
            'email' => 'marisa.ferrari@hotmail.com',
            'data_nasc' => '14/11/1974',
            'cpf' => '999.999.999-99',
            'crea' => '251.678',
            'celular' => '47 - 99999-9999',
            'telefone_fixo' => '47 - 99999-9999',
            'permite_projeto_terceirizado' => 1,
            'password' => Hash::make('123456'),
        ]);


        DB::table('endereco_users')->insert([
            'complemento' => 'Em frente a casa X',
            'numero_endereco' => 210,
            'cep' => '89164-322',
            'bairro' => 'Pamplona',
            'id_usuario' => 2,
            'cidade' => 4529
        ]);
    }
}
