<?php

namespace App\Http\Controllers\pertanian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class datatanamanController extends Controller
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

    public function tabeltanaman()
    {
        return DataTables::of(DB::table('jenistanaman')
            ->join('kategoritanaman', 'jenistanaman.idkategori', '=', 'kategoritanaman.idkategori')
            ->select('jenistanaman.*', 'kategoritanaman.kategoritanaman as namakategori')
            ->get())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->idjenis . '" class="hapus-data"><i class="fas fa-trash"></i></a>';
                $edit = '<a href="#" data-id="' . $data->idjenis . '" class="edit-modal"><i class="fas fa-edit"></i></a>';
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
        $kategori = DB::table('kategoritanaman')->get();
        return view('pertanian.datatanaman', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->get('id');
        $nama = $request->get('nama');
        $idkategori = $request->get('idkategori');
        $pengecekan = DB::table('jenistanaman')->select('*')
            ->where('idjenis', '=', $id)
            ->where('jenistanaman', '=', $nama);

        if ($pengecekan->exists()) {
            DB::table('jenistanaman')
                ->where('idjenis',$id)
                ->update([
                'jenistanaman' => $nama,
                'idkategori' => $idkategori
            ]);

            \Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Data Berhasil Diupdate!"
            ]);
        } else {
            DB::table('jenistanaman')->insert([
                    'jenistanaman'      => $nama,
                    'idkategori'     => $idkategori
                ]);
        
                \Session::flash("flash_notification", [
                    "level" => "success",
                    "message" => "Berhasil menambah data : $request->nama"
                ]);
        }
               return redirect('/datatanaman/create');
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
        $x = DB::table('jenistanaman')
        ->where('idjenis', '=', $id)
        ->get();
    return response()->json($x);
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
        DB::table('jenistanaman')->where('idjenis', '=', $id)->delete();
    }
}
