<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Partida.
 *
 * @package namespace App\Entities;
 */
class Partida extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'partidas';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'campeonato', 'rodada', 'fase', 'clube_casa_id', 'clube_visitante_id', 'partida_data', 'partida_horario', 'local', 'valida', 'placar_oficial_mandante', 'placar_oficial_visitante'];

    public function apostas()
    {
        return $this->hasMany(Aposta::class, 'partida_id', 'id');
    }

    public function clubesMandante()
    {
        return $this->belongsTo(Clube::class, 'clube_casa_id', 'id');
    }

    public function clubesVisitante()
    {
        return $this->belongsTo(Clube::class, 'clube_visitante_id', 'id');
    }


}
