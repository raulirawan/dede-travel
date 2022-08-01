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
                <h2>Data Transaksi</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Paket Travel</th>
                                    <th scope="col">Peserta</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Detail</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach (App\Transaksi::where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->get() as $item)
                                <tr>
                                    <th>{{ $item->created_at }}</th>
                                    <td>{{ $item->kode_transaksi }}</td>
                                    <td>{{ $item->travel->paketTravel->nama_paket }}</td>
                                    <td>{{ $item->jumlah_peserta }} Orang</td>
                                    <td>{{ number_format($item->total_harga) }}</td>
                                    <td>
                                        @if ($item->status == 'SUDAH BAYAR')
                                        <span class="badge bg-success text-white">SUDAH BAYAR</span>
                                        @elseif($item->status == 'PENDING')
                                        <span class="badge bg-warning text-white">PENDING</span>
                                        @elseif($item->status == 'SELESAI')
                                        <span class="badge bg-success text-white">SELESAI</span>
                                        @elseif($item->status == 'ON PROGRESS')
                                        <span class="badge bg-warning text-white">ON PROGRESS</span>
                                        @else
                                        <span class="badge bg-danger text-white">CANCELLED</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('transaksi.detail', $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                        @if ($item->status == 'PENDING')
                                        <a href="{{ url($item->link_pembayaran ?? '') }}" target="_blank" class="btn btn-success btn-sm">Bayar</a>
                                        @endif
                                        @if ($item->review_id == null && $item->status == 'SELESAI')
                                        <button
                                        id="tulis-review-btn"
                                        data-toggle="modal"
                                        data-target="#review"
                                        data-id="{{ $item->id }}"
                                        class="btn btn-success btn-sm">Tulis Review</button>
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

<div class="modal fade" id="review" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tulis Review</h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-tambah-review" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label class="form-label">Review</label>
                            <textarea name="review" id="review-text" rows="5" placeholder="Masukan Review Anda" class="form-control" required></textarea>
                        </div>
                    </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>

    </div>
</div>
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous"></script>
<script>
     $(document).on('click', '#tulis-review-btn', function() {
            var id = $(this).data('id');

            $('#form-tambah-review').attr('action', '/add/review/' + id);
    });

</script>
@endsection
