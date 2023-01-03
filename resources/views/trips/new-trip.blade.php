<div class="tab-pane fade show active" id="new-trip" role="tabpanel" aria-labelledby="new-trip-tab">
    <div class="table-responsive mt-3">
        <table class="table" id="tbnewtrip">
            <thead>
                <th>No</th>
                <th>Kota</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Uang Saku</th>
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
                            <span class="badge bg-light-secondary mx-2">
                                ({{ fDateDiff($trip->start_date, $trip->end_date) }} Hari)
                            </span>
                        </td>
                        <td class="td-description">{{ fTextTruncate($trip->description, 100) }}</td>
                        <td>Uang Saku</td>
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
                                <form action="{{ url('perdin/delete/' . $trip->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm mx-3">
                                        <span class="icon dripicons dripicons-document-delete"></span>
                                        Batalkan
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
