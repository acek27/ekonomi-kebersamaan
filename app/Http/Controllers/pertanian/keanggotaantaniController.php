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
            ->join('petani', 'keanggotaanpoktan.idpetani', '=', 'petani.idpetani')
            ->join('desa', 'desa.iddesa', '=', 'keanggotaanpoktan.iddesa')
            ->join('kelompokpetani', 'kelompokpetani.idkelompok', '=', 'keanggotaanpoktan.idkelompok')
            ->select('keanggotaanpoktan.*','petani.nama as namapetani','petani.nik as nik', 'desa.namadesa as namadesa', 'kelompokpetani.namakelompok as namakelompok')
            ->get())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="" class="hapus-data"><i class="material-icons">delete</i></a>';
                $edit = '<a href="#"><i class="material-icons">edit</i></a>';
                return $edit . '&nbsp' . $del;
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
        
        $desa = DB::table('desa')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $kelompok = DB::table('kelompokpetani')->get();
        $date = date('d-m-Y');
        return view('pertanian.keanggotaanpetani',compact('date','kelompok','desa','kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $idpetani = $request->get('idpetani');
        $luas = $request->get('lahan');
        $iddesa = $request->get('iddesa');
        $idkelompok = $request->get('idkelompok');
        $jabatan = $request->get('jabatan');
        $tgl = date('Y-m-d');
        DB::table('keanggotaanpoktan')->insert([
            'idpetani'      => $idpetani,
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
        //
    }
}
