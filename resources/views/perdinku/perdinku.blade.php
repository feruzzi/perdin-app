@extends('layouts.dashboard.dashboard-user')
@push('head')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
@endpush
@push('footer')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script>
        let user = $("#tbuser").DataTable();
    </script>
    <script>
        function confirmation() {
            return confirm("Yakin Batalkan Perjalanan Dinas ?")
        }
    </script>
    @if (session()->has('success'))
        <script>
            toastSuccess({!! session('success') !!})
        </script>
    @endif
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
                        <li class="breadcrumb-item"><a href="{{ url('perdinku') }}">Perjalanan Dinas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Perjalanan Dinas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="d-flex">
            <a href="{{ url('perdin/add-perdin') }}" class="btn btn-primary">Tambah Perjalanan Dinas</a>
        </div>
        <div class="card my-3 p-3">
            <div class="table-responsive mt-3">
                <table class="table" id="tbuser">
                    <thead>
                        <th>No</th>
                        <th>Kota</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($trips as $trip)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $trip->origin_city->name }} <span
                                        class="icon dripicons dripicons-arrow-thin-right mx-3"></span>
                                    {{ $trip->destination_city->name }}</td>
                                <td>{{ fFormatDate($trip->start_date) }}<span
                                        class="mx-3">-</span>{{ fFormatDate($trip->end_date) }}
                                    <span class="badge bg-light-secondary">
                                        ({{ fDateDiff($trip->start_date, $trip->end_date) }} Hari)
                                    </span>
                                </td>
                                <td class="td-description">{{ fTextTruncate($trip->description, 100) }}</td>
                                <td>
                                    @if ($trip->status == '0')
                                        <span class="badge bg-light-info">Menunggu</span>
                                    @elseif($trip->status == '1')
                                        <span class="badge bg-light-success">Di Terima</span>
                                    @elseif($trip->status == '2')
                                        <span class="badge bg-light-danger">Di Tolak</span>
                                    @else
                                        <span class="badge bg-light-warning">Hilang</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        @if ($trip->status == '0')
                                            <form action="{{ url('perdin/delete/' . $trip->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm mx-3" onclick="return confirmation()">
                                                    <span class="icon dripicons dripicons-document-delete"></span>
                                                    Batalkan
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ url('perdin/detail/' . $trip->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <span class="icon dripicons dripicons-search me-2"></span>Lihat</a>
                                        @endif
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
