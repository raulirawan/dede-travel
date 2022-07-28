<?php

namespace App\Http\Controllers;

use App\PaketTravel;
use App\Travel;
use Illuminate\Http\Request;

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
}
