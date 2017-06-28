<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\Projectlist;
use Illuminate\Http\Request;

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
		$this->middleware('role:admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$projectlists = Projectlist::all();
		return view('projectlists.index')->with('projectlists', $projectlists);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('projectlists.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$attributes = $request->all();
//Validate
		$validator = Projectlist::validator($attributes);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
//Save
		Projectlist::create($attributes);
//redirect
		return redirect()->route('projectlist.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Domain\Model\Sponsor\Projectlist  $projectlist
	 * @return \Illuminate\Http\Response
	 */
	public function show(Projectlist $projectlist)
	{
		return redirect()->route('projectlist.edit', $projectlist);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Domain\Model\Sponsor\Projectlist  $projectlist
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Projectlist $projectlist)
	{
		$otherprojects = \App\Domain\Model\Sponsor\Project::all();
		return view('projectlists.edit')->with('projectlist', $projectlist)
				->with('otherprojects', $otherprojects);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Domain\Model\Sponsor\Projectlist  $projectlist
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Projectlist $projectlist)
	{
		$attributes = $request->all();
//Validate
		$validator = Projectlist::validator($attributes);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
//Save
		$projectlist->fill($attributes);
		$projectlist->save();
//redirect
		return redirect()->route('projectlist.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Domain\Model\Sponsor\Projectlist  $projectlist
	 * @return \Illuminate\Http\Response
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

}
