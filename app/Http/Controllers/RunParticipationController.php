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
		$runparts = RunParticipation::where('user_id', $user->id)->orderBy('id','desc')->take(10)->get();
		return view('runpart.index')->with('runparts', $runparts);
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
		$runParticipation = RunParticipation
				::where('sponsored_run_id',$run->id)
				->where('user_id',$user->id)->first();
		if ($runParticipation == null) {
			$runParticipation = new RunParticipation();
			$runParticipation->sponsoredRun()->associate($run);
			$runParticipation->user()->associate($user);
			$runParticipation->project_id = 0;
			$runParticipation->save();
		}
		return redirect()->route('runpart.edit', $runParticipation->sponsored_run_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  RunParticipation  $runParticipation
	 * @return Response
	 */
	public function show(RunParticipation $runParticipation)
	{
		return view('runpart.show')->with('runpart', $runParticipation);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  RunParticipation  $runParticipation
	 * @return Response
	 */
	public function edit(RunParticipation $runParticipation)
	{
		// check if the Run hs already been
		if ($runParticipation->sponsoredRun->isElapsed()) {
			return redirect()->route('runpart.show', [$runParticipation->sponsored_run_id]);
		}
		return view('runpart.edit')
						->with('projects', $this->getProjectsSelection())
						->with('runpart', $runParticipation)
						->with('laps', $runParticipation->laps);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  RunParticipation  $runParticipation
	 * @return Response
	 */
	public function update(Request $request, RunParticipation $runParticipation)
	{
		if ($runParticipation->sponsoredRun->isElapsed()) {
			return redirect()->route('runpart.show', [$runParticipation->sponsored_run_id]);
		}
		$project = Project::find($request->get('project'));
		$runParticipation->project()->associate($project);
		$runParticipation->save();
		Session::flash('messages-success', new MessageBag(["Erfolgreich gespeichert"]));
		return redirect()->route('runpart.edit', $runParticipation->sponsored_run_id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  RunParticipation  $runParticipation
	 * @return Response
	 */
	public function destroy(RunParticipation $runParticipation)
	{
		//
	}

	public function calculate(Request $request, RunParticipation $runParticipation)
	{
		$validator = $this->validatorLaps($request->all());
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
		// check if the Run hs already been
		if ($runParticipation->sponsoredRun->isElapsed()) {
			return redirect()->route('runpart.show', [$runParticipation->sponsored_run_id]);
		}
		$laps = intval($request->laps);
		$sum = $runParticipation->calculateDonationSum($laps);
		return view('runpart.edit')
						->with('projects', $this->getProjectsSelection())
						->with('runpart', $runParticipation)
						->with('laps', $laps)
						->with('sum', $sum);
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
