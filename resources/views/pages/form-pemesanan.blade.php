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
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="c_fname" class="text-black">Tanggal Berangkat</label>
                                        <input type="text" class="form-control" value="{{ $travel->tanggal_berangkat }}"
                                            name="name" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="c_fname" class="text-black">Tanggal Pulang</label>
                                        <input type="text" class="form-control" value="{{ $travel->tanggal_pulang }}"
                                            disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="c_fname" class="text-black">Waktu</label>
                                        <input type="text" class="form-control" value="{{ $travel->waktu }} Hari"
                                            disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="c_fname" class="text-black">Harga</label>
                                        <input type="text" class="form-control"
                                            value="{{ number_format($travel->harga) }} / Orang" disabled>
                                    </div>
                                </div>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Peserta</th>
                                            <th>Nomor Handphone</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="peserta_body">

                                    </tbody>
                                </table>
                                <div class="col-12 text-center">
                                    <a class="btn btn-info btn-sm text-white" data-toggle="modal"
                                        data-target="#tambah-peserta">Tambah Peserta</a>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm btn-block mt-4">Buat Pesanan
                                    Tiket</button>
                            </form>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <div class="modal fade" id="tambah-peserta" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Peserta</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label class="form-label">Nama Peserta</label>
                                <input type="text" class="form-control" id="nama_peserta"
                                    placeholder="Masukan Nama Peserta">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Nomor Handphone</label>
                                <input type="number" class="form-control" id="nomor_handphone"
                                    placeholder="Masukan Nomor Handphone">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-primary btn-sm text-white" id="add-peserta">Tambah Peserta</a>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-peserta-modal" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Peserta</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label class="form-label">Nama Peserta</label>
                                <input type="text" class="form-control" id="nama_peserta_edit"
                                    placeholder="Masukan Nama Peserta">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Nomor Handphone</label>
                                <input type="number" class="form-control" id="nomor_handphone_edit"
                                    placeholder="Masukan Nomor Handphone">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-primary btn-sm text-white" id="update-peserta">Update Peserta</a>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @push('down-script')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            $(document).on('click', '#add-peserta', function() {
                var nama_peserta = $("#nama_peserta").val();
                var nomor_handphone = $("#nomor_handphone").val();
                if (nama_peserta.length == 0) {
                    alert('Nama Peserta Tidak Boleh Kosong');
                    return false;
                }
                if (nomor_handphone.length == 0) {
                    alert('Nomor Handphone Tidak Boleh Kosong');
                    return false;
                }
                var tr = '<tr id="tr"> <td>' + nama_peserta + '</td> <td>' + nomor_handphone +
                    '</td> <td><a href="#edit-form" class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#edit-peserta-modal">Edit</a> <a class="btn btn-sm btn-danger btn-delete" style="color:#fff !important;">Delete</a></td></tr>'
                $('#peserta_body').append(tr);
                $("#nama_peserta").val('');
                $("#nomor_handphone").val('');
            });
            var trEdit = null;
            $(document).on('click', '.btn-edit', function() {
                trEdit = $(this).closest('#tr');
                var nama_peserta = $(trEdit).find('td:eq(0)').text();
                var nomor_handphone = $(trEdit).find('td:eq(1)').text();
                $("#nama_peserta_edit").val(nama_peserta);
                $("#nomor_handphone_edit").val(nomor_handphone);
            });

            $(document).on('click', '#update-peserta', function() {
                if (trEdit) {
                    var nama_peserta = $("#nama_peserta_edit").val();
                    var nomor_handphone = $("#nomor_handphone_edit").val();
                    if (nama_peserta.length == 0) {
                        alert('Nama Peserta Tidak Boleh Kosong');
                        return false;
                    }
                    if (nomor_handphone.length == 0) {
                        alert('Nomor Handphone Tidak Boleh Kosong');
                        return false;
                    }
                    $(trEdit).find('td:eq(0)').text(nama_peserta);
                    $(trEdit).find('td:eq(1)').text(nomor_handphone);
                    alert('Berhasil Update');
                    trEdit = null;
                    $('#edit-peserta-modal').modal('hide');
                    $('.modal-backdrop').remove();
                }
            });

            $(document).on('click', '.btn-delete', function() {
                if(confirm("Yakin Ingin Di Hapus ?")) {
                    $(this).closest('#tr').remove();
                }
            });
        </script>
    @endpush
@endsection
