<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Domain\Model\Auth\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\UserProvider;

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

use AuthenticatesAndRegistersUsers,
	ThrottlesLogins;

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
	 * @return Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
					'firstname' => 'required|max:255',
					'lastname' => 'required|max:255',
					'street' => 'required|max:255',
					'housenumber' => ['required','regex:/^\d+ *[a-zA-Z]*$/','max:31'],
					'postcode' => 'required|numeric|between:0,99999',
					'city' => 'required|max:255',
					'birthday' => 'required|date|before:heute',
					'gender' => 'required|in:m,f',
					'phone' => 'required|phone:AUTO,DE',
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
	protected function create(array $data, $confirmed, $confirmation_code)
	{
		return User::create([
					'firstname' => $data['firstname'],
					'lastname' => $data['lastname'],
					'street' => $data['street'],
					'housenumber' => $data['housenumber'],
					'postcode' => $data['postcode'],
					'city' => $data['city'],
					'birthday' => strtotime($data['birthday']),
					'gender' => $data['gender'],
					'phone' => $data['phone'],
					'email' => $data['email'],
					'password' => bcrypt($data['password']),
					'confirmed' => $confirmed,
					'confirmation_code' => $confirmation_code
		]);
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function register(Request $request)
	{
		$validator = $this->validator($request->all());
		Log::debug("Validating register Input");
		if ($validator->fails()) {
			Log::debug("Validation failed");
			$this->throwValidationException(
					$request, $validator
			);
		}
		Log::debug("Validation successful");

		$confirmation_code = str_random(30);

		$user = $this->create($request->all(), false, $confirmation_code);
		Log::debug($user);

		Mail::send('auth.emails.verify', ['confirmation_code' => $confirmation_code, 'email' => $user->email], function($message) use ($user) {
			$message->to($user->email, $user->firstname + $user->lastname)
					->subject('E-Mail Adresse bestätigen');
		});

		return view('auth.registerEmailSend');
	}

	public function confirm(Request $request, $confirmation_code)
	{
		if (is_null($confirmation_code)) {
			return redirect($this->redirectPath());
		}

		$email = $request->input('email');

		$credentials = [
			'email' => $email,
			'confirmation_code' => $confirmation_code
		];

//		Log::debug("Validating confirm Data");
//		$validator = $this->validator($credentials);
//
//		if ($validator->fails()) {
//			Log::debug("Validation failed");
//			$this->throwValidationException(
//					$request, $validator
//			);
//		}
//		Log::debug("Validation successful");

		$user = Auth::guard($this->getGuard())->getProvider()->retrieveByCredentials($credentials);

		if (is_null($user)) {
			return redirect($this->redirectPath());
		}

		$user->confirmed = 1;
		$user->confirmation_code = null;
		$user->save();
		Auth::guard($this->getGuard())->login($user);

		return redirect($this->redirectPath());
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  Request  $request
	 * @return Response
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
		$credentials['confirmed'] = true;

		if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
			return $this->handleUserWasAuthenticated($request, $throttles);
		}

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		if ($throttles && !$lockedOut) {
			$this->incrementLoginAttempts($request);
		}

		return $this->sendFailedLoginResponse($request);
	}

}
