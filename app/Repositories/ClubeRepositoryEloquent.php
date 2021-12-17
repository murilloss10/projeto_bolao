<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ClubeRepository;
use App\Entities\Clube;
use App\Validators\ClubeValidator;

/**
 * Class ClubeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ClubeRepositoryEloquent extends BaseRepository implements ClubeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Clube::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ClubeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
