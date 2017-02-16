<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\Evaluation;
use App\Domain\Model\Sponsor\SponsoredRun;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use function redirect;
use function view;

class SponsoredRunController extends Controller
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
		$validator = $this->validator($attributes);
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
