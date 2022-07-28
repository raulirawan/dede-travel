@extends('layouts.frontend')

@section('content')
<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Paket Travel {{ $travel->paketTravel->nama_paket }}</h3>
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
                <h2>Form Pemesanan {{ $travel->paketTravel->nama_paket }}</h2>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                <label for="c_fname" class="text-black">Tanggal Berangkat</label>
                                <input type="text" class="form-control" value="{{ $travel->tanggal_berangkat }}" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black">Tanggal Pulang</label>
                                    <input type="text" class="form-control" value="{{ $travel->tanggal_pulang }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black">Waktu</label>
                                    <input type="text" class="form-control" value="{{ $travel->waktu }} Hari" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black">Harga</label>
                                    <input type="text" class="form-control" value="{{ number_format($travel->harga) }} / Orang" disabled>
                                </div>
                            </div>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Peserta</th>
                                                <th>Nomor Handphone</th>
                                            </tr>
                                        </thead>
                                        <tbody id="peserta_body">

                                        </tbody>
                                    </table>
                            <div class="col-12 text-center">
                                <a href="#test-form" class="btn btn-info btn-sm">Tambah Peserta</a>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm btn-block mt-4">Buat Pesanan Tiket</button>
                        </form>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>

@endsection
