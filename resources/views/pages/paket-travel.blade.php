@extends('layouts.frontend')

@section('content')
<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Paket Travel {{ $paketTravel->nama_paket }}</h3>
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
                <h2>List Paket {{ $paketTravel->nama_paket }}</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col" style="width: 15%">Tanggal Berangkat</th>
                                    <th scope="col" style="width: 15%">Tanggal Pulang</th>
                                    <th scope="col" style="width: 15%">Kuota</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col"style="width: 10%">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($paketTravel->travel as $travel)
                                <tr>
                                    <td>{{ $travel->tanggal_berangkat }}</td>
                                    <td>{{ $travel->tanggal_pulang }}</td>
                                    <td>{{ $travel->kuota }}</td>
                                    <td>{{ $travel->keterangan ?? 'Tidak Ada' }}</td>
                                    <td>
                                        @php
                                            $tanggal_berangkat = new DateTime($travel->tanggal_berangkat);
                                            $dateNow    = new DateTime();
                                        @endphp
                                        @if ($tanggal_berangkat > $dateNow)
                                        <a href="{{ route('form.pemesanan.travel.index', $travel->id) }}" class="btn btn-sm btn-success">Beli Tiket</a>
                                        @else
                                        <button class="btn btn-sm btn-danger" disabled>Tutup</button>
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
</div>

@endsection
