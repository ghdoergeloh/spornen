<?php

namespace App\Http\Controllers;

use App\Domain\Model\Sponsor\SponsoredRun;
use Illuminate\Http\Request;

class SponsoredRunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('sponruns.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('sponruns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Model\Sponsor\SponsoredRun  $sponsoredRun
     * @return \Illuminate\Http\Response
     */
    public function show(SponsoredRun $sponsoredRun)
    {
		return view('sponruns.show')->with('sponrun', $sponsoredRun);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Model\Sponsor\SponsoredRun  $sponsoredRun
     * @return \Illuminate\Http\Response
     */
    public function edit(SponsoredRun $sponsoredRun)
    {
		return view('sponruns.edit')->with('sponrun', $sponsoredRun);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\Model\Sponsor\SponsoredRun  $sponsoredRun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SponsoredRun $sponsoredRun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Model\Sponsor\SponsoredRun  $sponsoredRun
     * @return \Illuminate\Http\Response
     */
    public function destroy(SponsoredRun $sponsoredRun)
    {
        //
    }
}
