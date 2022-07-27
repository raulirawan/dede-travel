@extends('layouts.frontend')

@section('content')
<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Menu Profile</h3>
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
            <div class="col-md-6">
                <h2>Data Profil</h2>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                <label for="c_fname" class="text-black">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="c_fname" class="text-black">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                                </div>
                                <div class="col-md-12">
                                <label for="c_lname" class="text-black">Nomor Handphone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  value="{{ Auth::user()->nomor_handphone }}" name="nomor_handphone" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <h2>Ganti Password</h2>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile.update.password') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                <label for="c_fname" class="text-black">Password Lama<span class="text-danger">*</span></label>
                                <input type="password" name="oldPassword"
                                        class="form-control @error('oldPassword') is-invalid @enderror"
                                        autocomplete="off" placeholder="Password Lama" required>
                                <div class="invalid-feedback">
                                    Masukan Password Lama
                                </div>
                                </div>
                                <div class="col-md-12">
                                <label for="c_lname" class="text-black">Password Baru <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Password Baru" required>
                                <div class="invalid-feedback">
                                    Konfirmasi Password Baru Tidak Sesuai
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="c_lname" class="text-black">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Konfirmasi Password Baru" required>
                                    <div class="invalid-feedback">
                                    Konfirmasi Password Baru Tidak Sesuai
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
