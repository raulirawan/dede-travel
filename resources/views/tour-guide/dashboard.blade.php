@extends('layouts.panel')

@section('title','Admin Panel')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>

                </div>

                <div class="card-body">
                  <h5 class="card-title">Jumlah Pekerjaan</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ App\Transaksi::where(['tour_guide_id' => Auth::user()->id])->count() }}</h6>


                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>

                </div>

                <div class="card-body">
                  <h5 class="card-title">Pekerjaan ON Progress</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ App\Transaksi::where(['tour_guide_id' => Auth::user()->id, 'status' => 'ON PROGRESS'])->count() }}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>

                </div>

                <div class="card-body">
                  <h5 class="card-title">Pekerjaan Selesai</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ App\Transaksi::where(['tour_guide_id' => Auth::user()->id, 'status' => 'SELESAI'])->count() }}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->



            <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Data Pekerjaan</h5>


                    <table class="table datatable">
                      <thead>
                          <tr>
                                <th scope="col" class="no">No</th>
                                <th scope="col">Nama Customer</th>
                                <th scope="col">Paket Travel</th>
                                <th scope="col">Bukti Perjalanan</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="aksi">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach (App\Transaksi::where(['tour_guide_id' => Auth::user()->id])->whereIn('status',['SELESAI','ON PROGRESS'])->orderBy('created_at','desc')->get() as $item)
                              <tr>
                                  <th scope="row">{{ $loop->iteration }}</th>
                                  <td>{{ $item->user->name }}</td>
                                  <td>{{ $item->travel->paketTravel->nama_paket }}</td>
                                  <td>
                                    @if($item->bukti_perjalanan != null)
                                    <img src="{{ asset($item->bukti_perjalanan) }}" style="width: 100px">
                                    @else
                                    <span>Tidak Ada</span>
                                    @endif
                                  </td>
                                  <td>
                                    @if ($item->status == 'SUDAH BAYAR')
                                    <span class="badge bg-success">SUDAH BAYAR</span>
                                    @elseif($item->status == 'PENDING')
                                    <span class="badge bg-warning">PENDING</span>
                                    @elseif($item->status == 'SELESAI')
                                    <span class="badge bg-success">SELESAI</span>
                                    @elseif($item->status == 'ON PROGRESS')
                                    <span class="badge bg-warning">ON PROGRESS</span>
                                    @else
                                    <span class="badge bg-danger">CANCELLED</span>
                                    @endif
                                </td>
                                @if ($item->status == 'ON PROGRESS')
                                <td>
                                    <button
                                    id="btn-upload-bukti"
                                    data-id="{{ $item->id }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-upload-bukti"
                                    class="btn btn-primary btn-sm" >Upload Bukti</button>
                                </td>
                                @endif
                              </tr>
                          @endforeach


                      </tbody>
                  </table>
                  </div>

                </div>
              </div><!-- End Reports -->

          </div>
        </div><!-- End Left side columns -->


      </div>
    </section>

  </main><!-- End #main -->

  <div class="modal fade" id="modal-upload-bukti" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Upload Bukti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-upload-bukti" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label class="form-label">Upload Bukti Perjalanan</label>
                            <input type="file" class="form-control" name="bukti_perjalanan" required>
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


<script>
    $(document).ready(function() {
        $(document).on('click', '#btn-upload-bukti', function() {
            var id = $(this).data('id');
            $('#form-upload-bukti').attr('action', '/tour-guide/upload-bukti/' + id);
        });


    });
</script>
@endpush
