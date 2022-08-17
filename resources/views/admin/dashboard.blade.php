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
                  <h5 class="card-title">Customer <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ App\User::where('roles','CUSTOMER')->count() }}</h6>

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
                  <h5 class="card-title">Penghasilan <span>| Bulan Ini</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>Rp{{ number_format(App\Transaksi::whereIn('status',['SELESAI','SUDAH BAYAR'])->whereMonth('created_at',Illuminate\Support\Carbon::now()->month)->sum('total_harga')) }}</h6>
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
                  <h5 class="card-title">Paket Travel<span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ App\Travel::count() }}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            @if (Auth::user()->roles == 'ADMIN')

            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Data Pekerjaan Tour Guide</h5>


                  <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col" class="no">No</th>
                            <th scope="col">Kode Transaksi</th>
                            <th scope="col">Nama Customer</th>
                            <th scope="col">Tour Guide</th>
                            <th scope="col">Paket Travel</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->kode_transaksi }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->tourGuide->name ?? 'Belum Ada' }}</td>
                                <td>{{ $item->travel->paketTravel->nama_paket }}</td>
                                <td>{{ $item->travel->waktu }} Hari</td>
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
                               @if ($item->status == 'SUDAH BAYAR')
                                <td>
                                    <button
                                    id="select-tour"
                                    data-id="{{ $item->id }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-pilih-tour-guide"
                                    class="btn btn-primary btn-sm"
                                    >Pilih Tour Guide</button>
                                </td>
                               @endif
                            </tr>
                        @endforeach


                    </tbody>
                </table>
                </div>

              </div>
            </div><!-- End Reports -->



            <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Data Pekerjaan Selesai Tour Guide</h5>


                    <table class="table datatable">
                      <thead>
                          <tr>
                                <th scope="col" class="no">No</th>
                                <th scope="col">Kode Transaksi</th>
                                <th scope="col">Nama Customer</th>
                                <th scope="col">Paket Travel</th>
                                <th scope="col">Bukti Perjalanan</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="aksi">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach (App\Transaksi::where('status','SELESAI')->orderBy('created_at','DESC')->get() as $item)
                              <tr>
                                  <th scope="row">{{ $loop->iteration }}</th>
                                  <td>{{ $item->kode_transaksi }}</td>
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
                                  <td>
                                      <button
                                      id="review-btn"
                                      data-bs-toggle="modal"
                                      data-bs-target="#review"
                                      data-review="{{ $item->review->review ?? '' }}"
                                      class="btn btn-primary btn-sm" >Review</button>
                                  </td>
                              </tr>
                          @endforeach


                      </tbody>
                  </table>
                  </div>

                </div>
            </div><!-- End Reports -->
            @endif

          </div>
        </div><!-- End Left side columns -->


      </div>
    </section>

  </main><!-- End #main -->

  <div class="modal fade" id="modal-pilih-tour-guide" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Tour Guide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-pilih-tour-guide" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label class="form-label">Data Tour Guide</label>
                            <select name="tour_guide_id" id="tour_guide_id" class="form-control" required>
                                <option value="">Pilih Tour Guide</option>
                                @foreach (App\User::where('roles','TOURGUIDE')->get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
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

<div class="modal fade" id="review" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-pilih-tour-guide" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label class="form-label">Review</label>
                            <textarea name="review" id="review-text" rows="5" class="form-control" readonly></textarea>
                        </div>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
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
        $(document).on('click', '#select-tour', function() {
            var id = $(this).data('id');
            $('#form-pilih-tour-guide').attr('action', '/admin/dashboard/pilih/tour-guide/' + id);
        });

        $(document).on('click', '#review-btn', function() {
            var review = $(this).data('review');
            if(review.length > 0) {
                $("#review-text").val(review);
            }else {
                $("#review-text").val('Tidak Ada Review');
            }
            $('#form-pilih-tour-guide').attr('action', '/admin/dashboard/pilih/tour-guide/' + id);
        });
    });
</script>
@endpush
