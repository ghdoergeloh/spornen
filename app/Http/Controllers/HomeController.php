<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\SponsoredRun;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
		$user = Auth::guard()->getUser();
		$runs = SponsoredRun::all();
        return view('home')->with('user', $user)->with('runs',  $runs);
    }
}
