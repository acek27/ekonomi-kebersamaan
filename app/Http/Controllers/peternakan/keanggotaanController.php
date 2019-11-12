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
        return DataTables::of(DB::table('keanggotaanpokter')
            ->join('biodatauser', 'keanggotaanpokter.nik', '=', 'biodatauser.nik')
            ->join('desa', 'desa.iddesa', '=', 'keanggotaanpokter.iddesa')
            ->join('jenisternak', 'jenisternak.idjenis', '=', 'keanggotaanpokter.idjenis')
            ->join('kelompok', 'kelompok.idkelompok', '=', 'keanggotaanpokter.idkelompok')
            ->where('sektor','=','peternakan')
            ->select('keanggotaanpokter.*','biodatauser.nama as nama','biodatauser.nik as nik','biodatauser.alamat as alamat', 'jenisternak.jenisternak as jenisternak', 'desa.namadesa as namadesa', 'kelompok.namakelompok as namakelompok')
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
        $kelompok = DB::table('kelompok')
        ->where('sektor','=','peternakan')
        ->get();
        $jenisternak = DB::table('jenisternak')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $date = date('d-m-Y');
        return view('peternakan.keanggotaanpeternak',compact('date','kelompok','kecamatan','jenisternak'));
    }


    public function ceknik ($id){
        $pengecekan = DB::table('biodatauser')->where('nik','=',$id);
        if ($pengecekan->exists()){
            $x = DB::table('biodatauser')->where('nik',$id)->get();
            return response()->json($x);
        } else {
            $value = array();
            $x = DB::table('biodatauser')->where('nik',$value)->get();
        return response()->json($x);
        }
        
    }

    public function cekkeanggotaanpeternak($id)
    {
        $x = DB::table('keanggotaanpokter')
            ->join('biodatauser','biodatauser.nik','=','keanggotaanpokter.nik')
            ->join('jenisternak','jenisternak.idjenis','=','keanggotaanpokter.idjenis')
            ->join('kelompok','kelompok.idkelompok','=','keanggotaanpokter.idkelompok')
            ->where('idkeanggotaan', $id)
            ->get();
        return response()->json($x);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $nik = $request->get('nik');
        $idjenis= $request->get('idjenis');
        $jumlah= $request->get('jumlah');
        $iddesa = $request->get('iddesa');
        $idkelompok = $request->get('idkelompok');
        $jabatan = $request->get('jabatan');
        $tgl = date('Y-m-d');
        DB::table('keanggotaanpokter')->insert([
            'nik'      => $nik,
            'idjenis'     => $idjenis,
            'jumlah'     => $jumlah,
            'iddesa'        => $iddesa,
            'idkelompok'    =>$idkelompok,
            'jabatan'       =>$jabatan,
            'tglbergabung'  =>$tgl,
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
        DB::table('keanggotaanpokter')->where('idkeanggotaan', '=', $id)->delete();
    }
}
