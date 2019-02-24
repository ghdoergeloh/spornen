<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\Project;
use App\Domain\Model\Sponsor\Projectlist;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\Session\Session;
use function redirect;
use function view;

class AdmPlstController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('verified');
		$this->middleware('role:admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projectlists = Projectlist::all();
		return view('projectlists.index')->with('projectlists', $projectlists);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('projectlists.create');
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
		$validator = Projectlist::validator($attributes);
		$validator->validate();
//Save
		$projectlist = Projectlist::create($attributes);
//redirect
		return redirect()->route('projectlist.edit', $projectlist);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Projectlist  $projectlist
	 * @return Response
	 */
	public function show(Projectlist $projectlist)
	{
		return redirect()->route('projectlist.edit', $projectlist);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Projectlist  $projectlist
	 * @return Response
	 */
	public function edit(Projectlist $projectlist)
	{
		$otherprojects = Project::whereNotIn('id',$projectlist->projects()->pluck('project_id'))->get();
		return view('projectlists.edit')->with('projectlist', $projectlist)
						->with('otherprojects', $otherprojects);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  Projectlist  $projectlist
	 * @return Response
	 */
	public function update(Request $request, Projectlist $projectlist)
	{
		$attributes = $request->all();
//Validate
		$validator = Projectlist::validator($attributes);
		$validator->validate();
//Save
		$projectlist->fill($attributes);
		$projectlist->save();
//redirect
		return redirect()->route('projectlist.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Projectlist  $projectlist
	 * @return Response
	 */
	public function destroy(Projectlist $projectlist)
	{
		try {
			$projectlist->delete();
		} catch (QueryException $exc) {
			Session::flash('messages-danger', new MessageBag(["Das Projekt konnte nicht gelöscht werden. Vermutlich wurde es schon einmal verwendet."]));
		} finally {
			return redirect()->route('projectlist.index');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  Projectlist  $projectlist
	 * @return Response
	 */
	public function addProjects(Request $request, Projectlist $projectlist)
	{
		$projects = $request->input('projects');
		$projectlist->projects()->syncWithoutDetaching($projects);
		$projectlist->save();
		return redirect()->route('projectlist.edit', $projectlist);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  Projectlist  $projectlist
	 * @return Response
	 */
	public function removeProjects(Request $request, Projectlist $projectlist)
	{
		$projects = $request->input('projects');
		$projectlist->projects()->toggle($projects);
		$projectlist->save();
		return redirect()->route('projectlist.edit', $projectlist);
	}

}
