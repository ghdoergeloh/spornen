<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\SponsoredRun;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class SponsoredRunController extends Controller
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
		$sponruns = SponsoredRun::orderBy('begin', 'desc')->get();
		return view('sponruns.index')->with('sponruns', $sponruns);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('sponruns.create');
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
		$validator = $this->validator($attributes);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
		//Save
		$attributes['begin'] = strtotime($attributes['begin']);
		$attributes['end'] = strtotime($attributes['end']);
		SponsoredRun::create($attributes);
		//redirect
		return redirect()->route('sponrun.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  SponsoredRun  $sponsoredRun
	 * @return Response
	 */
	public function show(SponsoredRun $sponsoredRun)
	{
		return view('sponruns.show')->with('sponrun', $sponsoredRun)->with('participantsCount', $sponsoredRun->participants_count);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  SponsoredRun  $sponsoredRun
	 * @return Response
	 */
	public function edit(SponsoredRun $sponsoredRun)
	{
		return view('sponruns.edit')->with('sponrun', $sponsoredRun);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  SponsoredRun  $sponsoredRun
	 * @return Response
	 */
	public function update(Request $request, SponsoredRun $sponsoredRun)
	{
		$attributes = $request->all();
		//Validate
		$validator = $this->validator($attributes);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
		//Save
		$attributes['begin'] = strtotime($attributes['begin']);
		$attributes['end'] = strtotime($attributes['end']);
		$sponsoredRun->fill($attributes);
		$sponsoredRun->save();
		//redirect
		return redirect()->route('sponrun.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  SponsoredRun  $sponsoredRun
	 * @return Response
	 */
	public function destroy(SponsoredRun $sponsoredRun)
	{
		$sponsoredRun->delete();
		return redirect()->route('sponrun.index');
	}

	private function validator(array $data)
	{
		return Validator::make($data, [
					'name' => 'required|max:255',
					'begin' => 'required|date',
					'end' => 'required|date',
					'street' => 'nullable|max:255',
					'housenumber' => 'nullable|string|max:31',
					'postcode' => 'nullable|numeric|between:0,99999',
					'city' => 'nullable|max:255',
					'description' => 'nullable|max:255'
		]);
	}

}
