<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\RunParticipation;
use App\Domain\Model\Sponsor\Sponsor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user = Auth::guard()->getUser();
		$runRarticipation = RunParticipation::where('sponsored_run_id', 1)->where('user_id', $user->id)->first();
		$sponsors = Sponsor::where('run_participation_id', $runRarticipation->id)->get();
		return view('sponsors.list')->with('sponsors', $sponsors);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('sponsors.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		Sponsor::create($request->all());
		return redirect()->route('sponsor.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return redirect()->route('sponsor.index',$id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$sponsor = Sponsor::find($id);
		$runRarticipation = RunParticipation::find($sponsor->run_participation_id);
		$user = Auth::guard()->getUser();
		if ($runRarticipation->user_id != $user->id) {
			return redirect()->route('sponsor.index');
		}
		return view('sponsors.edit')->with('sponsor', $sponsor);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$sponsor = Sponsor::find($id);
		$runRarticipation = RunParticipation::find($sponsor->run_participation_id);
		$user = Auth::guard()->getUser();
		if ($runRarticipation->user_id != $user->id) {
			return redirect()->route('sponsor.index');
		}
		$sponsor->firstname = $request->firstname;
		$sponsor->lastname = $request->lastname;
		$sponsor->street = $request->street;
		$sponsor->housenumber = $request->housenumber;
		$sponsor->postcode = $request->postcode;
		$sponsor->city = $request->city;
		$sponsor->phone = $request->phone;
		$sponsor->email = $request->email;
		$sponsor->save();
		return redirect()->route('sponsor.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$sponsor = Sponsor::find($id);
		$runRarticipation = RunParticipation::find($sponsor->run_participation_id);
		$user = Auth::guard()->getUser();
		if ($runRarticipation->user_id != $user->id) {
			return redirect()->route('sponsor.index');
		}
		$sponsor->delete();
		return redirect()->route('sponsor.index');
	}

}
