<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class TourGuideController extends Controller
{
    public function index()
    {
        $data = User::where('roles','TOURGUIDE')->get();
        return view('admin.tour-guide.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'email' => 'unique:users,email',
            ],
            [
                'email.unique' => 'Email Sudah Terdaftar',
            ]
        );

        $data = new User();
        $data->name = $request->nama_tour_guide;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->nomor_handphone = $request->nomor_handphone;
        $data->roles = 'TOURGUIDE';
        $data->save();

        if($data != null) {
            Alert::success('Berhasil','Data Tersimpan');
            return redirect()->route('admin.tour-guide.index');
        }else {
            Alert::error('Gagal','Data Tidak Tersimpan');
            return redirect()->route('admin.tour-guide.index');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'email_edit' => 'unique:users,email,'.$id,
            ],
            [
                'email_edit.unique' => 'Email Sudah Terdaftar',
            ]
        );

        $data = User::findOrFail($id);
        $data->name = $request->nama_tour_guide;
        $data->email = $request->email_edit;
        $data->nomor_handphone = $request->nomor_handphone;
        $data->save();

        if($data != null) {
            Alert::success('Berhasil','Data Terupdate');
            return redirect()->route('admin.tour-guide.index');
        }else {
            Alert::error('Gagal','Data Tidak Terupdate');
            return redirect()->route('admin.tour-guide.index');
        }
    }

    public function delete($id)
    {
        $data = User::findOrFail($id);

        if($data != null) {
            try {
                $data->delete();
                Alert::success('Berhasil','Data Terupdate');
                return redirect()->route('admin.tour-guide.index');
            } catch (\Throwable $e) {
                Alert::error('Gagal','Data Berelasi Dengan Table Lain');
                return redirect()->route('admin.tour-guide.index');
            }
        }

    }
}

