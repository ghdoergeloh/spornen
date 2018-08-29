<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Domain\Model\Auth\User;

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
		'email' => 'email|max:255|unique:users',
		'password' => 'string|min:6|confirmed'
	];

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		return response()->json($user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$user = User::findOrFail($id);
		$request->validate($this->validation);
		$request->birthday = strtotime($request->birthday);

		$user->update($request->all());
		return response()->json($user);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function destroy()
	{
		//
	}
}
