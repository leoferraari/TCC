<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckListAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_list_atividades', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('id_checklist');
            $table->string('descricao');

            $table->primary(['id', 'id_checklist']);

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
        Schema::dropIfExists('check_list_atividades');
    }
}
