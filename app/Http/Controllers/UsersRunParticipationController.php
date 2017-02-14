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

class UsersRunParticipationController extends Controller
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
		$run = SponsoredRun::find($request->get('run_id'));
		$user = Auth::user();
		$runpart = RunParticipation
						::where('sponsored_run_id', $run->id)
						->where('user_id', $user->id)->first();
		if ($runpart == null) {
			$runpart = new RunParticipation();
			$runpart->sponsoredRun()->associate($run);
			$runpart->user()->associate($user);
			$runpart->project_id = 0;
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
		return view('runparts.edit')
						->with('projects', $this->getProjectsSelection())
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
		$project = Project::find($request->get('project'));
		$runpart->project()->associate($project);
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
		$validator = $this->validatorLaps($request->all());
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
		// check if the Run hs already been
		if ($runpart->sponsoredRun->isElapsed()) {
			return redirect()->route('runpart.show', [$runpart->id]);
		}
		$laps = intval($request->laps);
		$sum = $runpart->calculateDonationSum($laps);
		return view('runparts.edit')
						->with('projects', $this->getProjectsSelection())
						->with('runpart', $runpart)
						->with('laps', $laps)
						->with('sum', $sum)
						->with('root_route', $this->root_route)
						->with('root_route_params', [$runpart->id]);
	}

	private function validatorLaps(array $data)
	{
		return Validator::make($data, [
					'laps' => 'required|integer|min:0'
		]);
	}

	private function getProjectsSelection()
	{
		$projects = Project::orderBy('scope', 'asc')->orderBy('name', 'asc')->get();
		$projectsSelection = array();
		foreach ($projects as $project) {
			switch ($project->scope) {
				case 'project':
					$scope = ' (Projekt)';
					break;
				case 'person':
					$scope = ' (Person)';
					break;
				default:
					$scope = '';
					break;
			}
			$projectsSelection[$project->id] = $project->name . $scope;
		}
		return $projectsSelection;
	}

}
