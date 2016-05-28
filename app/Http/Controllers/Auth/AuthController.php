<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers,ThrottlesLogins
    {
    }
    

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    
    //====
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
    	$validator = $this->validator($request->all());
    
    	if ($validator->fails()) {
    		$this->throwValidationException(
    				$request, $validator
    				);
    	}
    
    	//Auth::guard($this->getGuard())->login($this->create($request->all()));
    
    	return redirect($this->redirectPath());
    }
    
    //===

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
    	if (property_exists($this, 'redirectPath')) {
    		return $this->redirectPath;
    	}
    
    	return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
    
    
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
    	return $this->login($request);
    }
    
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
    	$this->validateLogin($request);
    
    	// If the class is using the ThrottlesLogins trait, we can automatically throttle
    	// the login attempts for this application. We'll key this by the username and
    	// the IP address of the client making these requests into this application.
    	$throttles = $this->isUsingThrottlesLoginsTrait();
    
    	if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
    		$this->fireLockoutEvent($request);
    
    		return $this->sendLockoutResponse($request);
    	}
    
    	$credentials = $this->getCredentials($request);
    
    	if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
    		return $this->handleUserWasAuthenticated($request, $throttles);
    	}
    
    	// If the login attempt was unsuccessful we will increment the number of attempts
    	// to login and redirect the user back to the login form. Of course, when this
    	// user surpasses their maximum number of attempts they will get locked out.
    	if ($throttles && ! $lockedOut) {
    		$this->incrementLoginAttempts($request);
    	}
    
    	return $this->sendFailedLoginResponse($request);
    }
    
    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
    	if ($throttles) {
    		$this->clearLoginAttempts($request);
    	}
    
    	if (method_exists($this, 'authenticated')) {
    		return $this->authenticated($request, Auth::guard($this->getGuard())->user());
    	}
    
    	return redirect()->intended($this->redirectPath());
    }
    
    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
    	return redirect()->back()
    	->withInput($request->only($this->loginUsername(), 'remember'))
    	->withErrors([
    			$this->loginUsername() => $this->getFailedLoginMessage(),
    	]);
    }
    
    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
    	Auth::guard($this->getGuard())->logout();
    
    	return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
