<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('sobrenome');
            $table->string('apelido')->nullable();
            $table->string('email')->unique();
            $table->date('data_nasc');
            $table->string('cpf');
            $table->string('crea');
            $table->string('celular');
            $table->string('telefone_fixo')->nullable();
            $table->smallInteger('permite_projeto_terceirizado')->default(1);
            $table->string('password');
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
