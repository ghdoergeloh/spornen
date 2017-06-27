<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\Project;
use Illuminate\Http\Request;

class AdmProjController extends Controller
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
		$this->middleware('role:admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = Project::all();
		return view('projects.index')
						->with('projects', $projects)
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
		return view('projects.create')
						->with('root_route', $this->root_route)
						->with('root_route_params', []);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$attributes = $request->all();
//Validate
		$validator = Project::validator($attributes);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
//Save
		$attributes['begin'] = strtotime($attributes['begin']);
		$attributes['end'] = strtotime($attributes['end']);
		Project::create($attributes);
//redirect
		return redirect()->route('project.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function show(Project $project)
	{
		return view('projects.show')
						->with('project', $project)
						->with('root_route', $this->root_route)
						->with('root_route_params', [$project->id])
						->with('breadcrumbs',['project' => $project]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function edit(Project $project)
	{
		return view('projects.edit')
						->with('project', $project)
						->with('root_route', $this->root_route)
						->with('root_route_params', [$project->id])
						->with('breadcrumbs',['project' => $project]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  Project  $project
	 * @return Response
	 */
	public function update(Request $request, Project $project)
	{
		$attributes = $request->all();
//Validate
		$validator = Project::validator($attributes);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
//Save
		$attributes['begin'] = strtotime($attributes['begin']);
		$attributes['end'] = strtotime($attributes['end']);
		$project->fill($attributes);
		$project->save();
//redirect
		return redirect()->route('project.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function destroy(Project $project)
	{
		$project->delete();
		return redirect()->route('project.index');
	}

	public function evaluation(Project $project)
	{
		Excel::create('Auswertung ' . $project->name, function($excel) use($project) {
			$excel->sheet('Tabelle 1', function($sheet) use($project) {
				//$sheet->loadView('projects.evaluation')
				$sheet->fromArray($project->getEvaluation());
			});
		})->download('csv');
	}

}
