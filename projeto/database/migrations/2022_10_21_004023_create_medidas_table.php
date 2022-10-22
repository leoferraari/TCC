<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medidas', function (Blueprint $table) {
            $table->integer('id_medida');
            $table->integer('id_projeto');
            $table->integer('id_comodo');
            $table->integer('tipo_unidade_medida')->nullable();
            $table->integer('tipo_medida')->nullable();
            $table->smallInteger('tipo_ponto')->nullable();

            $table->string('descricao_medida');
            $table->float('medicao', 17, 2)->nullable();

            $table->string('descricao_ponto')->nullable();
            $table->integer('id_medida_pai')->nullable();

            $table->primary(['id_medida', 'id_projeto', 'id_comodo']);
       
            $table->foreign('id_projeto')->references('id')->on('projeto')->onDelete('cascade')->constrained();
            $table->foreign(['id_projeto', 'id_comodo'])->references(['id_projeto','id'])->on('comodos')->onDelete('cascade')->constrained();
            $table->foreign(['id_projeto', 'id_comodo', 'id_medida_pai'])->references(['id_projeto', 'id_comodo','id_medida'])->on('medidas')->onDelete('cascade')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arquivo_projeto');
    }
}
