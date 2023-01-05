<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('cities.index', [
            'set_active' => 'cities',
            'cities' => $cities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_province()
    {
        // $province = City::distinct()->pluck('province');

        $provinces = City::select('province')->distinct()->get();
        // $province = json_encode($province);
        return response()->json(['provinces' => $provinces]);
    }
    public function get_island()
    {
        $islands = City::select('island')->distinct()->get();
        return response()->json(['islands' => $islands]);
    }
    public function get_lat()
    {
        $lats = City::select('lat')->distinct()->get();
        return response()->json(['lats' => $lats]);
    }
    public function get_long()
    {
        $longs = City::select('long')->distinct()->get();
        return response()->json(['longs' => $longs]);
    }
    public function create()
    {
        return view('cities.add-city', [
            'set_active' => 'cities',
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
        $validate = $request->validate([
            'city_name' => 'required',
            'province' => 'required',
            'island' => 'required',
            'international' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ]);
        $lat = substr($request->lat, 0, 12);
        $long = substr($request->long, 0, 12);
        $id = substr($request->city_name, 0, 4) . substr($request->lat, 0, 3);
        City::create([
            'id_city' => $id,
            'name' => strtoupper($request->city_name),
            'province' => strtoupper($request->province),
            'island' => strtoupper($request->island),
            'international' => $request->international,
            'lat' => $lat,
            'long' => $long
        ]);
        return redirect('dashboard/cities')->with('success', '"Kota ' . strtoupper($request->city_name) . ' Berhasil Ditambahkan"');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        return view('cities.edit-city', [
            'set_active' => 'cities',
            'city' => $city
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'city_name' => 'required',
            'province' => 'required',
            'island' => 'required',
            'international' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ]);
        $lat = substr($request->lat, 0, 12);
        $long = substr($request->long, 0, 12);
        $city = City::find($id);
        City::where('id', $id)->update([
            'province' => strtoupper($request->province),
            'island' => strtoupper($request->island),
            'international' => $request->international,
            'lat' => $lat,
            'long' => $long
        ]);
        return redirect('dashboard/cities')->with('success', '"Kota ' . strtoupper($request->city_name) . ' Berhasil Diperbarui"');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);
        City::destroy($id);
        return redirect('dashboard/cities')->with('success', '"Kota ' . strtoupper($city->name) . ' Berhasil Dihapus"');
    }
    public function find_coor(Request $request)
    {
        $city = $request->city;
        $coor = file_get_contents("http://www.gps-coordinates.net/api/" . $city);
        $coor = json_decode($coor);
        return response()->json(['coor' => $coor, 'msg' => "Gagal Menemukan Koordinat Kota"]);
    }
}