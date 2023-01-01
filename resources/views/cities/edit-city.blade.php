@extends('layouts.dashboard.dashboard-admin')
@push('select2-js')
    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> --}}
@endpush
@push('ex-select2-js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $.ajax({
            url: "/cities/get-province",
            type: "GET",
            success: function(response) {
                var provinces = response.provinces.map(function(val) {
                    return val.province;
                })
                $("#province").autocomplete({
                    source: provinces,
                    minLength: 0
                }).focus(function() {
                    $(this).autocomplete('search', $(this).val())
                });;
            }
        });
        $.ajax({
            url: "/cities/get-island",
            type: "GET",
            success: function(response) {
                var islands = response.islands.map(function(val) {
                    return val.island;
                })
                console.log(islands)
                $("#island").autocomplete({
                    source: islands,
                    minLength: 0
                }).focus(function() {
                    $(this).autocomplete('search', $(this).val())
                });;
            }
        });
        $.ajax({
            url: "/cities/get-lat",
            type: "GET",
            success: function(response) {
                var lats = response.lats.map(function(val) {
                    return val.lat;
                })
                console.log(lats)
                $("#lat").autocomplete({
                    source: lats,
                    minLength: 0
                }).focus(function() {
                    $(this).autocomplete('search', $(this).val())
                });;
            }
        });
        $.ajax({
            url: "/cities/get-long",
            type: "GET",
            success: function(response) {
                var longs = response.longs.map(function(val) {
                    return val.long;
                })
                console.log(longs)
                $("#long").autocomplete({
                    source: longs,
                    minLength: 0
                }).focus(function() {
                    $(this).autocomplete('search', $(this).val())
                });;
            }
        });
    </script>
@endpush
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kota</h3>
                <p class="text-subtitle text-muted">Tambah Kota</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/users') }}">Kota</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kota</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Kota</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ url('cities/update/' . $city->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <label for="city_name">Nama Kota</label>
                                    <input type="text" class="form-control" id="city_name" name="city_name"
                                        placeholder="Nama Pengguna" value="{{ $city->name }}">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="province">Nama Provinsi</label>
                                    <input type="text" class="form-control" id="province" name="province"
                                        placeholder="Provinsi" value="{{ $city->province }}">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="island">Pulau</label>
                                    <input type="text" class="form-control" id="island" name="island"
                                        placeholder="Pulau" value="{{ $city->island }}">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="lat">Latitude</label>
                                    <input type="number" class="form-control" id="lat" name="lat"
                                        placeholder="Latitude" step="0.000001" value="{{ $city->lat }}">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="long">Longitude</label>
                                    <input type="number" class="form-control" id="long" name="long"
                                        placeholder="Longitude" step="0.000001" value="{{ $city->long }}">
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <label for="international">Pilih Status Kondisi</label>
                                    <select class="form-select" aria-label="Pilih Status Kondisi" id="international"
                                        name="international">
                                        <option value="0" {{ $city->international == '0' ? 'selected' : '' }}>Dalam
                                            Negeri
                                        </option>
                                        <option value="1" {{ $city->international == '0' ? 'selected' : '' }}>Luar
                                            Negeri</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
