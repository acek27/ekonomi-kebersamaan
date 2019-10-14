<?php

namespace App\Http\Controllers\peternakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;


class kelompokpeternakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

     public function tabelkelompokpeternak (){
        return DataTables::of(DB::table('kelompokternak')
                ->join('desa', 'kelompokternak.iddesa', '=', 'desa.iddesa')
                ->join('kecamatan', 'kecamatan.idkecamatan', '=', 'desa.idkecamatan')
                ->select('kelompokternak.*', 'kecamatan.kecamatan as namakecamatan', 'desa.namadesa as desa')
                ->get())
                ->addColumn('action', function ($data) {
                    $del = '<a href="#" class="hapus-data"><i class="material-icons">delete</i></a>';
                    $edit = '<a href="#"><i class="material-icons">edit</i></a>';
                    return $edit . '&nbsp' . $del;
                })
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = DB::table('kecamatan')->get();
        $desa = DB::table('desa')->get();
        return view('peternakan.kelompokpeternak',compact('kecamatan','desa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama = $request->get('nama');
        $alamat = $request->get('alamat');
        $iddesa = $request->get('iddesa');
        $thn = $request->get('thn');
        $idkecamatan = $request->get('idkecamatan');
        DB::table('kelompokternak')->insert([
            'namakelompokternak'      => $nama,
            'iddesa'     => $iddesa,
            'alamatsekretariat'     => $alamat,
            'tahunpembentukan'     => $thn,
            'idkecamatan'     => $idkecamatan
        ]);

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah kelompok : $request->nama"
        ]);

        return redirect('/kelompokpeternak/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
