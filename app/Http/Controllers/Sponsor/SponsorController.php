<?php

namespace App\Http\Controllers\Sponsor;

use App\Domain\Model\Sponsor\Sponsor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

/**
 * Description of Sponsor
 *
 * @author georg
 */
class SponsorController extends Controller
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
	 *  @return Response
	 */
	public function showListView()
	{
		$sponsors = Sponsor::all();
		return view('/sponsors/list', ['sponsors' => $sponsors]);
	}

}
