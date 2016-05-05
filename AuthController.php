<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * 
     * 
     * @vars Auth::guard $user,$company,$festival
     */
    private $user,$company,$festival;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user     = Auth::guard('user');
        $this->company  = Auth::guard('company');
        $this->festival = Auth::guard('festival');
    }

    /**
     * Show login page
     * 
     * @return view
     */
    public function getLogin()
    {
        return view('auth/login');
    }

    /**
     * Show login page
     * 
     * @return view
     */
    public function getRegister(AuthService $authService)
    {
        $countries = $authService->getCountries();
        return view('auth/register',['countries'=>$countries]);
    }

    /**
     * User login by role
     *
     * @return redirect
     */
    public function postLogin(LoginRequest $request, AuthService $authService)
    {
        $role = $request->get('role');
        if($this->$role->attempt($request->except('_token','role')))
            return redirect($role)->with('success','Successfully logged in !!!!');
        return back()->withErrors('Incorrect email or password');
    }

    /**
     * Registering user by role
     *
     * @param AuthService $authService
     * @param UserService $userService
     * @return redirect
     */
    public function postRegister(RegisterRequest $request, AuthService $authService)
    {
        $role = $request->get('role');
        $serviceNamespace = 'App\Http\Services\\'.ucfirst($role).'Service';
        $service = \App::make($serviceNamespace);
        $registerMethod = $role.'Regiter';
        if($model = $authService->$registerMethod( $this->$role, $service, $request->except('_token','role')));
        {
            if(isset($model['success']) && !$model['success'])
                return back ()->withErrors ($model['message']);
            $this->$role->login($model);
            return redirect($role)->with('success','Successfully registered!!!');
        }
        return back()->withErrors('Something wet wrong.Pleas try again!!!');
    }

    /**
     * Registering user by role
     * 
     * @param AuthService $authService
     * @param UserService $userService
     * @return redirect
     */
    public function getLogout($user = false)
    {
        if(!$user)
        {
            $this->user->logout();
            $this->company->logout();
            $this->festival->logout();
        }
        else
            $this->$user->logout();
        return redirect('auth/login');
    }
}
