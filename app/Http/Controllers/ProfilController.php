<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
class ProfilController extends Controller
{
    public function index()
    {
        return view('pages.profile');
    }

    public function update(Request $request)
    {
        $data = User::findOrFail(Auth::user()->id);
        $data->name = $request->name;
        $data->nomor_handphone = $request->nomor_handphone;
        $data->save();

        if($data != null) {
            Alert::success('Berhasil Ubah Profil');
            return redirect()->route('profile.index');
        } else {
            Alert::error('Gagal Ubah Profil');
            return redirect()->route('profile.index');
        }
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'oldPassword' => 'required',
            'password' => 'required|confirmed',

            ]);

            if(!(Hash::check($request->get('oldPassword'), Auth::user()->password))){

                Alert::error('Password Lama Anda Salah');
                return redirect()->route('profile.index');

            }

            if(strcmp($request->get('oldPassword'), $request->get('password')) == 0){
                Alert::error('Password Lama Anda Tidak Boleh Sama Dengan Password Baru');
                return redirect()->route('profile.index');
            }

            $user = Auth::user();
            $user->password = bcrypt($request->get('password'));
            $user->save();
            Alert::success('Password Anda Berhasil di Ganti');
            return redirect()->route('profile.index');
    }

    public function tes()
    {
        $pdf = Pdf::loadView('tiket');
        $pdf->setPaper('a7', 'potrait')->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->download('tes.pdf');
    }
}
