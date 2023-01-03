<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\City;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = Trip::all();
        return view('trips.index', [
            'set_active' => 'trips',
            'trips' => $trips
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = 'tes1';
        $cities = City::orderBy('name')->get();
        return view('perdinku.add-perdin', [
            'set_active' => 'perdinku',
            'user' => $user,
            'cities' => $cities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = 'tes1';
        Trip::create([
            'username' => $user,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'status' => 0,
        ]);
        return redirect('perdinku');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Trip::destroy($id);
        return redirect('perdinku');
    }
    public function perdinku()
    {
        // $date = Carbon::parse('2022-12-27');
        // $now = Carbon::now();

        // $diff = $date->diffInDays($now);
        // dd($diff);
        // dd(Carbon::now()->format('d M Y'));

        $user = 'tes1';
        $trips = Trip::with(['origin_city', 'destination_city'])->where('username', '=', $user)->get();
        return view('perdinku.perdinku', [
            'set_active' => 'perdinku',
            'user' => $user,
            'trips' => $trips,
        ]);
    }
}