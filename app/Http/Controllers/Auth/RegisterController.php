<?php
namespace App\Http\Controllers\Auth;

use App\Domain\Model\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Notifications\VerifyEmail;

class RegisterController extends Controller
{
	/*
	 * |--------------------------------------------------------------------------
	 * | Register Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * | This controller handles the registration of new users as well as their
	 * | validation and creation. By default this controller uses a trait to
	 * | provide this functionality without requiring any additional code.
	 * |
	 * | Two Controller-Methodes registered by Illuminate\Routing\Router::auth()
	 * | * showRegistrationForm()
	 * | * register()
	 * | And one custom Method
	 * | * confirm
	 * |
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
	 * @param array $data
	 * @return Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data,
			[
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
				'password' => 'required|min:6|confirmed'
			]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param array $data
	 * @return User
	 */
	protected function create(array $data, $confirmed, $confirmation_code)
	{
		$data['password'] = Hash::make($data['password']);
		$data['birthday'] = strtotime($data['birthday']);
		$user = new User($data);
		$user->email = $data['email'];
		$user->confirmed = false;
		$user->confirmation_code = $confirmation_code;
		$user->save();
		return $user;
	}

	public function confirm(Request $request, $confirmation_code)
	{
		if (is_null($confirmation_code)) {
			return redirect($this->redirectPath());
		}

		$email = $request->input('email');
		$user = User::where('email', '=', $email)->where('confirmation_code', '=',
			$confirmation_code)->first();

		if (! is_null($user)) {
			$user->confirmed = 1;
			$user->confirmation_code = null;
			$user->save();
			Session::flash('messages-success',
				new MessageBag([
					"Die E-Mail-Adresse wurde bestätigt."
				]));
			$this->guard()->login($user);
			return redirect('home');
		}
		return redirect($this->redirectPath());
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function register(Request $request)
	{
		$this->validator($request->all())
			->validate();

		$confirmation_code = str_random(30);
		$user = $this->create($request->all(), false, $confirmation_code);
		event(new Registered($user));

		$user->notify(new VerifyEmail($confirmation_code));

		return view('auth.registerEmailSend');
	}
}
