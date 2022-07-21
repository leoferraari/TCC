<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco_users', function (Blueprint $table) {
            $table->id();
            $table->string('complemento')->nullable();
            $table->integer('numero_endereco');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('cep');
            $table->unsignedBigInteger('id_usuario');

            $table->timestamps();
        });

        Schema::table('endereco_users', function (Blueprint $table) {
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endereco_users');
    }
}
