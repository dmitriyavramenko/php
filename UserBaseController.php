<?php
namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller;

class UserBaseController extends Controller
{
    public $user;
    public function __construct()
    {
        $user = \Auth::guard('user')->user();
        \View::share('user',$user);
        $this->user = $user;
    }
}