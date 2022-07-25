@extends('layouts.panel')

@section('title', 'Admin Panel')

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Cutomer</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Customer</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Customer</h5>
                            <button class="btn btn-success btn-sm mt-1 mb-3" data-bs-toggle="modal"
                                data-bs-target="#modal-create">(+) Tambah Customer</button>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Customer</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Nomor Handphone</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->nomor_handphone }}</td>
                                            <td>
                                                <button
                                                id="edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-edit"
                                                class="btn btn-info btn-sm"
                                                data-id="{{ $item->id }}"
                                                data-nama_customer="{{ $item->name }}"
                                                data-email="{{ $item->email }}"
                                                data-nomor_handphone="{{ $item->nomor_handphone }}"
                                                >Edit</button>
                                                <a href="{{ route('admin.customer.delete', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ?')">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
    <div class="modal fade" id="modal-create" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Tambah Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.customer.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label class="form-label">Nama Customer</label>
                                <input type="text" class="form-control" value="{{ old('nama_customer') }}"
                                    name="nama_customer" placeholder="Masukan Nama" required>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ old('email') }}"
                                    name="email" placeholder="Masukan Email" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" value="{{ old('password') }}"
                                    name="password" placeholder="Masukan Password" required>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Nomor Handphone</label>
                                <input type="number" class="form-control" value="{{ old('nomor_handphone') }}"
                                    name="nomor_handphone" placeholder="Masukan Nomor Handphone" required>
                            </div>

                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs- dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                </div>
                </form>
            </div>

        </div>
    </div>
    </div>


    <div class="modal fade" id="modal-edit" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Tambah Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-edit" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label class="form-label">Nama Customer</label>
                                <input type="text" class="form-control" id="nama_customer" value="{{ old('nama_customer') }}"
                                    name="nama_customer" placeholder="Masukan Nama" required>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email_edit" value="{{ old('email_edit') }}"
                                    name="email_edit" placeholder="Masukan Email" required>
                                @if ($errors->has('email_edit'))
                                    <span class="text-danger">{{ $errors->first('email_edit') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Nomor Handphone</label>
                                <input type="number" class="form-control" id="nomor_handphone" value="{{ old('nomor_handphone') }}"
                                    name="nomor_handphone" placeholder="Masukan Nomor Handphone" required>
                            </div>

                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                </div>
                </form>
            </div>

        </div>
    </div>
    </div>


@endsection

@push('down-script')
@if ($errors->has('email'))
<script type="text/javascript">
    $(document).ready(function() {
        $('#modal-create').modal('show');
    });
</script>
@endif
@if ($errors->has('email_edit'))
<script type="text/javascript">
   $(document).ready(function() {
        $('#modal-edit').modal('show');
    });
</script>
@endif

<script>
    $(document).ready(function() {
        $(document).on('click', '#edit', function() {
            var id = $(this).data('id');
            var nama_customer = $(this).data('nama_customer');
            var email = $(this).data('email');
            var nomor_handphone = $(this).data('nomor_handphone');
            $('#nama_customer').val(nama_customer);
            $('#email_edit').val(email);
            $('#nomor_handphone').val(nomor_handphone);
            $('#form-edit').attr('action', '/admin/customer/update/' + id);
        });
    });
</script>
@endpush
