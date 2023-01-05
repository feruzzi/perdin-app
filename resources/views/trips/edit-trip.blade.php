@extends('layouts.dashboard.dashboard-admin')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Perjalanan Dinas</h3>
                <p class="text-subtitle text-muted">Pengajuan Perjalanan Dinas</p>
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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pengajuan Perjalanan Dinas</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ url('perdin/selection/' . $trip->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" disabled
                                        value="{{ $trip->user->name }}">
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="w-500px">
                                        <label for="origin">Kota Asal</label>
                                        <input type="text" class="form-control" id="origin" name="origin" disabled
                                            value="{{ $trip->origin_city->name }}">
                                    </div>
                                    <div class="mx-3 my-4 d-flex justify-content-center align-items-center">
                                        <h5 class="icon dripicons dripicons-arrow-thin-right">
                                        </h5>
                                    </div>
                                    <div class="w-500px">
                                        <label for="destination">Kota Tujuan</label>
                                        <input type="text" class="form-control" id="destination" name="destination"
                                            disabled value="{{ $trip->destination_city->name }}">
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="w-500px">
                                        <label for="start_date">Tanggal Mulai</label>
                                        <input type="text" class="form-control" id="start_date" name="start_date"
                                            disabled value="{{ $trip->start_date }}">
                                    </div>
                                    <div class="mx-3 my-4 d-flex justify-content-center align-items-center">
                                        <h5 class="icon dripicons dripicons-arrow-thin-right">
                                        </h5>
                                    </div>
                                    <div class="w-500px">
                                        <label for="end_date">Tanggal Selesai</label>
                                        <input type="text" class="form-control" id="end_date" name="end_date" disabled
                                            value="{{ $trip->end_date }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-md-12">
                                        <label for="description">Keterangan</label>
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="10" disabled>{{ $trip->description }}</textarea>
                                    </div>
                                </div>
                                <div class="table-responsive d-flex justify-content-center mb-3">
                                    <table class="table table-borderless text-center w-75">
                                        <thead>
                                            <tr class="table-info">
                                                <th>Total Hari</th>
                                                <th>Jarak</th>
                                                <th>Total Uang Perdin</th>
                                            </tr>
                                        <tbody>
                                            @php
                                                $x = fCalculateAllowance($trip, fCalculateDistance($trip), fDateDiff($trip->start_date, $trip->end_date));
                                            @endphp
                                            <tr class="table-primary">
                                                <td>
                                                    <h5>
                                                        <span
                                                            class="badge bg-primary-50">{{ fDateDiff($trip->start_date, $trip->end_date) . ' Hari' }}
                                                        </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge bg-primary-50">
                                                            {{ fCalculateDistance($trip) . ' KM' }}
                                                        </span>
                                                    </h5>
                                                    <span
                                                        class="badge bg-primary-50">{{ $x['allowance'] . ' /Hari' }}</span>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge bg-primary-50">
                                                            {{ $x['total'] }}
                                                        </span>
                                                    </h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                        </thead>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input type="hidden" name="allowance" value="{{ $x['total'] }}">
                                    <button
                                        class="btn btn-success mx-3 fs-5 fw-bold py-3 px-5 d-flex justify-content-center align-items-center"
                                        name="trip_selection" value="approve"><span
                                            class="icon dripicons dripicons-checkmark"></span></button>
                                    <button
                                        class="btn btn-danger mx-3 fs-5 fw-bold py-3 px-5 d-flex justify-content-center align-items-center"
                                        name="trip_selection" value="reject"><span
                                            class="icon dripicons dripicons-cross"></span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
