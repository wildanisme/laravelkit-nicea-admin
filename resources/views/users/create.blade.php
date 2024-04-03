@extends('layouts.app')
@push('css')
@endpush
@section('content')
    @include('components.content-header', [
        'title' => 'Tambah Pengguna',
        'items' => [
            ['label' => 'Dashboard', 'href' => '/'],
            ['label' => 'Manajemen Pengguna', 'href' => '/manage-user'],
            ['label' => 'Tambah Pengguna', 'href' => '#'],
        ],
    ])

    <section class="section">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"></div>
                        <form action="{{ route('manage-user.store') }}" method="post">
                            @csrf
                            <div class="row mb-2">
                                <label for="name" class="col-sm-2 col-form-label"> Nama </label>
                                <div class="col-sm-10">
                                    <input name="name" id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <legend class="col-form-label col-sm-2 pt-0">Role Pengguna</legend>
                                <div class="col-sm-10 my-1">
                                    @foreach ($roles as $item)
                                        <input type="checkbox" name="role[]" class="form-check-input"
                                            id="{{ $item->name . $item->id }}" value="{{ strtolower($item->name) }}">
                                        <label class="custom-control-label"
                                            for="{{ $item->name . $item->id }}">{{ strtoupper($item->name) }}</label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="verified" class="col-form-label col-sm-2 pt-0">Verified</label>
                                <div class="col-sm-10">
                                    <input class="form-check-input" type="checkbox" name="verified" id="verified">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i>
                                        Simpan</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    {{--
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0"></h5>
                            <div class="card-tools">
                                <a href="{{ route('manage-user.index') }}" class="btn btn-tool"><i
                                        class="fas fa-arrow-alt-circle-left"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@push('js')
    <script src="{{ asset('') }}plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        $(function() {
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
        })
    </script>
@endpush
