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

            $table->primary(['id', 'id_checklist', 'id_projeto']);
       
            $table->foreign('id_projeto')->references('id')->on('projeto')->onDelete('cascade')->constrained();
            $table->foreign(['id', 'id_checklist'])->references(['id', 'id_checklist'])->on('check_list_atividades')->onDelete('cascade')->constrained();
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
