<?php
namespace App\Http\Services;
use App\Http\Services\BaseService;

use App\Models\Company;

class CompanyService extends BaseService
{
    /**
     * Create a new UserService service instance.
     *
     * @return void
     */
    public function __construct( Company $model )
    {
        $this->model = $model;
        $this->path = 'companies/imgs/';
    }
}