<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Aposta;

/**
 * Class ApostaTransformer.
 *
 * @package namespace App\Transformers;
 */
class ApostaTransformer extends TransformerAbstract
{
    /**
     * Transform the Aposta entity.
     *
     * @param \App\Entities\Aposta $model
     *
     * @return array
     */
    public function transform(Aposta $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
