<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;

class AccountController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show()
	{
		return redirect()->route('user.edit');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		$user = Auth::guard()->getUser();
		return view('account.edit')->with('user', $user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function update(Request $request)
	{
		$validator = $this->validator($request->all());
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}

		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->street = $request->street;
		$user->housenumber = $request->housenumber;
		$user->postcode = $request->postcode;
		$user->city = $request->city;
		$user->birthday = $request->birthday;
		$user->gender = $request->gender;
		$user->phone = $request->phone;
		$user->password = $request->password;
		$user->save();
		$user = Auth::guard()->getUser();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		//
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
					'firstname' => 'required|max:255',
					'lastname' => 'required|max:255',
					'street' => 'required|max:255',
					'housenumber' => ['required', 'regex:/^\d+ *[a-zA-Z]*$/', 'max:31'],
					'postcode' => 'required|numeric|between:0,99999',
					'city' => 'required|max:255',
					'birthday' => 'required|date',
					'gender' => 'required|in:m,f',
					'phone' => 'required|phone:AUTO,DE',
					'password' => 'required|min:6|confirmed',
		]);
	}

}
