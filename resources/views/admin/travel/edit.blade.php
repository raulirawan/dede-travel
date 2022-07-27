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
                          <h5 class="card-title">Form Edit Jadwal {{ $paketTravel->nama_paket }}</h5>

                          <!-- Multi Columns Form -->
                          <form action="{{ route('admin.travel.update') }}" class="row g-3" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="paket_travel_id" value="{{ $paketTravel->id }}">
                            <input type="hidden" name="travel_id" value="{{ $travel->id }}">
                            <div class="col-md-6">
                              <label for="inputName5" class="form-label">Tanggal Berangkat</label>
                              <input type="date" class="form-control" id="inputName5" value="{{ $travel->tanggal_berangkat }}" name="tanggal_berangkat">
                            </div>
                            <div class="col-md-6">
                              <label for="inputEmail5" class="form-label">Tanggal Pulang</label>
                              <input type="date" class="form-control" id="inputEmail5" value="{{ $travel->tanggal_pulang }}" name="tanggal_pulang">
                            </div>
                            <div class="col-md-6">
                              <label for="inputPassword5" class="form-label">Kuota</label>
                              <input type="number" class="form-control" id="inputPassword5" value="{{ $travel->kuota }}" name="kuota" placeholder="Kuota">
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword5" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="inputPassword5" value="{{ $travel->harga }}" name="harga" placeholder="Harga">
                              </div>
                              <div class="col-md-12">
                                <label for="inputPassword5" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control"  placeholder="Deskripsi">{{ $travel->deskripsi }}</textarea>
                              </div>

                            <div class="">
                              <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>
                          </form><!-- End Multi Columns Form -->

                        </div>
                      </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->



@endsection

@push('down-script')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'deskripsi' );
</script>
@endpush
