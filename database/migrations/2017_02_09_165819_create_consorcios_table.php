<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsorciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consorcios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 45);
            $table->integer('num_participantes');
            $table->date('vigencia_ini')->nullable();
            $table->date('vigencia_fim')->nullable();
            $table->char('ativo', 1)->default('S');
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
        Schema::dropIfExists('consorcios');
    }
}
