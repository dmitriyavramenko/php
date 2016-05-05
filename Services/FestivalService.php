<?php
namespace App\Http\Services;
use App\Http\Services\BaseService;

use App\Models\Festival;

class FestivalService extends BaseService
{
    /**
     * Create a new FestivalService service instance.
     *
     * @return void
     */
    public function __construct(Festival $model)
    {
        $this->model = $model;
         $this->path = 'festivals/imgs/';
    }
}

