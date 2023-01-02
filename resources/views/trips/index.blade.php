@extends('layouts.dashboard.dashboard-admin')
@push('head')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
@endpush
@push('footer')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script>
        let newTrip = $("#tbnewtrip").DataTable();
        let historyTrip = $("#tbhistorytrip").DataTable();
    </script>
@endpush
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Perjalanan Dinas</h3>
                <p class="text-subtitle text-muted">Daftar Perjalanan Dinas</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/trips') }}">Perjalanan Dinas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Perjalanan Dinas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card my-3 p-3">
            <div class="mb-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="new-trip-tab" data-bs-toggle="tab" href="#new-trip" role="tab"
                            aria-controls="new-trip" aria-selected="true">Perjalanan Baru</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#history" role="tab"
                            aria-controls="history" aria-selected="false">Riwayat Perjalanan</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                @include('trips.new-trip')
                @include('trips.history-trip')
            </div>
        </div>
    </section>
@endsection
