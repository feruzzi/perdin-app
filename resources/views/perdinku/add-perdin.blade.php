@extends('layouts.dashboard.dashboard-user')
@push('head')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
@endpush
@push('footer')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-element-select.js') }}"></script>
@endpush
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Perjalanan Dinas</h3>
                <p class="text-subtitle text-muted">Tambah Perjalanan Dinas</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('perdinku') }}">Perjalanan Dinas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Perjalanan Dinas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Perjalanan Dinas</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ url('perdin/store-perdin') }}" method="post">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="row mb-3">
                                    <h5>Kota</h5>
                                    <div class="d-flex">
                                        <div class="w-100">
                                            <label for="origin">Asal</label>
                                            <select class="choices form-select" id="origin" name="origin">
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id_city }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mx-3">
                                            <label>Ke</label>
                                            <h1 class="icon dripicons dripicons-arrow-thin-right"></h1>
                                        </div>
                                        <div class="w-100">
                                            <label for="origin">Tujuan</label>
                                            <select class="choices form-select" id="destination" name="destination">
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id_city }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <h5>Tanggal</h5>
                                    @error('date_diff')
                                        <div class="text-danger">
                                            Tanggal Mulai Harus Lebih Awal Dari Tanggal Selesai
                                        </div>
                                    @enderror
                                    <div class="d-flex">
                                        <div class="w-100">
                                            <label for="start_date">Mulai</label>
                                            <input type="date"
                                                class="form-control date-cursor @error('start_date') is-invalid @enderror"
                                                id="start_date" name="start_date" onfocus="this.showPicker()">
                                            @error('start_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mx-3">
                                            <label>Hingga</label>
                                            <h1 class="icon dripicons dripicons-arrow-thin-right"></h1>
                                        </div>
                                        <div class="w-100">
                                            <label for="end_date">Selesai</label>
                                            <input type="date"
                                                class="form-control date-cursor @error('end_date') is-invalid @enderror"
                                                id="end_date" name="end_date" onfocus="this.showPicker()">
                                            @error('end_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="description">Keterangan</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                                    @error('description')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
