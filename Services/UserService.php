<?php
namespace App\Http\Services;
use App\Http\Services\BaseService;
use App\User;

class UserService extends BaseService
{
    /**
     * Create a new UserService service instance.
     *
     * @return void
     */
    public function __construct( User $model )
    {
        $this->model = $model;
        $this->path = 'users/imgs/';
    }
}

