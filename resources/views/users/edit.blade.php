@extends('layouts.app')
@push('css')
@endpush
@section('content')
    @include('components.content-header', [
        'title' => 'Edit Pengguna',
        'items' => [
            ['label' => 'Dashboard', 'href' => '/'],
            ['label' => 'Manajemen Pengguna', 'href' => '/manage-user'],
            ['label' => 'Edit Pengguna', 'href' => '#'],
        ],
    ])
    <section class="section">
        <div class="row">
            <div class="lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <form action="{{ route('manage-user.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="row mb-2">
                                <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input name="name" id="name" type="text"
                                        class="form-control @error('name')is-invalid @enderror" placeholder="Nama Lengkap"
                                        value="{{ $user->name }}">
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="email" class="col-sm-2 col-form-label">Alamat Email</label>
                                <div class="col-sm-10">
                                    <input name="email" id="email" type="email"
                                        class="form-control @error('name')is-invalid @enderror" placeholder="Alamat Email"
                                        value="{{ $user->email }}">
                                    @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input name="password" id="password" type="password" class="form-control"
                                        placeholder="Password">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <legend class="col-form-label col-sm-2 pt-0">Role Pengguna</legend>
                                @if (count($user->roles->pluck('name')->toarray()) > 0)
                                    <div class="col-sm-10">
                                        @foreach ($roles as $item)
                                            <input type="checkbox" name="role[]" class="form-check-input"
                                                id="{{ $item->name . $item->id }}" value="{{ strtolower($item->name) }}"
                                                @checked(in_array($item->name, $user->roles->pluck('name')->toarray()))>
                                            <label class="custom-control-label"
                                                for="{{ $item->name . $item->id }}">{{ strtoupper($item->name) }}</label>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="col-sm-10">
                                        @foreach ($roles as $item)
                                            <input type="checkbox" name="role[]" class="form-check-input"
                                                id="{{ $item->name . $item->id }}" value="{{ strtolower($item->name) }}">
                                            <label class="form-check-label"
                                                for="{{ $item->name . $item->id }}">{{ strtoupper($item->name) }}</label>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <label for="verified" class="col-form-label col-sm-2 pt-0">Verified</label>
                                <div class="col-sm-10">
                                    <input class="form-check-input" type="checkbox"
                                        {{ !blank($user->email_verified_at) ? 'checked' : '' }} name="verified"
                                        id="verified">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i>
                                        Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
