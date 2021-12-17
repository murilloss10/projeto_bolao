<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apostas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('partida_id');
            $table->string('usuario_id', 36);
            $table->integer('placar_usuario_mandante');
            $table->integer('placar_usuario_visitante');
            $table->decimal('valor_aposta', $precision = 8, $scale = 2);
            $table->boolean('valida'); //se a aposta foi paga - por padrão receber false
            $table->boolean('vencido')->nullable(); //se bateu o placar com o resultado final
            $table->string('created_by', 36);
            $table->string('updated_by', 36);
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
        Schema::dropIfExists('apostas');
    }
}
