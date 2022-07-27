@extends('layouts.frontend')

@section('content')
<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Menu Transaksi</h3>
                    <p>Pixel perfect design with awesome contents</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->
<div class="popular_places_area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Detail Transaksi</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
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
                                            <span class="badge bg-success text-white">SUCCESS</span>
                                        </td>
                                        @elseif ($transaksi->status == 'PENDING')
                                        <td>
                                            <span class="badge bg-warning text-white">PENDING</span>
                                        </td>
                                        @elseif ($transaksi->status == 'SELESAI')
                                        <td>
                                            <span class="badge bg-success text-white">SELESAI</span>
                                        </td>
                                        @elseif ($transaksi->status == 'ON PROGRESS')
                                        <td>
                                            <span class="badge bg-warning text-white">ON PROGRESS</span>
                                        </td>
                                        @elseif ($transaksi->status == 'SUDAH BAYAR')
                                        <td>
                                            <span class="badge bg-success text-white">SUDAH BAYAR</span>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge bg-danger text-white">CANCELLED</span>
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
                        <a href="#" class="btn btn-primary btm-sm mb-3">Download Tiket</a>

                    </div>
                </div>

            </div>


        </div>

        <div class="row mt-4">
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
                                            <span class="badge bg-success text-white">ACTIVE</span>
                                        @else
                                            <span class="badge bg-danger text-white">SUDAH DI GUNAKAN</span>
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
    </div>
</div>

@endsection
