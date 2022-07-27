<?php

namespace App\Http\Controllers\Admin;

use App\PaketTravel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PaketTravelController extends Controller
{
    public function index()
    {
        $data = PaketTravel::all();
        return view('admin.paket-travel.index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = new PaketTravel();
        $data->nama_paket = $request->nama_paket;

        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $tujuan_upload = 'image/paket-travel/';
            $nama_file = time()."_".$file->getClientOriginalName();
            $nama_file = str_replace(' ', '', $nama_file);
            $file->move($tujuan_upload,$nama_file);

            $data->gambar = $tujuan_upload.$nama_file;
        }
        $data->save();

        if($data != null) {
            Alert::success('Berhasil','Data Tersimpan');
            return redirect()->route('admin.paket-travel.index');
        }else {
            Alert::error('Gagal','Data Tidak Tersimpan');
            return redirect()->route('admin.paket-travel.index');
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

        $data = PaketTravel::findOrFail($id);
        $data->nama_paket = $request->nama_paket;

          if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $tujuan_upload = 'image/paket-travel/';
            $nama_file = time()."_".$file->getClientOriginalName();
            $nama_file = str_replace(' ', '', $nama_file);
            $file->move($tujuan_upload,$nama_file);
            if(file_exists($data->gambar)) {
                unlink($data->gambar);
            }
            $data->gambar = $tujuan_upload.$nama_file;
        }
        $data->save();

        if($data != null) {
            Alert::success('Berhasil','Data Terupdate');
            return redirect()->route('admin.paket-travel.index');
        }else {
            Alert::error('Gagal','Data Tidak Terupdate');
            return redirect()->route('admin.paket-travel.index');
        }
    }

    public function delete($id)
    {
        $data = PaketTravel::findOrFail($id);

        if($data != null) {
            try {
                if(file_exists($data->gambar)) {
                    unlink($data->gambar);
                }
                $data->delete();
                Alert::success('Berhasil','Data Terupdate');
                return redirect()->route('admin.paket-travel.index');
            } catch (\Throwable $e) {
                Alert::error('Gagal','Data Berelasi Dengan Table Lain');
                return redirect()->route('admin.paket-travel.index');
            }
        }

    }
}
