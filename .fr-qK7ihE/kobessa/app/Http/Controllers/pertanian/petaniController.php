<?php

namespace App\Http\Controllers\pertanian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class petaniController extends Controller
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


    public function tabelpetani()
    {
        return DataTables::of(DB::table('biodatauser')
            ->join('desa', 'biodatauser.iddesa', '=', 'desa.iddesa')
            ->join('kecamatan', 'kecamatan.idkecamatan', '=', 'desa.idkecamatan')
            ->select('biodatauser.*', 'kecamatan.kecamatan as namakecamatan', 'desa.namadesa as namadesa')
            ->get())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->nik . '" class="hapus-data"><i class="fas fa-trash"></i></a>';
                $edit = '<a href="#" data-id="' . $data->nik . '" class="edit-modal"><i class="fas fa-edit"></i></a>';
                return $edit . '&nbsp' . '&nbsp' . $del;
            })
            ->make(true);
    }

    public function cekpetani($id)
    {
        $x = DB::table('biodatauser')
            -> join  ('desa','biodatauser.iddesa','=','desa.iddesa')
            -> join  ('kecamatan','desa.idkecamatan','=','kecamatan.idkecamatan')
            ->where('nik', $id)
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
        $desa = DB::table('desa')->get();
        $kecamatan = DB::table('kecamatan')->get();
        return view('pertanian.datapetani', compact('kecamatan', 'desa'));
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
        $tl = $request->get('tl');
        $tgl = $request->get('tgl');
        $alamat = $request->get('alamat');
        $jk = $request->get('jk');
        $iddesa = $request->get('iddesa');
        $nik = $request->get('nik');
        $telp = $request->get('telp');
     //   $id = $request->get('id');

        $pengecekan = DB::table('biodatauser')->select('*')
            ->where('nik', '=', $nik)
            ->where('nama', '=', $nama);

        if ($pengecekan->exists()) {
            // DB::table('biodatauser')
            //     ->where('nik','=',$nik)
            //     ->update([
            //     'nama' => $nama,
            //     'tempatlahir' => $tl,
            //     'tgllahir' => $tgl,
            //     'jeniskelamin' => $jk,
            //     'iddesa' => $iddesa,
            //     'alamat' => $alamat,
            //     'telp' => $telp

            // ]);
            return $request->get('nik');

            \Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Data petani $request->nama Berhasil diupdate!"
            ]);
        } else {
            $request->validate([
          //      'nik' => 'numeric|required'
            ]);
            DB::table('biodatauser')->insert([
                'nik' => $nik,
                'nama' => $nama,
                'tempatlahir' => $tl,
                'tgllahir' => $tgl,
                'jeniskelamin' => $jk,
                'iddesa' => $iddesa,
                'alamat' => $alamat,
                'telp' => $telp
            ]);

            \Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil menambah data petani : $request->nama"
            ]);
        }

        return redirect('/datapetani/create');
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
        DB::table('biodatauser')->where('nik', '=', $id)->delete();
    }
}
