<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Model\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Validation\Validator as Validator2;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Mail;
use Symfony\Component\HttpFoundation\Request as Request2;

class RegisterController extends Controller
{
	/*
	  |--------------------------------------------------------------------------
	  | Register Controller
	  |--------------------------------------------------------------------------
	  |
	  | This controller handles the registration of new users as well as their
	  | validation and creation. By default this controller uses a trait to
	  | provide this functionality without requiring any additional code.
	  |
	 */

use RegistersUsers;

	/**
	 * Where to redirect users after registration.
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
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return Validator2
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
					'firstname' => 'required|max:255',
					'lastname' => 'required|max:255',
					'street' => 'required|max:255',
					'housenumber' => 'required|string|max:31',
					'postcode' => 'required|numeric|between:0,99999',
					'city' => 'required|max:255',
					'birthday' => 'required|date',
					'gender' => 'required|in:m,f',
					'phone' => 'nullable|phone:AUTO,DE',
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
		\Illuminate\Support\Facades\Log::info($data);
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

	public function confirm(Request2 $request, $confirmation_code)
	{
		if (is_null($confirmation_code)) {
			return redirect($this->redirectPath());
		}

		$email = $request->input('email');
		$user = User::where('email','=', $email)->where('confirmation_code', '=', $confirmation_code)->first();

		if (!is_null($user)) {
			$user->confirmed = 1;
			$user->confirmation_code = null;
			$user->save();
			Session::flash('messages-success', new MessageBag(["Die E-Mail-Adresse wurde bestätigt. Du kannst dich jetzt anmelden."]));
			return view('auth.login');
		}
		return redirect($this->redirectPath());
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function register(Request2 $request)
	{
		$this->validator($request->all())->validate();

		$confirmation_code = str_random(30);
		$user = $this->create($request->all(), false, $confirmation_code);
		event(new Registered($user));

		Mail::send('auth.emails.verify', ['confirmation_code' => $confirmation_code, 'email' => $user->email], function($message) use ($user) {
			$message->to($user->email, $user->firstname + $user->lastname)
					->subject('E-Mail Adresse bestätigen');
		});

		return view('auth.registerEmailSend');
	}

}
