<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return redirect('/dashboard');
    }

    public function cetak ()
    {
        $data =   DB::table('keanggotaanpoktan')->get();
        $pdf = PDF::loadView('myPDF', compact('data'))->setPaper('folio', 'potrait');
        return $pdf->stream('MoU Kobessa');
    }
}
