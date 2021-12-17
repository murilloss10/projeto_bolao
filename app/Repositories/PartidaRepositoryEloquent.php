<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PartidaRepository;
use App\Entities\Partida;
use App\Validators\PartidaValidator;

/**
 * Class PartidaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PartidaRepositoryEloquent extends BaseRepository implements PartidaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Partida::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PartidaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
