<?php

namespace App\Presenters;

use App\Transformers\RelatorioTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RelatorioPresenter.
 *
 * @package namespace App\Presenters;
 */
class RelatorioPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RelatorioTransformer();
    }
}
