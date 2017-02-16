<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\RunParticipation;
use App\Domain\Model\Sponsor\Sponsor;
use App\Domain\Model\Sponsor\SponsoredRun;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;
use function redirect;
use function view;

class SponsorController extends Controller
{

	private $root_route = 'sponrun.runpart.';

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
	public function index(SponsoredRun $sponrun, RunParticipation $runpart)
	{
		return redirect()->route('sponrun.runpart.edit', [$sponrun->id, $runpart->id]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(SponsoredRun $sponrun, RunParticipation $runpart)
	{
		return view('sponsors.create')
						->with('root_route', $this->root_route)
						->with('root_route_params', [$sponrun->id, $runpart->id])
						->with('breadcrumbs',['sponrun' => $sponrun, 'runpart' => $runpart ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request, SponsoredRun $sponrun, RunParticipation $runpart)
	{
		$attributes = $request->all();
		$validator = $this->validator($attributes);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}

		$user = Auth::user();
		$sponsor = new Sponsor();
		$sponsor->user()->associate($user);
		$sponsor->runParticipation()->associate($runpart);
		$sponsor->fill($attributes);
		$sponsor->save();
		return redirect()->route('sponrun.runpart.sponsor.index', [$sponrun->id, $runpart->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Sponsor  $sponsor
	 * @return Response
	 */
	public function show(SponsoredRun $sponrun, RunParticipation $runpart, Sponsor $sponsor)
	{
		return view('sponsors.show')
						->with('sponsor', $sponsor)
						->with('root_route', $this->root_route)
						->with('root_route_params', [$sponrun->id, $runpart->id])
						->with('breadcrumbs',['sponrun' => $sponrun, 'runpart' => $runpart, 'sponsor' => $sponsor ]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Sponsor  $sponsor
	 * @return Response
	 */
	public function edit(SponsoredRun $sponrun, RunParticipation $runpart, Sponsor $sponsor)
	{
		return view('sponsors.edit')
						->with('sponsor', $sponsor)
						->with('root_route', $this->root_route)
						->with('root_route_params', [$sponrun->id, $runpart->id])
						->with('breadcrumbs',['sponrun' => $sponrun, 'runpart' => $runpart, 'sponsor' => $sponsor ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  Sponsor  $sponsor
	 * @return Response
	 */
	public function update(Request $request, SponsoredRun $sponrun, RunParticipation $runpart, Sponsor $sponsor)
	{
		$attributes = $request->all();
		$validator = $this->validator($attributes);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}

		// check if the Run has already been
		$sponsor->fill($attributes);
		$sponsor->save();

		return redirect()->route('sponrun.runpart.sponsor.index', [$sponrun->id, $runpart->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Sponsor  $sponsor
	 * @return Response
	 */
	public function destroy(SponsoredRun $sponrun, RunParticipation $runpart, Sponsor $sponsor)
	{
		$sponsor->delete();
		return redirect()->route('sponrun.runpart.sponsor.index', [$sponrun->id, $runpart->id]);
	}

	private function validator(array $data)
	{
		return Validator::make($data, [
					'firstname' => 'required|max:255',
					'lastname' => 'required|max:255',
					'street' => 'required|max:255',
					'housenumber' => 'required|string|max:31',
					'postcode' => 'required|numeric|between:0,99999',
					'city' => 'required|max:255',
					'phone' => 'nullable|phone:AUTO,DE',
					'email' => 'nullable|email|max:255',
					'donation_per_lap' => ['nullable', 'required_without:donation_static_max', 'regex:/^\d+[,.]?\d{0,2}$/', 'max:10'],
					'donation_static_max' => ['nullable', 'required_without:donation_per_lap', 'regex:/^\d+[,.]?\d{0,2}$/', 'max:10']
		]);
	}

}
