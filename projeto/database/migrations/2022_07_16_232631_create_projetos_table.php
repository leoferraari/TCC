<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projeto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 30);
            $table->string('descricao', 300);
            $table->string('nome_cliente', 40);
            $table->string('email_cliente', 60);
            $table->string('numero_tel_cliente', 11);
            $table->smallInteger('situacao');
            $table->timestamp('data_criacao')->default('now()');
            $table->timestamp('data_atendimento');
            $table->string('hora_atendimento', 6);
            $table->timestamp('prazo_final');
            $table->timestamp('data_conclusao')->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_terceirizado')->nullable();
            $table->smallInteger('id_checklist')->nullable();

            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_terceirizado')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreign('id_checklist')->references('id')->on('check_lists')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projeto');
    }
}
