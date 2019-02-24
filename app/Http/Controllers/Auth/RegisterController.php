<?php
namespace App\Http\Controllers\Auth;

use App\Domain\Model\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
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
	protected function create(array $data)
	{
		$data['password'] = Hash::make($data['password']);
		$data['birthday'] = strtotime($data['birthday']);
		$user = new User($data);
		$user->email = $data['email'];
		$user->save();
		return $user;
	}
}
