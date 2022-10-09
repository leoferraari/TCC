<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistAtividadeProjetoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_atividade_projeto', function (Blueprint $table) {
            $table->integer('id');
            $table->unsignedBigInteger('id_projeto');
            $table->integer('id_checklist');
            $table->smallInteger('concluido');

            $table->primary(['id', 'id_projeto', 'id_checklist']);

            $table->foreign('id_projeto')->references('id')->on('projeto')->onDelete('cascade')->constrained();
            $table->foreign('id_checklist')->references('id')->on('check_lists')->onDelete('cascade')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checklist_atividade_projeto');
    }
}
