<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\RunParticipation;
use App\Domain\Model\Sponsor\SponsoredRun;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class UserRunPartController extends Controller
{

	private $root_route = '';

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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$runparts = RunParticipation::where('user_id', $user->id)->orderBy('id', 'desc')->take(10)->get();
		return view('runparts.index')
						->with('runparts', $runparts)
						->with('root_route', $this->root_route)
						->with('root_route_params', []);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$sponrun = SponsoredRun::find($request->get('run_id'));
		if ($sponrun->isElapsed()) {
			abort(404);
		}
		$user = Auth::user();
		$runpart = RunParticipation
						::where('sponsored_run_id', $sponrun->id)
						->where('user_id', $user->id)->first();
		if ($runpart == null) {
			$runpart = new RunParticipation();
			$runpart->sponsoredRun()->associate($sponrun);
			$runpart->user()->associate($user);
			$runpart->hash = md5(microtime());
			$runpart->save();
		}
		return redirect()->route('runpart.edit', $runpart->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  RunParticipation  $runpart
	 * @return Response
	 */
	public function show(RunParticipation $runpart)
	{
		return view('runparts.show')->with('runpart', $runpart)
						->with('root_route', $this->root_route)
						->with('root_route_params', [$runpart->id]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  RunParticipation  $runpart
	 * @return Response
	 */
	public function edit(RunParticipation $runpart)
	{
		// check if the Run hs already been
		if ($runpart->sponsoredRun->isElapsed()) {
			return redirect()->route('runpart.show', [$runpart->id]);
		}

		$projectsSelection = $runpart->sponsoredRun->getProjectSelection();

		return view('runparts.edit')
						->with('projects', $projectsSelection)
						->with('runpart', $runpart)
						->with('laps', $runpart->laps)
						->with('root_route', $this->root_route)
						->with('root_route_params', [$runpart->id]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  RunParticipation  $runpart
	 * @return Response
	 */
	public function update(Request $request, RunParticipation $runpart)
	{
		if ($runpart->sponsoredRun->isElapsed()) {
			return redirect()->route('runpart.show', [$runpart->sponsored_run_id]);
		}
		$attributes = $request->all();
		$validator = RunParticipation::validator($attributes);
		$validator->validate();

		// check if the Run has already been
		$runpart->fill($attributes);
		$runpart->save();
		Session::flash('messages-success', new MessageBag(["Erfolgreich gespeichert"]));
		return redirect()->route('runpart.edit', $runpart->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  RunParticipation  $runpart
	 * @return Response
	 */
	public function destroy(RunParticipation $runpart)
	{
		//
	}

	public function calculate(Request $request, RunParticipation $runpart)
	{
	    $validator = RunParticipation::validator($request->all());
	    $validator->validate();
		// check if the Run hs already been
		if ($runpart->sponsoredRun->isElapsed()) {
			return redirect()->route('runpart.show', [$runpart->id]);
		}

		$projectsSelection = $runpart->sponsoredRun->getProjectSelection();

		$laps = intval($request->laps);
		$sum = $runpart->calculateDonationSum($laps);
		return view('runparts.edit')
						->with('projects', $projectsSelection)
						->with('runpart', $runpart)
						->with('laps', $laps)
						->with('sum', $sum)
						->with('root_route', $this->root_route)
						->with('root_route_params', [$runpart->id]);
	}

}
