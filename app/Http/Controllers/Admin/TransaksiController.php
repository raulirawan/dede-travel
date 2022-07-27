<?php

namespace App\Http\Controllers\Admin;

use App\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {

        if(request()->ajax()) {
            if (!empty($request->from_date)) {
                if ($request->from_date === $request->to_date) {
                    $query  = Transaksi::query();
                    if ($request->status_transaksi != 'SEMUA') {
                        $query->with(['user','travel.paketTravel'])
                        ->whereDate('created_at', $request->from_date)
                        ->where('status', $request->status_transaksi);
                    }else {
                        $query->with(['user','travel.paketTravel'])
                        ->whereDate('created_at', $request->from_date);
                    }


                } else {
                    $query  = Transaksi::query();
                    if ($request->status_transaksi != 'SEMUA') {
                        $query->with(['user','travel.paketTravel'])
                        ->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59'])
                        ->where('status', $request->status_transaksi);
                    } else {
                        $query->with(['user','travel.paketTravel'])
                        ->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
                    }


                }
            } else {
                $today = date('Y-m-d');
                $query  = Transaksi::query();
                if ($request->status_transaksi != 'SEMUA') {
                    $query->with(['user','travel.paketTravel'])
                    ->whereDate('created_at', $today)
                    ->where('status', $request->status_transaksi);
                } else {
                    $query->with(['user','travel.paketTravel'])
                    ->whereDate('created_at', $today);
                }


            }
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                        return '
                        <a
                        href="'.route('admin.transaksi.detail', $item->id).'"
                        class="btn btn-sm font-sm rounded btn-info text-white"
                        >Detail</a>
                        ';
                })
                ->editColumn('status', function($item) {
                    if($item->status == 'PENDING') {
                        return '<span class="badge bg-warning">PENDING</span>';
                    } else if($item->status == 'SUCCESS') {
                        return '<span class="badge bg-success">SUCCESS</span>';
                    }else if($item->status == 'SELESAI') {
                        return '<span class="badge bg-success">SELESAI</span>';
                    }else if($item->status == 'ON PROGRESS') {
                        return '<span class="badge bg-warning">ON PROGRESS</span>';
                    }else if($item->status == 'SUDAH BAYAR') {
                        return '<span class="badge bg-success">SUDAH BAYAR</span>';
                    }else if($item->status == 'CANCELLED') {
                        return '<span class="badge bg-danger">CANCELLED</span>';
                    } else {
                        return '<span class="badge bg-danger">NOTHING</span>';
                    }
                })
                ->editColumn('created_at', function($item) {
                    return $item->created_at;
                })
                ->editColumn('peserta', function($item) {
                    return $item->jumlah_peserta.' Orang';
                })
                ->editColumn('paket_travel', function($item) {
                    return $item->travel->paketTravel->nama_paket;
                })
                ->rawColumns(['action','harga','created_at','status'])
                ->make();
        }
        return view('admin.transaksi.index');
    }

    public function detail($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('admin.transaksi.detail', compact('transaksi'));
    }
}
