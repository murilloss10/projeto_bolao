<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateRelatoriosTable.
 */
class CreateRelatoriosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('relatorios', function(Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('aposta_id', 36);
			$table->string('usuario_id', 36);
			$table->string('usuario_nome', 36);
			$table->integer('partida_id');
			$table->decimal('valor_aposta', $precision = 8, $scale = 2);
			$table->string('descricao_partida', 255);
			$table->date('data_partida');
			$table->integer('clube_mandante_id');
			$table->integer('clube_visitante_id');
			$table->string('clube_mandante_nome', 36);
			$table->string('clube_visitante_nome', 36);
			$table->integer('placar_aposta_clube_mandante')->nullable();
			$table->integer('placar_aposta_clube_visitante')->nullable();
			$table->boolean('aposta_em_empate')->nullable();
			$table->boolean('aposta_em_mandante')->nullable();
			$table->boolean('aposta_em_visitante')->nullable();
			$table->integer('placar_oficial_mandante')->nullable();
            $table->integer('placar_oficial_visitante')->nullable();
			$table->boolean('is_empate')->nullable();
			$table->boolean('is_vitoria_mandante')->nullable();
			$table->boolean('is_vitoria_visitante')->nullable();
			$table->boolean('valida');
			$table->boolean('vencida');
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
		Schema::drop('relatorios');
	}
}
