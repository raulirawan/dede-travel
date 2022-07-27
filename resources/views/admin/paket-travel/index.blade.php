@extends('layouts.panel')

@section('title', 'Admin Panel')

@section('content')

<style>
    .datatable .aksi {
        width: 20%;
    }
    .datatable .no {
        width: 5%;
    }
</style>
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Paket travel</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Paket travel</h5>
                            <button class="btn btn-success btn-sm mt-1 mb-3" data-bs-toggle="modal"
                                data-bs-target="#modal-create">(+) Tambah Paket travel</button>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="no">No</th>
                                        <th scope="col">Nama Paket travel</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Review</th>
                                        <th scope="col" class="aksi">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->nama_paket }}</td>
                                            <td>
                                                <img src="{{ asset($item->gambar) }}" style="width: 100px">
                                            </td>
                                            <td>20 Review</td>
                                            <td>
                                                <a href="{{ route('admin.travel.index', $item->id) }}" class="btn btn-success btn-sm">Jadwal</a>
                                                <button
                                                id="edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-edit"
                                                class="btn btn-info btn-sm"
                                                data-id="{{ $item->id }}"
                                                data-nama_paket="{{ $item->nama_paket }}"
                                                data-gambar="{{ $item->gambar }}"
                                                >Edit</button>
                                                <a href="{{ route('admin.paket-travel.delete', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ?')">Hapus</a>
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
                    <h5 class="modal-title">Form Tambah Paket travel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.paket-travel.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label class="form-label">Nama Paket Travel</label>
                                <input type="text" class="form-control" value="{{ old('nama_paket') }}"
                                    name="nama_paket" placeholder="Masukan Nama Paket" required>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control"
                                    name="gambar" required>
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


    <div class="modal fade" id="modal-edit" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Edit Paket travel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-edit" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label class="form-label">Nama Paket travel</label>
                                <input type="text" class="form-control" id="nama_paket" value="{{ old('nama_paket') }}"
                                    name="nama_paket" placeholder="Masukan Nama Paket" required>
                            </div>
                               <div class="form-group mb-2">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control mb-2"
                                    name="gambar" required>
                                <img src="#"  id="gambar" style="width: 100px">
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
            var nama_paket = $(this).data('nama_paket');
            var gambar = $(this).data('gambar');
            var url = "{{ url('/') }}";
            $('#nama_paket').val(nama_paket);
            $('#form-edit').attr('action', '/admin/paket-travel/update/' + id);
            $('#gambar').attr('src', url + '/' +gambar);
        });
    });
</script>
@endpush
