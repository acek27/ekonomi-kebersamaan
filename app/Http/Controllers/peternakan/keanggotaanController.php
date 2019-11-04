<?php

namespace App\Http\Controllers\peternakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class keanggotaanController extends Controller
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

    public function tabelpokter()
    {
        return DataTables::of(DB::table('keanggotaanpeternak')
            ->join('peternak', 'keanggotaanpeternak.idpeternak', '=', 'peternak.idpeternak')
            ->join('desa', 'desa.iddesa', '=', 'keanggotaanpeternak.iddesa')
            ->join('jenisternak', 'jenisternak.idjenis', '=', 'keanggotaanpeternak.idjenis')
            ->join('kelompokternak', 'kelompokternak.idkelompokternak', '=', 'keanggotaanpeternak.idkelompokternak')
            ->select('keanggotaanpeternak.*', 'peternak.nama as namapeternak', 'peternak.nik as nik', 'jenisternak.jenisternak as jenisternak', 'desa.namadesa as namadesa', 'kelompokternak.namakelompokternak as namakelompok')
            ->get())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->idkeanggotaan . '" class="hapus-data"><i class="fas fa-trash"></i></a>';
                $edit = '<a href="#" data-id="' . $data->idkeanggotaan . '" class="edit-modal"><i class="fas fa-edit"></i></a>';
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
        $kelompok = DB::table('kelompokternak')->get();
        $jenisternak = DB::table('jenisternak')->get();
        $desa = DB::table('desa')->get();
        $peternak = DB::table('peternak')->get();
        $date = date('d-m-Y');
        return view('peternakan.keanggotaanpeternak', compact('date', 'kelompok', 'peternak', 'desa', 'jenisternak'));

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
        $iddesa = $request->get('iddesa');
        $idkelompok = $request->get('idkelompok');
        $jabatan = $request->get('jabatan');
        $tgl = date('Y-m-d');
        DB::table('keanggotaanpeternak')->insert([
            'idpeternak' => $idpeternak,
            'idjenis' => $idjenis,
            'jumlah' => $jumlah,
            'iddesa' => $iddesa,
            'idkelompokternak' => $idkelompok,
            'jabatan' => $jabatan,
            'tglbergabung' => $tgl,
        ]);

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah data!"
        ]);

        return redirect('/keanggotaanpeternak/create');
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
        DB::table('keanggotaanpeternak')->where('idkeanggotaan', '=', $id)->delete();
    }
}
