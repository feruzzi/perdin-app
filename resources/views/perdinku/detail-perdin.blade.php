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
                <p class="text-subtitle text-muted">Detail Perjalanan Dinas</p>
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
                <h4 class="card-title">Detail Perjalanan Dinas</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive d-flex justify-content-center mb-3">
                        <table class="table table-borderless text-center">
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
                                        <span class="badge bg-primary-50">{{ $x['allowance'] . ' /Hari' }}</span>
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

                </div>
            </div>
        </div>
    </section>
@endsection
