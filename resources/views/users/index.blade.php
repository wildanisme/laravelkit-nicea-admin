@extends('layouts.app')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('content')
    @include('components.content-header', [
        'title' => 'Manajemen Pengguna',
        'items' => [['label' => 'Dashboard', 'href' => '/'], ['label' => 'Manajemen Pengguna', 'href' => '#']],
    ])
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Data Pengguna</h3>
                                <div class="card-tools">
                                    <a href="{{ route('manage-user.create') }}" class="btn btn-outline-primary"><i
                                            class="bi bi-plus-circle"></i> Tambah Pengguna</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped datatable">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Pengguna</th>
                                        <th>Email</th>
                                        <th>Role Pengguna</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    @foreach ($item->roles->pluck('name') as $role)
                                                        {{ $role }}
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-secondary dropdown-toggle"
                                                            type="button" id="menu" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="bi bi-gear-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('manage-user.edit', $item->id) }}">Edit</a>
                                                            <form action="{{ route('manage-user.destroy', $item->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn dropdown-item">Hapus</button>
                                                            </form>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-bs5/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
