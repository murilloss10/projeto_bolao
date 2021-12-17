<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->id();
            $table->string('campeonato', 36);
            $table->string('rodada', 36)->nullable();
            $table->string('fase', 36)->nullable();
            $table->integer('clube_casa_id');
            $table->integer('clube_visitante_id');
            $table->date('partida_data');
            $table->string('partida_horario');
            $table->string('local', 91)->nullable();
            $table->boolean('valida'); //pode ser criterio para se a partida vai ser exibida ou não
            $table->integer('placar_oficial_mandante')->nullable();
            $table->integer('placar_oficial_visitante')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('partidas');
    }
}
