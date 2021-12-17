<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Partida;

/**
 * Class PartidaTransformer.
 *
 * @package namespace App\Transformers;
 */
class PartidaTransformer extends TransformerAbstract
{
    /**
     * Transform the Partida entity.
     *
     * @param \App\Entities\Partida $model
     *
     * @return array
     */
    public function transform(Partida $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
