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
            $table->string('sobrenome', 50)->nullable();
            $table->string('apelido', 20)->nullable();
            $table->string('email', 50)->unique();
            $table->date('data_nasc')->nullable();
            $table->string('cpf')->nullable();
            $table->string('crea')->nullable();
            $table->string('celular', 11)->nullable();
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
