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
            $table->string('nome', 30);
            $table->string('sobrenome', 50);
            $table->string('apelido', 20)->nullable();
            $table->string('email', 50)->unique();
            $table->date('data_nasc');
            $table->string('cpf', 11);
            $table->string('crea', 10);
            $table->string('celular', 11);
            $table->string('telefone_fixo', 11)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
