<?php

namespace App\Presenters;

use App\Transformers\ClubeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ClubePresenter.
 *
 * @package namespace App\Presenters;
 */
class ClubePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ClubeTransformer();
    }
}
