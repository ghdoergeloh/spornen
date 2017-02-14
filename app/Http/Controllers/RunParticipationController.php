<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\Project;
use App\Domain\Model\Sponsor\RunParticipation;
use App\Domain\Model\Sponsor\SponsoredRun;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class RunParticipationController extends Controller
{

	private $root_route = 'sponrun.';

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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(SponsoredRun $sponrun)
	{
		return redirect()->route('sponrun.show', [$sponrun->id]);
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
	public function store(Request $request, SponsoredRun $sponrun)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  RunParticipation  $runpart
	 * @return Response
	 */
	public function show(SponsoredRun $sponrun, RunParticipation $runpart)
	{
		return view('runparts.show')->with('runpart', $runpart)
						->with('root_route', $this->root_route)
						->with('root_route_params', [$sponrun->id, $runpart->id]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  RunParticipation  $runpart
	 * @return Response
	 */
	public function edit(SponsoredRun $sponrun, RunParticipation $runpart)
	{
		return view('runparts.edit')
						->with('projects', Project::getProjectsSelection())
						->with('runpart', $runpart)
						->with('adminview', true)
						->with('laps', $runpart->laps)
						->with('root_route', $this->root_route)
						->with('root_route_params', [$sponrun->id, $runpart->id]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  RunParticipation  $runpart
	 * @return Response
	 */
	public function update(Request $request, SponsoredRun $sponrun, RunParticipation $runpart)
	{
		$data = $request->all();
		$validator = $this->validator($data);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
		$project = Project::find($request->get('project'));
		$runpart->project()->associate($project);
		$runpart->fill($data);
		$runpart->save();
		Session::flash('messages-success', new MessageBag(["Erfolgreich gespeichert"]));
		return redirect()->route('sponrun.runpart.edit', [$sponrun->id, $runpart->id]);
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

	private function validator(array $data)
	{
		return Validator::make($data, [
					'laps' => 'required|integer|min:0'
		]);
	}
}
