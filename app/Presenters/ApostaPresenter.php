<?php

namespace App\Presenters;

use App\Transformers\ApostaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ApostaPresenter.
 *
 * @package namespace App\Presenters;
 */
class ApostaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ApostaTransformer();
    }
}
