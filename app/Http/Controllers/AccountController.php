<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
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
		$this->middleware('role:admin');
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
		$user = Auth::user();
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
		$user = Auth::user();
		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->street = $request->street;
		$user->housenumber = $request->housenumber;
		$user->postcode = $request->postcode;
		$user->city = $request->city;
		$user->birthday = strtotime($request->birthday);
		$user->gender = $request->gender;
		$user->phone = $request->phone;
		$user->save();
		Session::flash('messages-success', new MessageBag(["Erfolgreich gespeichert"])); 
		return redirect()->route('account.edit');
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
					'housenumber' => 'required|string|max:31',
					'postcode' => 'required|numeric|between:0,99999',
					'city' => 'required|max:255',
					'birthday' => 'required|date',
					'gender' => 'required|in:m,f',
					'phone' => 'required|phone:AUTO,DE',
		]);
	}

}
