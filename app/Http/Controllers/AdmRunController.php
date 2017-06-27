<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\SponsoredRun;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class AdmRunController extends Controller
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
		$sponruns = SponsoredRun::orderBy('begin', 'desc')->get();
		return view('sponruns.index')
						->with('sponruns', $sponruns)
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
		return view('sponruns.create')
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
		$validator = SponsoredRun::validator($attributes);
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
	 * @param  SponsoredRun  $sponrun
	 * @return Response
	 */
	public function show(SponsoredRun $sponrun)
	{
		return view('sponruns.show')
						->with('sponrun', $sponrun)
						->with('root_route', $this->root_route)
						->with('root_route_params', [$sponrun->id])
						->with('breadcrumbs',['sponrun' => $sponrun]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  SponsoredRun  $sponrun
	 * @return Response
	 */
	public function edit(SponsoredRun $sponrun)
	{
		return view('sponruns.edit')
						->with('sponrun', $sponrun)
						->with('root_route', $this->root_route)
						->with('root_route_params', [$sponrun->id])
						->with('breadcrumbs',['sponrun' => $sponrun]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  SponsoredRun  $sponrun
	 * @return Response
	 */
	public function update(Request $request, SponsoredRun $sponrun)
	{
		$attributes = $request->all();
//Validate
		$validator = SponsoredRun::validator($attributes);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
//Save
		$attributes['begin'] = strtotime($attributes['begin']);
		$attributes['end'] = strtotime($attributes['end']);
		$sponrun->fill($attributes);
		$sponrun->save();
//redirect
		return redirect()->route('sponrun.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  SponsoredRun  $sponrun
	 * @return Response
	 */
	public function destroy(SponsoredRun $sponrun)
	{
		$sponrun->delete();
		return redirect()->route('sponrun.index');
	}

	public function evaluation(SponsoredRun $sponrun)
	{
		Excel::create('Auswertung ' . $sponrun->name, function($excel) use($sponrun) {
			$excel->sheet('Tabelle 1', function($sheet) use($sponrun) {
				//$sheet->loadView('sponruns.evaluation')
				$sheet->fromArray($sponrun->getEvaluation());
			});
		})->download('csv');
	}

	public function close(SponsoredRun $sponrun)
	{
		$sponrun->closed = true;
		$sponrun->save();
		return redirect()->route('sponrun.index');
	}

	public function reopen(SponsoredRun $sponrun)
	{
		$sponrun->closed = false;
		$sponrun->save();
		return redirect()->route('sponrun.index');
	}

}
