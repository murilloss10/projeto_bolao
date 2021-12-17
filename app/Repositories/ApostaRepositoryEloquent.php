<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ApostaRepository;
use App\Entities\Aposta;
use App\Validators\ApostaValidator;

/**
 * Class ApostaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ApostaRepositoryEloquent extends BaseRepository implements ApostaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Aposta::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ApostaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
