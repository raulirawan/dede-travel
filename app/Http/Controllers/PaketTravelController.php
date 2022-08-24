<?php

namespace App\Http\Controllers;

use Exception;
use App\Travel;
use App\Transaksi;
use Midtrans\Snap;
use App\PaketTravel;
use Midtrans\Config;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaketTravelController extends Controller
{
    public function index($id)
    {
        $paketTravel = PaketTravel::findOrFail($id);
        return view('pages.paket-travel', compact('paketTravel'));
    }

    public function formTravel($id)
    {
        $travel = Travel::findOrFail($id);
        return view('pages.form-pemesanan', compact('travel'));
    }

    public function pesan(Request $request)
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $kode_transaksi = 'DT-' . mt_rand(00000, 99999);
        $peserta = $request->data_peserta;
        // data_peserta
        if ($peserta != null) {
            $data_peserta = [];
            $junlah_peserta = 0;
            foreach ($peserta as $key => $value) {
                $kode_tiket = strtoupper(Str::random(8));
                $junlah_peserta += 1;
                $data_peserta[] = [
                    'nama_peserta' => $value[0],
                    'nomor_handphone' => $value[1],
                    'kode_tiket' => $kode_tiket,
                ];
            }

            $data_peserta = json_encode($data_peserta);
        }
        $travel = Travel::where('id', $request->travel_id)->first();
        if ($junlah_peserta > $travel->kuota) {
            return response()->json([
                'message' => 'Kuota Melebihi Batas, Silahkan Coba Lagi!',
                'status'  => 'gagal',
                'url' => route('form.pemesanan.travel.index', $request->travel_id),
            ]);
        }
        $transaksi = new Transaksi();
        $transaksi->user_id = Auth::user()->id;
        $transaksi->travel_id = $request->travel_id;
        $transaksi->kode_transaksi = $kode_transaksi;
        $transaksi->peserta_temp = $data_peserta;
        $transaksi->jumlah_peserta = $junlah_peserta;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->status = 'PENDING';

        // kirim ke midtrans
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => $kode_transaksi,
                'gross_amount' => (int) $request->total_harga,
            ],

            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'callbacks' => [
                'finish' => url('transaksi'),
            ],
            'enable_payments' => ['bca_va', 'permata_va', 'bni_va', 'bri_va', 'gopay'],
            'vtweb' => [],
        ];

        try {
            //ambil halaman payment midtrans

            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;
            $transaksi->link_pembayaran = $paymentUrl;
            $transaksi->save();

            if ($transaksi != null) {
                // kirim email
                return response()->json([
                    'message' => 'Data Transaksi Berhasil di Buat',
                    'status'  => 'success',
                    'url' => $paymentUrl,
                ]);
            } else {
                return response()->json([
                    'message' => 'Data Transaksi Gagal di Buat, Coba Lagi Ya',
                    'status'  => 'gagal',
                    'url' => route('form.pemesanan.travel.index', $request->travel_id),
                ]);
            }
            //reditect halaman midtrans
        } catch (Exception $e) {
            echo $e->getMessage();
            return response()->json([
                'message' => 'Data Transaksi Gagal di Buat, Coba Lagi Ya',
                'status'  => 'gagal',
                'url' => route('form.pemesanan.travel.index', $request->travel_id),
            ]);
        }
    }
}
