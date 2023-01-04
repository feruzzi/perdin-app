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
        $new_trips = Trip::where('status', "0")->get();
        $trips_history = Trip::where('status', "!=", "0")->get();
        return view('trips.index', [
            'set_active' => 'trips',
            'new_trips' => $new_trips,
            'trips_history' => $trips_history
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
    public function edit($id)
    {
        $trip = Trip::find($id);
        return view('trips.edit-trip', [
            'set_active' => 'trips',
            'trip' => $trip,
        ]);
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
    public function selection(Request $request, $id)
    {
        $allowance = $request->allowance;
        $allowance =  substr($allowance, 0, -3);
        $allowance = (int) filter_var($allowance, FILTER_SANITIZE_NUMBER_INT);
        if ($request->trip_selection == "approve") {
            Trip::where('id', $id)->update([
                'status' => 1,
                'allowance' => $allowance,
                'process_by' => auth()->user()->username,
            ]);
        } elseif ($request->trip_selection == "reject") {
            Trip::where('id', $id)->update([
                'status' => 2,
                'process_by' => auth()->user()->username,
            ]);
        }
        return redirect('dashboard/trips');
    }
}