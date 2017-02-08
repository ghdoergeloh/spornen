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
		$runparts = RunParticipation::where('user_id', $user->id)->take(10)->get();
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
		$data['sponsored_run_id'] = $run->id;
		$user = Auth::user();
		$data['user_id'] = $user->id;
		$runpart = RunParticipation::where($data)->first();
		if ($runpart == null) {
			$data['project_id'] = 0;
			$runpart = RunParticipation::create($data);
		}
		return redirect()->route('runpart.show', $runpart->sponsored_run_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $runId
	 * @return Response
	 */
	public function show($runId)
	{
		$user = Auth::user();
		$runpart = RunParticipation::where('sponsored_run_id', $runId)->where('user_id', $user->id)->first();
		return view('runpart.show')->with('runpart', $runpart);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $runId
	 * @return Response
	 */
	public function edit($runId)
	{
		$user = Auth::user();
		$runpart = RunParticipation::where('sponsored_run_id', $runId)->where('user_id', $user->id)->first();
		// check if the Run hs already been
		if ($runpart->sponsoredRun->isElapsed()) {
			return redirect()->route('runpart.show', [$runId]);
		}
		return view('runpart.edit')
						->with('projects', $this->getProjectsSelection())
						->with('runpart', $runpart)
						->with('laps', $runpart->laps);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  int  $runId
	 * @return Response
	 */
	public function update(Request $request, $runId)
	{
		$run = SponsoredRun::find($runId);
		$data['sponsored_run_id'] = $run->id;
		$user = Auth::user();
		$data['user_id'] = $user->id;
		$runpart = RunParticipation::where($data)->first();
		if ($runpart == null) {
			redirect('home');
		}
		if ($runpart->sponsoredRun->isElapsed()) {
			return redirect()->route('runpart.show', [$runId]);
		}
		$project = Project::find($request->get('project'));
		$runpart->project()->associate($project);
		$runpart->save();
		Session::flash('messages-success', new MessageBag(["Erfolgreich gespeichert"]));
		return redirect()->route('runpart.edit', $runId);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $runId
	 * @return Response
	 */
	public function destroy($runId)
	{
		//
	}

	public function calculate(Request $request, $runId)
	{
		$validator = $this->validatorLaps($request->all());
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
		$user = Auth::user();
		$runpart = RunParticipation::where('sponsored_run_id', $runId)->where('user_id', $user->id)->first();
		// check if the Run hs already been
		if ($runpart->sponsoredRun->isElapsed()) {
			return redirect()->route('runpart.show', [$runId]);
		}
		$laps = intval($request->laps);
		$sum = $runpart->calculateSum($laps);
		return view('runpart.edit')
						->with('projects', $this->getProjectsSelection())
						->with('runpart', $runpart)
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
