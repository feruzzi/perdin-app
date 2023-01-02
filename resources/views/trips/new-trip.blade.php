<div class="tab-pane fade show active" id="new-trip" role="tabpanel" aria-labelledby="new-trip-tab">
    <div class="table-responsive mt-3">
        <table class="table" id="tbnewtrip">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Kota</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                {{-- @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role == '0' ? 'Divisi SDM' : 'Pegawai' }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ url('users/edit/' . $user->id) }}" class="btn btn-warning btn-sm">
                                    <span class="icon dripicons dripicons-document-edit"></span></a>
                                <form action="{{ url('users/delete/' . $user->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm mx-3">
                                        <span class="icon dripicons dripicons-document-delete"></span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
