<?php

namespace App\Http\Controllers\pertanian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;


class kelompokpetaniController extends Controller
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

     public function tabelkelompokpetani (){
        return DataTables::of(DB::table('kelompokpetani')
                ->join('desa', 'kelompokpetani.iddesa', '=', 'desa.iddesa')
                ->join('kecamatan', 'desa.idkecamatan', '=', 'kecamatan.idkecamatan')
                ->select('kelompokpetani.*', 'kecamatan.kecamatan as namakecamatan','desa.namadesa as desa')
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
        $jenis = DB::table('jeniskelompoktani')->get();
        return view('pertanian.kelompokpetani',compact('kecamatan','desa','jenis'));
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
        $jenis = $request->get('jeniskelompok');
        DB::table('kelompokpetani')->insert([
            'namakelompok'      => $nama,
            'alamatsekretariat'      => $alamat,
            'iddesa'      => $iddesa,
            'tahunpembentukan'      => $thn,
            'jeniskelompok'      => $jenis
            
        ]);

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah kelompok : $request->nama"
        ]);

        return redirect('/kelompokpetani/create');
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
