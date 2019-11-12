<?php

namespace App\Http\Controllers\peternakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class hasilpeternakanController extends Controller
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
    public function tabelcaripeternak()
    {
        return DataTables::of(DB::table('keanggotaanpokter')
            ->join('biodatauser', 'keanggotaanpokter.nik', '=', 'biodatauser.nik')
            ->join('desa', 'desa.iddesa', '=', 'keanggotaanpokter.iddesa')
            ->join('kelompok', 'kelompok.idkelompok', '=', 'keanggotaanpokter.idkelompok')
            ->select('keanggotaanpokter.*', 'biodatauser.nama as nama', 'biodatauser.nik as nik', 'biodatauser.alamat as alamat', 'desa.namadesa as namadesa', 'kelompok.namakelompok as namakelompok')
            ->get())
            ->addColumn('action', function ($data) {
                // $del = '<a href="#" data-id="" class="hapus-data"><i class="material-icons">delete</i></a>';
                $input = "<a href=\"" . route('hasilpeternakan.show', $data->idkeanggotaan) . "\"><i class=\"material-icons\" title=\"Detail Hasil Peternakan\">Input</i></a>";
                return $input;
            })
            ->make(true);
    }

    public function create()
    {

        return view('peternakan.hasilpeternakan');
    }

    public function cari()
    {
        return view('peternakan.caripeternak');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->get('idkeanggotaan');
        $idjenis = $request->get('idjenis');
        $jumlah = $request->get('jumlah');
        $tgl = $request->get('tgl');
        DB::table('hasilternak')->insert([
            'idkeanggotaan' => $id,
            'id_produk' => $idjenis,
            'jumlah' => $jumlah,
            'tglupdate' => $tgl,
        ]);

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah data : $request->nama"
        ]);

        return redirect('/hasilpeternakan' . '/' . $id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jenis = DB::table('jenisternak')->get();
        $produk = DB::table('produkpeternakan')->get();
        $data = DB::table('keanggotaanpokter')
            ->join('biodatauser', 'keanggotaanpokter.nik', '=', 'biodatauser.nik')
            ->join('jenisternak', 'keanggotaanpokter.idjenis', '=', 'jenisternak.idjenis')
            ->join('desa', 'keanggotaanpokter.iddesa', '=', 'desa.iddesa')
            ->join('kelompok', 'keanggotaanpokter.idkelompok', '=', 'kelompok.idkelompok')
            ->where('idkeanggotaan', '=', $id)->get();
        $no = $id;
        return view('peternakan.hasilpeternakan', compact('data', 'jenis', 'produk', 'no'));

    }

    public function cekhasil($id, $no)
    {
        $pengecekan = DB::table('hasilternak')->where('id_produk', $id)
            ->where('idkeanggotaan', $no);
        if ($pengecekan->exists()) {
            $x = DB::table('hasilternak')->select(DB::raw('SUM(jumlah)as total'))->where('id_produk', $id)
                ->where('idkeanggotaan', $no)
                ->get();
            return response()->json($x);
        } else {
            $x = DB::table('hasilternak')->select('0 as jumlah')->get();
            return response()->json($x);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
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
    public
    function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
