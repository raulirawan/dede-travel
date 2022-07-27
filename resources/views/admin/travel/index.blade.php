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
                    <li class="breadcrumb-item active">Data Travel {{ $paketTravel->nama_paket }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Travel {{ $paketTravel->nama_paket }}</h5>
                            <a href="{{ route('admin.travel.create', $paketTravel->id) }}" class="btn btn-success btn-sm mt-1 mb-3">(+) Tambah Travel {{ $paketTravel->nama_paket }}</a>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="no">No</th>
                                        <th scope="col">Tanggal Berangkat</th>
                                        <th scope="col">Tanggal Pulang</th>
                                        <th scope="col">Waktu</th>
                                        <th scope="col">Kuota</th>
                                        <th scope="col">Harga / Orang</th>
                                        <th scope="col" class="aksi">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->tanggal_berangkat }}</td>
                                            <td>{{ $item->tanggal_pulang }}</td>
                                            <td>{{ $item->waktu }} Hari</td>
                                            <td>{{ $item->kuota }} Orang</td>
                                            <td>{{ number_format($item->harga) }}</td>
                                            <td>
                                                 <a
                                                href="{{ route('admin.travel.tiket.index', $item->id) }}"
                                                class="btn btn-primary btn-sm"
                                                >Tiket</a>
                                                <a
                                                href="{{ route('admin.travel.edit', $item->id) }}"
                                                class="btn btn-info btn-sm"
                                                >Edit</a>
                                                <a href="{{ route('admin.travel.delete', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ?')">Hapus</a>
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
            $('#nama_paket').val(nama_paket);
            $('#form-edit').attr('action', '/admin/paket-travel/update/' + id);
        });
    });
</script>
@endpush
