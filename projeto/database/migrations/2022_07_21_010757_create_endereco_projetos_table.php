<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecoProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco_projetos', function (Blueprint $table) {
            $table->id();
            $table->string('complemento')->nullable();
            $table->integer('numero_endereco');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('cep');
            $table->unsignedBigInteger('id_projeto');

            $table->foreign('id_projeto')->references('id')->on('projeto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endereco_projetos');
    }
}
