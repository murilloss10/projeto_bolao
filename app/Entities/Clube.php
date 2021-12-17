<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Clube.
 *
 * @package namespace App\Entities;
 */
class Clube extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'clubes';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'nome', 'abreviacao', 'url_escudo'];

    public function partidasMandantes()
    {
        return $this->hasMany(Partida::class, 'clube_casa_id', 'id');
    }

    public function partidasVisitantes()
    {
        return $this->hasMany(Partida::class, 'clube_visitante_id', 'id');
    }

}
