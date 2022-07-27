<?php

namespace App\Http\Controllers\TourGuide;

use App\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        return view('tour-guide.dashboard');
    }

    public function uploadBukti(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if($request->hasFile('bukti_perjalanan')) {
            $file = $request->file('bukti_perjalanan');
            $tujuan_upload = 'image/bukti-perjalanan/';
            $nama_file = time()."_".$file->getClientOriginalName();
            $nama_file = str_replace(' ', '', $nama_file);
            $file->move($tujuan_upload,$nama_file);

            $transaksi->bukti_perjalanan = $tujuan_upload.$nama_file;
        }
        $transaksi->status = 'SELESAI';
        $transaksi->save();

        if($transaksi != null) {
            Alert::success('Berhasil','Data Terupdate');
            return redirect()->route('tour.guide.dashboard.index');
        }else {
            Alert::error('Gagal','Data Tidak Terupdate');
            return redirect()->route('tour.guide.dashboard.index');
        }
    }
}
