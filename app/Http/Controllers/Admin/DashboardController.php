<?php

namespace App\Http\Controllers\Admin;

use App\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::whereIn('status',['SUDAH BAYAR','ON PROGRESS'])->orderBy('created_at','desc')->get();
        return view('admin.dashboard', compact('transaksi'));
    }

    public function pilihTourGuide(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->tour_guide_id = $request->tour_guide_id;
        $transaksi->status = 'ON PROGRESS';
        $transaksi->save();

        if($transaksi != null) {
            Alert::success('Berhasil','Data Terupdate');
            return redirect()->route('admin.dashboard.index');
        }else {
            Alert::error('Gagal','Data Tidak Terupdate');
            return redirect()->route('admin.dashboard.index');
        }
    }
}
