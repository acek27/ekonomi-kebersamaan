<?php

namespace App\Http\Controllers\pertanian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class hasilpertanianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabelcaritani()
    {
        return DataTables::of(DB::table('keanggotaanpoktan')
            ->join('biodatauser', 'keanggotaanpoktan.nik', '=', 'biodatauser.nik')
            ->join('desa', 'desa.iddesa', '=', 'keanggotaanpoktan.iddesa')
            ->join('kelompok', 'kelompok.idkelompok', '=', 'keanggotaanpoktan.idkelompok')
            ->select('keanggotaanpoktan.*', 'biodatauser.nama as namapetani', 'biodatauser.nik as nik', 'biodatauser.alamat as alamat', 'desa.namadesa as namadesa', 'kelompok.namakelompok as namakelompok')
            ->get())
            ->addColumn('action', function ($data) {
                // $del = '<a href="#" data-id="" class="hapus-data"><i class="material-icons">delete</i></a>';
                $input = "<a href=\"" . route('hasilpertanian.show', $data->idkeanggotaan) . "\"><i class=\"material-icons\" title=\"Detail Hasil Pertanian\">Input</i></a>";
                return $input;
            })
            ->make(true);
    }

    public function create()
    {

        return view('pertanian.hasilpertanian');
    }
    public function cari()
    {

        return view('pertanian.caripetani');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->get('idkeanggotaan');
        $idjenis = $request->get('idjenis');
        $jumlah = $request->get('hasil');
        DB::table('hasiltani')->insert([
            'idkeanggotaan'      => $id,
            'idjenis'      => $idjenis,
            'jumlah'     => $jumlah
        ]);

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah data : $request->nama"
        ]);

        return redirect('/hasilpertanian'.'/'.$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jenis = DB::table('jenistanaman')->get();
        $data = DB::table('keanggotaanpoktan')
            ->join('biodatauser', 'keanggotaanpoktan.nik', '=', 'biodatauser.nik')
            ->join('desa', 'keanggotaanpoktan.iddesa', '=', 'desa.iddesa')
            ->join('kelompok', 'keanggotaanpoktan.idkelompok', '=', 'kelompok.idkelompok')
            ->where('idkeanggotaan', '=', $id)->get();
        return view('pertanian.hasilpertanian', compact('data', 'jenis'));


        // print_r($data);
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
        $idjenis = $request->get('idjenis');
        $jumlah = $request->get('hasil');
        DB::table('hasiltani')->insert([
            'idkeanggotaan'      => $id,
            'idjenis'      => $idjenis,
            'jumlah'     => $jumlah
        ]);

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah data : $request->nama"
        ]);
        return $id;
        // return redirect('/hasilpertanian/create');
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
