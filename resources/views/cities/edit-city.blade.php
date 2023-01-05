@extends('layouts.dashboard.dashboard-admin')
@push('head')
    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> --}}
@endpush
@push('footer')
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
        $(document).on("click", "#find_coor", function(e) {
            var city = $('#city_name').val();
            $('#find_coor').addClass('d-none')
            $('#spinner').removeClass('d-none')
            if (!city) {
                $('#error_message').text("Isi Nama Kota")
                $('#find_coor').removeClass('d-none')
                $('#spinner').addClass('d-none')
            }
            console.log(city)
            $.ajax({
                url: "/cities/find-coor/",
                type: "GET",
                data: {
                    city: city
                },
                success: function(response) {
                    if (response.coor.responseCode == 200) {
                        console.log(response.coor)
                        // console.log(response.latitude)
                        $('#lat').val(response.coor.latitude)
                        $('#long').val(response.coor.longitude)
                        $('#find_coor').removeClass('d-none')
                        $('#spinner').addClass('d-none')
                        $('#error_message').addClass('d-none')
                    } else {
                        $('#find_coor').removeClass('d-none')
                        $('#spinner').addClass('d-none')
                        $('#error_message').removeClass('d-none')
                        $('#error_message').text(response.msg)
                        console.log(response.msg)
                    }
                },
            })
        });
    </script>
@endpush
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kota</h3>
                <p class="text-subtitle text-muted">Edit Kota</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/cities') }}">Kota</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kota</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Kota</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ url('cities/update/' . $city->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <div class="row">
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-md-4">
                                        <label for="city_name">Nama Kota</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="city_name" name="city_name" placeholder="Nama Kota"
                                            value="{{ old('city_name', $city->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label for="province">Nama Provinsi</label>
                                        <input type="text" class="form-control @error('province') is-invalid @enderror"
                                            id="province" name="province" placeholder="Provinsi"
                                            value="{{ old('province', $city->province) }}">
                                        @error('province')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label for="island">Pulau</label>
                                        <input type="text" class="form-control @error('island') is-invalid @enderror"
                                            id="island" name="island" placeholder="Pulau"
                                            value="{{ old('island', $city->island) }}">
                                        @error('island')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-md-4">
                                        <label for="lat">Latitude</label>
                                        <input type="number" class="form-control @error('lat') is-invalid @enderror"
                                            id="lat" name="lat" placeholder="Latitude" step="any"
                                            value="{{ old('lat', $city->lat) }}">
                                        @error('lat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label for="long">Longitude</label>
                                        <input type="number" class="form-control @error('long') is-invalid @enderror"
                                            id="long" name="long" placeholder="Longitude" step="any"
                                            value="{{ old('long', $city->long) }}">
                                    </div>
                                    @error('long')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="col-sm-12 col-md-4 d-flex align-items-end">
                                        <a id="find_coor" class="btn btn-primary">Cari Koordinat</a>
                                        <div id="spinner" class="d-none" role="status">
                                            <img src="{{ asset('assets/images/svg-loaders/puff.svg') }}" class="me-4"
                                                style="width: 3rem" alt="audio">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <p id="error_message" class="text-danger"></p>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <label for="international">Pilih Status Kondisi</label>
                                    <select class="form-select" aria-label="Pilih Status Kondisi" id="international"
                                        name="international">
                                        <option value="0" {{ $city->international == '0' ? 'selected' : '' }}>Dalam
                                            Negeri
                                        </option>
                                        <option value="1" {{ $city->international == '1' ? 'selected' : '' }}>Luar
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
