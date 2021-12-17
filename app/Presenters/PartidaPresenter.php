<?php

namespace App\Presenters;

use App\Transformers\PartidaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PartidaPresenter.
 *
 * @package namespace App\Presenters;
 */
class PartidaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PartidaTransformer();
    }
}
