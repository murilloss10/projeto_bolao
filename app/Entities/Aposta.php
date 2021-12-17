<?php

namespace App\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use App\Traits\HasPrimaryKeyUuid;


/**
 * Class Aposta.
 *
 * @package namespace App\Entities;
 */
class Aposta extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $keyType = 'string';
    protected $table = 'apostas';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'partida_id', 'usuario_id', 'placar_usuario_mandante', 'placar_usuario_visitante', 'valor_aposta', 'valida', 'vencido', 'created_by', 'updated_by'];

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function partidas()
    {
        return $this->belongsTo(Partida::class, 'partida_id', 'id');
    }



}
