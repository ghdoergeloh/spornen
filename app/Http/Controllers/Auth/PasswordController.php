<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\Response;

class PasswordController extends Controller
{
	/*
	  |--------------------------------------------------------------------------
	  | Password Reset Controller
	  |--------------------------------------------------------------------------
	  |
	  | This controller is responsible for handling password reset requests
	  | and uses a simple trait to include this behavior. You're free to
	  | explore this trait and override any methods you wish to tweak.
	  |
	 */

use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware($this->guestMiddleware());
	}

	/**
	 * Get the response for after a successful password reset.
	 *
	 * @param  string  $response
	 * @return Response
	 */
	protected function getResetSuccessResponse($response)
	{
		return redirect($this->redirectPath())->with('messages-success', new MessageBag([trans($response)]));
	}

	/**
	 * Get the response for after the reset link has been successfully sent.
	 *
	 * @param  string  $response
	 * @return Response
	 */
	protected function getSendResetLinkEmailSuccessResponse($response)
	{
		return redirect()->back()->with('messages-success', new MessageBag([trans($response)]));
	}

}
