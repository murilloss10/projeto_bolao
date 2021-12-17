<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Relatorio.
 *
 * @package namespace App\Entities;
 */
class Relatorio extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'relatorios';
    protected $fillable = [
        'id', 'aposta_id', 'usuario_id', 'usuario_nome', 'partida_id', 'valor_aposta', 'descricao_partida', 'data_partida', 'clube_mandante_id', 'clube_visitante_id',
        'clube_mandante_nome', 'clube_visitante_nome', 'placar_aposta_clube_mandante', 'placar_aposta_clube_visitante', 'aposta_em_empate', 'aposta_em_mandante',
        'aposta_em_visitante', 'placar_oficial_mandante', 'placar_oficial_visitante', 'is_empate', 'is_vitoria_mandante', 'is_vitoria_visitante', 'valida', 'vencida'
    ];


    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function partida()
    {
        return $this->belongsTo(Partida::class, 'partida_id', 'id');
    }

    public function aposta()
    {
        return $this->belongsTo(Aposta::class, 'aposta_id', 'id');
    }

    public function clubesMandante()
    {
        return $this->belongsTo(Clube::class, 'clube_mandante_id', 'id');
    }

    public function clubesVisitante()
    {
        return $this->belongsTo(Clube::class, 'clube_visitante_id', 'id');
    }

}
