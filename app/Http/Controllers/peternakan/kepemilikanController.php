<?php

namespace App\Http\Controllers\peternakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;
use Yajra\Datatables\Datatables;

class kepemilikanController extends Controller
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


    public function tabelkepemilikan()
    {
        return DataTables::of(DB::table('kepemilikan')
            ->join('datapeternak', 'kepemilikan.idpeternak', '=', 'datapeternak.idpeternak')
            ->join('jenisternak', 'kepemilikan.idjenis', '=', 'jenisternak.idjenis')
            ->select('kepemilikan.*','datapeternak.nama as namapeternak', 'datapeternak.alamat as alamatpeternak', 'jenisternak.jenisternak as jenis')
            ->get())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="" class="hapus-data"><i class="material-icons">delete</i></a>';
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

        $jenisternak = DB::table('jenisternak')->get();
        return view('peternakan.kepemilikan', compact('jenisternak'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $idpeternak = $request->get('idpeternak');
        $idjenis = $request->get('idjenis');
        $jumlah = $request->get('jumlah');
        DB::table('kepemilikan')->insert([
            'idpeternak'      => $idpeternak,
            'idjenis'      => $idjenis,
            'jumlahternak'      => $jumlah,
        ]);

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah data!"
        ]);

        return redirect('/kepemilikan/create');
    }
    public function ceknik ($id){
        $x = DB::table('datapeternak')->where('nik',$id)->get();
        return response()->json($x);
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
