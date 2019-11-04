<?php

namespace App\Http\Controllers\peternakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class peternakController extends Controller
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


    public function tabelpeternak()
    {
        return DataTables::of(DB::table('peternak')
            ->join('desa', 'peternak.iddesa', '=', 'desa.iddesa')
            ->join('kecamatan', 'kecamatan.idkecamatan', '=', 'desa.idkecamatan')
            ->select('peternak.*', 'kecamatan.kecamatan as namakecamatan', 'desa.namadesa as namadesa')
            ->get())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->idpeternak . '" class="hapus-data"><i class="fas fa-trash"></i></a>';
                $edit = '<a href="#" data-id="' . $data->idpeternak . '" class="edit-modal"><i class="fas fa-edit"></i></a>';
                return $edit . '&nbsp' . '&nbsp' . $del;
            })
            ->make(true);
    }

    public function cekpeternak($id)
    {
        $x = DB::table('peternak')
            ->where('idpeternak', $id)
            ->get();
        return response()->json($x);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = DB::table('kecamatan')->get();
        return view('peternakan.datapeternak', compact('kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'telp' => 'numeric|required'
        ]);
        $nama = $request->get('nama');
        $alamat = $request->get('alamat');
        $jk = $request->get('jk');
        $iddesa = $request->get('iddesa');
        $nik = $request->get('nik');
        $telp = $request->get('telp');
        $id = $request->get('id');

        $pengecekan = DB::table('peternak')->select('*')
            ->where('idpeternak', '=', $id)
            ->where('nama', '=', $nama);

        if ($pengecekan->exists()) {
            DB::table('peternak')
                ->where('idpeternak', '=', $id)
                ->update([
                    'nama' => $nama,
                    'jeniskelamin' => $jk,
                    'iddesa' => $iddesa,
                    'alamat' => $alamat,
                    'telp' => $telp
//            'idkecamatan'     => $idkecamatan
                ]);

            \Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Peternak $request->nama Berhasil diupdate!"
            ]);
        } else {
            $request->validate([
                'nik' => 'numeric|required'
            ]);
            DB::table('peternak')->insert([
                'nik' => $nik,
                'nama' => $nama,
                'jeniskelamin' => $jk,
                'iddesa' => $iddesa,
                'alamat' => $alamat,
                'telp' => $telp
//            'idkecamatan'     => $idkecamatan
            ]);

            \Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil menambah peternak : $request->nama"
            ]);
        }

        return redirect('/datapeternak/create');
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
        DB::table('peternak')->where('idpeternak', '=', $id)->delete();
    }
}
