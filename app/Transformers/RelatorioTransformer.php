<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Relatorio;

/**
 * Class RelatorioTransformer.
 *
 * @package namespace App\Transformers;
 */
class RelatorioTransformer extends TransformerAbstract
{
    /**
     * Transform the Relatorio entity.
     *
     * @param \App\Entities\Relatorio $model
     *
     * @return array
     */
    public function transform(Relatorio $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
