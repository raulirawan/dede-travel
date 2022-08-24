<?php

namespace App\Http\Controllers;

use PDF;
use App\Tiket;
use App\Transaksi;
use App\Travel;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        //set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        //buat instance midtrans
        $notification = new Notification();

        //assign ke variable untuk memudahkan coding

        $status = $notification->transaction_status;

        $transaction = Transaksi::where('kode_transaksi', $notification->order_id)->first();
        // handler notification status midtrans
        if ($status == "settlement") {
            $data['email'] = $transaction->user->email;
            $transaction->status = 'SUDAH BAYAR';
            $pdf = Pdf::loadView('tiket', compact('transaction'));
            $pdf->setPaper('a7', 'potrait')->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            Mail::send('email.tiket', $data, function ($message) use ($data, $pdf) {
                $message->to($data['email'], $data['email'])
                    ->subject('Tiket Travel Anda')
                    ->attachData($pdf->output(), "tiket.pdf");
            });
            //   creatte table tiket
            foreach (json_decode($transaction->peserta_temp) as $item) {
                $tiket = new Tiket();
                $tiket->transaksi_id = $transaction->id;
                $tiket->travel_id = $transaction->travel_id;
                $tiket->kode_tiket = $item->kode_tiket;
                $tiket->nama_peserta = $item->nama_peserta;
                $tiket->nomor_handphone = $item->nomor_handphone;
                $tiket->status = 'ACTIVE';
                $tiket->save();
            }
            $travel = Travel::where('id', $transaction->travel_id)->first();
            $travel->kuota = $travel->kuota - $transaction->jumlah_peserta;
            $travel->save();
            $transaction->save();

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Payment Success'
                ]
            ]);
        } else if ($status == "pending") {
            $transaction->status = 'PENDING';
            $transaction->save();
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Payment Pending'
                ]
            ]);
        } else if ($status == 'deny') {
            $transaction->status = 'CANCELLED';
            $transaction->save();
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Payment Deny'
                ]
            ]);
        } else if ($status == 'expired') {
            $transaction->status = 'CANCELLED';
            $transaction->save();
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Payment Expired'
                ]
            ]);
        } else if ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
            $transaction->save();
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Payment Cancel'
                ]
            ]);
        } else {
            $transaction->status = 'CANCELLED';
            $transaction->save();
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'message' => 'Midtrans Payment Gagal'
                ]
            ]);
        }
    }
}
