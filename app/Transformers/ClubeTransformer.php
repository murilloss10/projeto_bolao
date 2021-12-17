<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Clube;

/**
 * Class ClubeTransformer.
 *
 * @package namespace App\Transformers;
 */
class ClubeTransformer extends TransformerAbstract
{
    /**
     * Transform the Clube entity.
     *
     * @param \App\Entities\Clube $model
     *
     * @return array
     */
    public function transform(Clube $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
