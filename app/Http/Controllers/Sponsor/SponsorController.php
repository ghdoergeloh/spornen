<?php

namespace App\Http\Controllers\Sponsor;

use App\Domain\Model\Sponsor\RunParticipation;
use App\Domain\Model\Sponsor\Sponsor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
		$user = Auth::guard()->getUser();
		$runRarticipation = RunParticipation::where('sponsored_run_id', 1)->where('user_id', $user->id)->first();
		$sponsors = Sponsor::where('run_participation_id', $runRarticipation->id)->get();
		return view('/sponsors/list', ['sponsors' => $sponsors]);
	}

	/**
	 *  @return Response
	 */
	public function showEditView(Request $request)
	{
		
		$sponsorId = $request->input('sponsor');
		$sponsor = Sponsor::find($sponsorId);
		$runRarticipation = RunParticipation::find($sponsor->run_participation_id);
		$user = Auth::guard()->getUser();
		if ($runRarticipation->user_id == $user->id)
			return view('/sponsors/edit', ['sponsor' => $sponsor]);
	}

}
