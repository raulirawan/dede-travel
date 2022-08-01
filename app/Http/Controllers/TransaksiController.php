<?php

namespace App\Http\Controllers;

use App\Review;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        if($request->transaction_status == 'settlement') {
            Alert::success('Success','Pembayaran Berhasil '.$request->order_id ?? '');
        }
        return view('pages.transaksi');
    }

    public function detail($id)
    {
        $transaksi = Transaksi::where(['user_id' => Auth::user()->id, 'id' => $id])->firstOrFail();
        return view('pages.transaksi-detail', compact('transaksi'));
    }

    public function addReview(Request $request, $transaksi_id)
    {
        $transaksi = Transaksi::findOrFail($transaksi_id);

        $review = new Review();
        $review->travel_id = $transaksi->travel_id;
        $review->review = $request->review;
        $review->save();

        $transaksi->review_id = $review->id;
        $transaksi->save();

        if($transaksi != null) {
            Alert::success('Terima Kasih Atas Review Anda!');
            return redirect()->route('transaksi.index');
        } else {
            Alert::error('Gagal Tambah Review Coba Lagi!');
            return redirect()->route('transaksi.index');
        }
    }

    public function downloadTiket($id)
    {
        $transaction = Transaksi::findOrFail($id);
        $pdf = Pdf::loadView('tiket', compact('transaction'));
        $pdf->setPaper('a7', 'potrait')->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->download('tiket.pdf');
    }
}
