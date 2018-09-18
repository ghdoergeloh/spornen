<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccoController extends Controller
{
	
	private $validation = [
		'firstname' => 'string|max:255',
		'lastname' => 'string|max:255',
		'street' => 'string|max:255',
		'housenumber' => 'string|max:31',
		'postcode' => 'numeric|between:0,99999',
		'city' => 'string|max:255',
		'birthday' => 'date',
		'gender' => 'in:m,f',
		'phone' => 'nullable|phone:AUTO,DE',
	];

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
		$user = Auth::user();
		$request->validate($this->validation);
		$request->birthday = strtotime($request->birthday);
		
		$user->update($request->all());
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

}
