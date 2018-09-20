<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\SponsoredRun;
use Illuminate\Http\Response;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return Response
     */
    public function showHomeView()
    {
    	$sponruns = SponsoredRun::where('closed', '=', false)->orderBy('begin', 'asc')->withCount('participants')->get();
		return view('home')->with('sponruns',  $sponruns);
    }
}
