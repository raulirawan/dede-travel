<?php

namespace App\Http\Controllers\Admin;

use App\Travel;
use App\PaketTravel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tiket;
use RealRashid\SweetAlert\Facades\Alert;

class TravelController extends Controller
{
    public function index($id)
    {
        $paketTravel = PaketTravel::findOrFail($id);

        $data = Travel::where('paket_travel_id', $id)->orderBy('created_at','DESC')->get();
        return view('admin.travel.index', compact('data','paketTravel'));
    }

    public function create($id)
    {
        $paketTravel = PaketTravel::findOrFail($id);

        return view('admin.travel.create', compact('paketTravel'));
    }

    public function store(Request $request)
    {
        $tanggal_berangkat = strtotime($request->tanggal_berangkat);
        $tanggal_pulang = strtotime($request->tanggal_pulang);

        $jarak = $tanggal_pulang - $tanggal_berangkat;

        $hari = $jarak / 60 / 60 / 24;

        $data = new Travel();
        $data->paket_travel_id = $request->paket_travel_id;
        $data->kuota = $request->kuota;
        $data->harga = $request->harga;
        $data->tanggal_berangkat = $request->tanggal_berangkat;
        $data->tanggal_pulang = $request->tanggal_pulang;
        $data->waktu = $hari;
        $data->deskripsi = $request->deskripsi;
        $data->save();

        if($data != null) {
            Alert::success('Berhasil','Data Tersimpan');
            return redirect()->route('admin.travel.index', $request->paket_travel_id);
        }else {
            Alert::error('Gagal','Data Tidak Tersimpan');
            return redirect()->route('admin.travel.index', $request->paket_travel_id);
        }


        return view('admin.travel.create', compact('paketTravel'));
    }

    public function edit($id)
    {

        $travel = Travel::findOrFail($id);
        $paketTravel = PaketTravel::findOrFail($travel->paket_travel_id);
        return view('admin.travel.edit', compact('paketTravel','travel'));
    }

    public function update(Request $request)
    {

        $data = Travel::findOrFail($request->travel_id);

        $tanggal_berangkat = strtotime($request->tanggal_berangkat);
        $tanggal_pulang = strtotime($request->tanggal_pulang);

        $jarak = $tanggal_pulang - $tanggal_berangkat;

        $hari = $jarak / 60 / 60 / 24;

        $data->kuota = $request->kuota;
        $data->harga = $request->harga;
        $data->tanggal_berangkat = $request->tanggal_berangkat;
        $data->tanggal_pulang = $request->tanggal_pulang;
        $data->waktu = $hari;
        $data->deskripsi = $request->deskripsi;
        $data->save();

        if($data != null) {
            Alert::success('Berhasil','Data Terupdate');
            return redirect()->route('admin.travel.index', $request->paket_travel_id);
        }else {
            Alert::error('Gagal','Data Tidak Terupdate');
            return redirect()->route('admin.travel.index', $request->paket_travel_id);
        }
    }

    public function delete($id)
    {
        $data = Travel::findOrFail($id);

        if($data != null) {
            try {
                $data->delete();
                Alert::success('Berhasil','Data Terhapus');
                return redirect()->route('admin.travel.index', $data->paket_travel_id);
            } catch (\Throwable $e) {
                Alert::error('Gagal','Data Berelasi Dengan Table Lain');
                return redirect()->route('admin.travel.index', $data->paket_travel_id);
            }
        }

    }

    public function tiket($id)
    {
        $travel = Travel::findOrFail($id);
        $data = Tiket::where('travel_id', $id)->orderBy('created_at','desc')->get();
        return view('admin.travel.tiket.index', compact('data','travel'));
    }

    public function updateTiket(Request $request , $travel_id)
    {
        $data = Tiket::where(['travel_id' => $travel_id, 'kode_tiket' => $request->kode_tiket])->first();
        if($data!=null) {
            $data->status = 'EXPIRED';
            $data->save();
            Alert::success('Berhasil','Data Terupdate');
            return redirect()->route('admin.travel.tiket.index', $travel_id);
        }else {
            Alert::error('Gagal','Data Tidak Di Termukan');
            return redirect()->route('admin.travel.tiket.index', $travel_id);
        }
    }
}
