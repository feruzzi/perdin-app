@push('head')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
@endpush
@push('footer')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script>
        // let newTrip = $("#tbnewtrip").DataTable();
        let history = $("#tbhistorytrip").DataTable();
    </script>
@endpush
<div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
    <div class="table-responsive mt-3">
        <table class="table" id="tbhistorytrip">
            <thead>
                <th class="w-auto">No</th>
                <th class="w-auto">Kota</th>
                <th class="w-auto">Tanggal</th>
                <th class="w-auto">Keterangan</th>
                <th class="w-auto">Uang Saku</th>
                <th class="w-auto">Di Proses</th>
                <th class="w-auto">Status</th>
                <th class="w-auto">Aksi</th>
            </thead>
            <tbody>
                @foreach ($trips_history as $trip)
                    @php
                        $allowance = fCalculateAllowance($trip, fCalculateDistance($trip), fDateDiff($trip->start_date, $trip->end_date));
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $trip->origin_city->name }} <span
                                class="icon dripicons dripicons-arrow-thin-right mx-3"></span>
                            {{ $trip->destination_city->name }}</td>
                        <td>{{ fFormatDate($trip->start_date) }}<span
                                class="mx-3">-</span>{{ fFormatDate($trip->end_date) }}
                            <span class="badge bg-light-secondary mx-2">
                                ({{ fDateDiff($trip->start_date, $trip->end_date) }} Hari)
                            </span>
                        </td>
                        <td class="td-description">{{ fTextTruncate($trip->description, 100) }}</td>
                        <td>{{ $allowance['total'] }}</td>
                        </td>
                        <td>{{ $trip->process_by }}</td>
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
                            <div class="d-flex">
                                <a href="{{ url('perdin/edit/' . $trip->id) }}" class="btn btn-primary btn-sm">
                                    <span class="icon dripicons dripicons-search me-2"></span>Lihat</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
