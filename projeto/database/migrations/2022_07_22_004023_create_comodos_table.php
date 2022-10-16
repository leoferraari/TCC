<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comodos', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('id_projeto');
            $table->string('nome');
            $table->string('descricao');

            $table->primary(['id', 'id_projeto']);

            $table->foreign('id_projeto')->references('id')->on('projeto')->onDelete('cascade')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comodos');
    }
}
