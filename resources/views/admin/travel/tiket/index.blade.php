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
                    <li class="breadcrumb-item active">Data Tiket Travel {{ $travel->paketTravel->nama_paket }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Tiket Travel {{ $travel->paketTravel->nama_paket }}</h5>
                            <div class="row mb-3">

                                <form action="{{ route('admin.travel.tiket.update.index', $travel->id) }}" method="POST" class="form-inline">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <div class="col-sm-10">
                                                <input type="text" name="kode_tiket" class="form-control" placeholder="Masukan Kode Tiket" required>
                                                <button class="btn btn-sm btn-primary mt-2">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="no">No</th>
                                        <th scope="col">Nama Peserta</th>
                                        <th scope="col">Nomor Handphone</th>
                                        <th scope="col">Kode Tiket</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_peserta }}</td>
                                            <td>{{ $item->nomor_handphone }}</td>
                                            <td>{{ $item->kode_tiket }}</td>
                                            <td>
                                                @if ($item->status == 'ACTIVE')
                                                    <span class="badge bg-success">ACTIVE</span>
                                                @else
                                                    <span class="badge bg-danger">SUDAH DI GUNAKAN</span>
                                                @endif
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
