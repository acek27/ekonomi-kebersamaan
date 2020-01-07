<?php

namespace App\Http\Controllers\ekonomi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class pelakuController extends Controller
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
   

    public function tabelpelaku (){
        return DataTables::of(DB::table('pelakuekonomi')
                ->join('kecamatan', 'pelakuekonomi.idkecamatan', '=', 'kecamatan.idkecamatan')
                ->select('pelakuekonomi.*', 'kecamatan.kecamatan as namakecamatan')
                ->get())
                ->addColumn('action', function ($data) {
                    $del = '<a href="#" data-id="' . $data->idpelaku . '" class="hapus-data"><i class="material-icons">delete</i></a>';
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
        return view('ekonomi.pelakuekonomi',compact('kecamatan'));
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
        $nik = $request->get('nik');
        $telp = $request->get('telp');
        $idkecamatan = $request->get('idkecamatan');
        DB::table('pelakuekonomi')->insert([
            'nik'      => $nik,
            'nama'      => $nama,
            'alamat'      => $alamat,
            'telp'      => $telp,
            'idkecamatan'     => $idkecamatan
        ]);

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah data : $request->nama"
        ]);

        return redirect('/pelakuekonomi/create');
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
