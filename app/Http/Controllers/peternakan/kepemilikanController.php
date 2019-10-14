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
            ->join('peternak', 'kepemilikan.idpeternak', '=', 'peternak.idpeternak')
            ->join('jenisternak', 'kepemilikan.idjenis', '=', 'jenisternak.idjenis')
            ->select('kepemilikan.*', 'peternak.nama as namapeternak', 'peternak.alamat as alamatpeternak', 'jenisternak.jenisternak as jenis')
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $idpeternak = $request->get('idpeternak');
        $idjenis = $request->get('idjenis');
        $jumlah = $request->get('jumlah');
        $lokasi = $request->get('lokasi');
        DB::table('kepemilikan')->insert([
            'idpeternak' => $idpeternak,
            'idjenis' => $idjenis,
            'jumlahternak' => $jumlah,
            'lokasiternak' => $lokasi,
        ]);

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah data!"
        ]);

        return redirect('/kepemilikan/create');
    }

    public function ceknik($id)
    {
        $pengecekan = DB::table('peternak')->select('*')->where('nik', '=', $id);
        if ($pengecekan->exists()) {
            $x = DB::table('peternak')
                ->join('desa', 'desa.iddesa', '=', 'peternak.iddesa')
                ->join('kecamatan', 'kecamatan.idkecamatan', '=', 'desa.idkecamatan')
                ->select('peternak.*', 'kecamatan.kecamatan', 'desa.namadesa')
                ->where('nik', $id)->get();
            return response()->json($x);
        } else {
            $array = array();
            $x = DB::table('peternak')
                ->join('kecamatan', 'peternak.idkecamatan', '=', 'kecamatan.idkecamatan')
                ->join('desa', 'desa.iddesa', '=', 'peternak.iddesa')
                ->select('peternak.*', 'kecamatan.kecamatan', 'desa.namadesa')
                ->where('nik', $array)->get();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
