<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\Project;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class AdmProjController extends Controller
{

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
		return view('projects.index')->with('projects', $projects);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('projects.create');
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
		$validator = Project::validatorCreate($attributes);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
//Save
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
		return redirect()->route('project.edit', $project);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function edit(Project $project)
	{
		return view('projects.edit')->with('project', $project);
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
		$validator = Project::validatorUpdate($attributes);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
//Save
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
		try {
			$project->delete();
		} catch (QueryException $exc) {
			Session::flash('messages-danger', new MessageBag(["Die Projektliste konnte nicht gelöscht werden. Vermutlich wurde sie schon einmal verwendet."]));
		} finally {
			return redirect()->route('project.index');
		}
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
