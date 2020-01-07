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

    public function tabelkelompokpeternak()
    {
        return DataTables::of(DB::table('kelompok')
            ->join('desa', 'kelompok.iddesa', '=', 'desa.iddesa')
            ->join('kecamatan', 'kecamatan.idkecamatan', '=', 'desa.idkecamatan')
            ->select('kelompok.*', 'kecamatan.kecamatan as namakecamatan', 'desa.namadesa as desa')
            ->where('sektor','=','peternakan')
            ->get())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->idkelompok . '" class="hapus-data"><i class="fas fa-trash"></i></a>';
                $edit = '<a href="#" data-id="' . $data->idkelompok . '" class="edit-modal"><i class="fas fa-edit"></i></a>';
                return $edit . '&nbsp' . '&nbsp' . $del;
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
        return view('peternakan.kelompokpeternak', compact('kecamatan'));
    }

    public function datadesa($id)
    {
        $data = DB::table('desa')->where('idkecamatan', '=', $id)
            ->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama = $request->get('nama');
        $alamat = $request->get('alamat');
        $iddesa = $request->get('iddesa');
        $thn = $request->get('thn');
        $id = $request->get('id');

        $pengecekan = DB::table('kelompok')->select('*')
            ->where('idkelompok', '=', $id);
       //     ->where('namakelompok', '=', $nama);

        if ($pengecekan->exists()) {
            DB::table('kelompok')
                ->where('idkelompok', '=', $id)
                ->update([
                    'namakelompok' => $nama,
                    'iddesa' => $iddesa,
                    'alamatsekretariat' => $alamat,
                    'tahunpembentukan' => $thn
                ]);

            \Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Data Berhasil Diupdate!"
            ]);
        } else {
            DB::table('kelompok')->insert([
                'namakelompok' => $nama,
                'iddesa' => $iddesa,
                'alamatsekretariat' => $alamat,
                'tahunpembentukan' => $thn,
                'sektor' => 'peternakan',
                'status' => '1'
            ]);

            \Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil menambah kelompok : $request->nama"
            ]);
        }

        return redirect('/kelompokpeternak/create');
    }

    public function cekkelompokpeternak($id)
    {
        $x = DB::table('kelompok')
            ->where('idkelompok', $id)
            ->get();
        return response()->json($x);
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
        DB::table('kelompok')->where('idkelompok', '=', $id)->delete();
    }
}
