@extends('layouts.dashboard.dashboard-admin')
@push('head')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
@endpush
@push('footer')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script>
        let city = $("#tbcity").DataTable();
    </script>
@endpush
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kota</h3>
                <p class="text-subtitle text-muted">Daftar Kota</p>
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
        <div class="d-flex">
            <a href="{{ url('cities/add-city') }}" class="btn btn-primary">Tambah Kota</a>
        </div>
        <div class="card my-3 p-3">
            <div class="table-responsive mt-3">
                <table class="table" id="tbcity">
                    <thead>
                        <th>No</th>
                        <th>Nama Kota</th>
                        <th>Provinsi</th>
                        <th>Pulau</th>
                        <th>Luar Negeri</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->province }}</td>
                                <td>{{ $city->island }}</td>
                                <td>{{ $city->international == '0' ? 'Dalam Negeri' : 'Luar Negeri' }}</td>
                                <td>{{ $city->lat }}</td>
                                <td>{{ $city->long }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ url('cities/edit/' . $city->id) }}" class="btn btn-warning btn-sm">
                                            <span class="icon dripicons dripicons-document-edit"></span></a>
                                        <form action="{{ url('cities/delete/' . $city->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm mx-3">
                                                <span class="icon dripicons dripicons-document-delete"></span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
