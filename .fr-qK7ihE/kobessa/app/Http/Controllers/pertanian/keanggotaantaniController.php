<?php

namespace App\Http\Controllers\pertanian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class keanggotaantaniController extends Controller
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

    public function tabelpoktan()
    {
        return DataTables::of(DB::table('keanggotaanpoktan')
            ->join('biodatauser', 'keanggotaanpoktan.nik', '=', 'biodatauser.nik')
            ->join('desa', 'desa.iddesa', '=', 'keanggotaanpoktan.iddesa')
            ->join('jenislahan', 'jenislahan.idjenis', '=', 'keanggotaanpoktan.idjenis')
            ->join('kelompok', 'kelompok.idkelompok', '=', 'keanggotaanpoktan.idkelompok')
            ->where('sektor','=','pertanian')
            ->select('keanggotaanpoktan.*','biodatauser.nama as nama','biodatauser.nik as nik','biodatauser.alamat as alamat', 'jenislahan.jenislahan as jenislahan', 'desa.namadesa as namadesa', 'kelompok.namakelompok as namakelompok')
            ->get())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->idkeanggotaan . '" class="hapus-data"><i class="fas fa-trash"></i></a>';
                $edit = '<a href="#" data-id="' . $data->idkeanggotaan . '" class="edit-modal"><i class="fas fa-edit"></i></a>';
                return $edit . '&nbsp' . '&nbsp' . $del;
            })
            ->make(true);
    }



    public function cekniktani ($id){
        $pengecekan = DB::table('petani')->where('nik','=',$id);
        if ($pengecekan->exists()){
            $x = DB::table('petani')->where('nik',$id)->get();
            return response()->json($x);
        } else {
            $value = array();
            $x = DB::table('petani')->where('nik',$value)->get();
        return response()->json($x);
        }
        
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $kecamatan = DB::table('kecamatan')->get();
        $jenislahan = DB::table('jenislahan')->get();
        $kelompok = DB::table('kelompok')
        ->where('sektor','=','pertanian')
        ->get();
        $date = date('d-m-Y');
        return view('pertanian.keanggotaanpetani',compact('date','kelompok','kecamatan','jenislahan'));
    }

    public function cekkeanggotaanpetani($id)
    {
        $x = DB::table('keanggotaanpoktan')
            ->join('biodatauser','biodatauser.nik','=','keanggotaanpoktan.nik')
            ->join('jenislahan','jenislahan.idjenis','=','keanggotaanpoktan.idjenis')
            ->join('kelompok','kelompok.idkelompok','=','keanggotaanpoktan.idkelompok')
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
        $idjenis = $request->get('idjenis');
        $luas = $request->get('luas');
        $iddesa = $request->get('iddesa');
        $idkelompok = $request->get('idkelompok');
        $jabatan = $request->get('jabatan');
        $tgl = date('Y-m-d');
        DB::table('keanggotaanpoktan')->insert([
            'nik'      => $nik,
            'idjenis'      => $idjenis,
            'luaslahan'     => $luas,
            'iddesa'        => $iddesa,
            'idkelompok'    =>$idkelompok,
            'jabatan'       =>$jabatan,
            'tglbergabung'  =>$tgl,
        ]);

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah data!"
        ]);
        return redirect('/keanggotaanpetani/create');
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
        DB::table('keanggotaanpoktan')->where('idkeanggotaan', '=', $id)->delete();
    }
}
