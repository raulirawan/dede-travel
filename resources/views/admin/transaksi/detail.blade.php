@extends('layouts.panel')

@section('title', 'Admin Panel')

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Transaksi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.transaksi.index') }}" style="float: right" class="btn btn-sm btn-primary mt-3">Kembali</a>
                            <h5 class="card-title">Detail Transaksi</h5>
                            <table class="table table-bordered">

                                <tbody>
                                    <tr>
                                        <th style="width: 400px">Tanggal Transaksi</th>
                                        <td>{{ $transaksi->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 400px">Kode Transaksi</th>
                                        <td>{{ $transaksi->kode_transaksi }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 400px">Tanggal Berangkat</th>
                                        <td>{{ $transaksi->travel->tanggal_berangkat }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 400px">Tanggal Pulang</th>
                                        <td>{{ $transaksi->travel->tanggal_pulang }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 400px">Jumlah Hari</th>
                                        <td>{{ $transaksi->travel->waktu }} Hari</td>
                                    </tr>
                                      <tr>
                                        <th style="width: 400px">Paket Travel</th>
                                        <td>{{ $transaksi->travel->paketTravel->nama_paket }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 400px">Nama Customer</th>
                                        <td>{{ $transaksi->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 400px">Nama Tour Guide</th>
                                        <td>{{ $transaksi->tourGuide->name ?? 'Belum Ada' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 400px">Status</th>
                                        @if ($transaksi->status == 'SUCCESS')
                                        <td>
                                            <span class="badge bg-success">SUCCESS</span>
                                        </td>
                                        @elseif ($transaksi->status == 'PENDING')
                                        <td>
                                            <span class="badge bg-warning">PENDING</span>
                                        </td>
                                        @elseif ($transaksi->status == 'SELESAI')
                                        <td>
                                            <span class="badge bg-success">SELESAI</span>
                                        </td>
                                        @elseif ($transaksi->status == 'ON PROGRESS')
                                        <td>
                                            <span class="badge bg-warning">ON PROGRESS</span>
                                        </td>
                                        @elseif ($transaksi->status == 'SUDAH BAYAR')
                                        <td>
                                            <span class="badge bg-success">SUDAH BAYAR</span>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge bg-danger">CANCELLED</span>
                                        </td>

                                        @endif
                                    </tr>
                                    <tr>
                                        <th style="width: 400px">Total Harga</th>
                                        <td>Rp{{ number_format($transaksi->total_harga) }}</td>
                                    </tr>

                                </tbody>
                              </table>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Tiket / Peserta</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peserta</th>
                                        <th>Nomor Handphone</th>
                                        <th>Kode Tiket</th>
                                        <th>Status</th>
                                       </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi->tiket as $item)
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

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection

