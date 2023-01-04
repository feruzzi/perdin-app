@extends('layouts.dashboard.dashboard-admin')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pengguna</h3>
                <p class="text-subtitle text-muted">Tambah Pengguna</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/users') }}">Pengguna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Pengguna</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ url('users/store-user') }}" method="post">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control  @error('name') is-invalid  @enderror"
                                        id="name" name="name" placeholder="Nama Pengguna"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-md-6">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid  @enderror"
                                            id="username" name="username" placeholder="Username"
                                            value="{{ old('username') }}">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 mb-3">
                                    <label for="role">Pilih Role</label>
                                    <select class="form-select @error('role') is-invalid @enderror" aria-label="Pilih Role"
                                        id="role" name="role">
                                        <option value="1">Pegawai</option>
                                        <option value="0">Divisi SDM</option>
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
