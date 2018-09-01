<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{
	/*
	 * |--------------------------------------------------------------------------
	 * | Login Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * | This controller handles authenticating users for the application and
	 * | redirecting them to your home screen. The controller uses a trait
	 * | to conveniently provide its functionality to your applications.
	 * |
	 * | Three Controller-Methodes registered by Illuminate\Routing\Router::auth()
	 * | * showLoginForm()
	 * | * login()
	 * | * logout()
	 * |
	 */

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', [
			'except' => 'logout'
		]);
	}

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param Request $request
	 * @return array
	 */
	protected function credentials(Request $request)
	{
		$credentials = $request->only($this->username(), 'password');
		$credentials['confirmed'] = true;
		return $credentials;
	}

	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	public function username()
	{
		return 'email';
	}

	/**
	 * Send the response after the user was authenticated.
	 *
	 * @param Request $request
	 * @return Response
	 */
	protected function sendLoginResponse(Request $request)
	{
		if ($request->hasSession()) {
			$request->session()->regenerate();
		}

		$this->clearLoginAttempts($request);

		return $this->authenticated($request, $this->guard()
			->user()) ?: redirect()->intended($this->redirectPath());
	}

	/**
	 * The user has been authenticated.
	 *
	 * @param Request $request
	 * @param mixed $user
	 * @return mixed
	 */
	protected function authenticated(Request $request, $user)
	{
		if ($request->wantsJson()) {
			return response()->json($user);
		}
		return;
	}
}
