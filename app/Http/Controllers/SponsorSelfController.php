<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\RunParticipation;
use App\Domain\Model\Sponsor\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class SponsorSelfController extends Controller
{
	private $root_route = 'run.';
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(RunParticipation $runpart)
    {
		return redirect()->route('run.sponsor.create', $runpart->hash);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(RunParticipation $runpart)
    {
		return view('sponsors.create')
						->with('root_route', $this->root_route)
						->with('root_route_params', [$runpart->hash]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
	public function store(Request $request, RunParticipation $runpart)
	{
		$attributes = $request->all();
		$validator = Sponsor::validator($attributes);
		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}

		$user = $runpart->user;
		$sponsor = new Sponsor();
		$sponsor->user()->associate($user);
		$sponsor->runParticipation()->associate($runpart);
		$sponsor->fill($attributes);
		$sponsor->save();
		Session::flash('messages-success', new MessageBag(["Erfolgreich gespeichert"]));
		return redirect()->route('run.sponsor.create', $runpart->hash);
	}


}
