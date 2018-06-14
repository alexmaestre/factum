<?php
namespace Factum\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use VivaCMS\Models\User;
use VivaCMS\Models\UserLoginAttempt;
use VivaCMS\Models\UserConnection;
use VivaCMS\View\Menus;
use Session;
use Config;
use Auth;
use Validator;
use Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthFactum extends Controller
{
	
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the authentication of existing users. 
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login
     *
     * @var string
     */
    protected $redirectTo = '/';
	
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
	
    /**
     * Get Login
     *
     * @return Response
     */
    public function getLogin()
    {	
        if (Auth::attempt(['email' => mb_strtolower(trim(Request::get('loginEmail'))), 'password' => trim(Request::get('loginPassword'))],true)) {
			$user = Auth::user();
			$user->connections()->create(["ip"=>Request::ip()]);
			return redirect(layer_url());
        }else{
			$user = User::where('email',mb_strtolower(trim(Request::get('loginEmail'))))->first();
			if(!empty($user)){
				$user->login_attempts()->create(["ip"=>Request::ip()]);
			}
			return redirect(layer_url())->with('error','El email o la clave son incorrectos');
		}
    }	
	 
    /**
     * Get Logout
     *
     * @return Response
     */
    public function getLogout()
    {
		$redirect = layer_url();
        Auth::logout();
		Session::flush();
        return redirect($redirect);
    }		

}
