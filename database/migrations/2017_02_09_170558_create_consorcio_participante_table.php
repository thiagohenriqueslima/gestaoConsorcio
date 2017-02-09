<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsorcioParticipanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consorcio_participante', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consorcio_id');
            $table->integer('participante_id');
            $table->char('contemplado', 1)->default('N');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consorcio_participante');
    }
}
