<?php

namespace App\Http\Controllers\peternakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class dataTernakController extends Controller
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

    public function tabelternak()
    {
        return DataTables::of(DB::table('jenisternak')
            ->join('kategoriternak', 'jenisternak.idkategori', '=', 'kategoriternak.idkategori')
            ->select('jenisternak.*', 'kategoriternak.kategoriternak as kategori')
            ->get())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->idjenis . '" class="hapus-data"><i class="fas fa-trash"></i></a>';
                $edit = '<a href="#" data-id="' . $data->idjenis . '" class="edit-modal"><i class="fas fa-edit"></i></a>';
                return $edit . '&nbsp' . '&nbsp' . $del;
            })
            ->make(true);
    }


    public function cekternak($id)
    {
        $x = DB::table('jenisternak')
            ->where('idjenis', $id)
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
        $kategori = DB::table('kategoriternak')->get();

        return view('peternakan.dataternak', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->get('id');
        $nama = $request->get('nama');
        $idkategori = $request->get('idkategori');
        $pengecekan = DB::table('jenisternak')->select('*')
            ->where('idjenis', '=', $id)
            ->where('jenisternak', '=', $nama);

        if ($pengecekan->exists()) {
            DB::table('jenisternak')
                ->where('idjenis',$id)
                ->update([
                'jenisternak' => $nama,
                'idkategori' => $idkategori
            ]);

            \Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Data Berhasil Diupdate!"
            ]);
        } else {
            DB::table('jenisternak')->insert([
                'jenisternak' => $nama,
                'idkategori' => $idkategori
            ]);

            \Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil menambah data ternak : $request->nama"
            ]);
        }

        return redirect('/dataternak/create');
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
        DB::table('jenisternak')->where('idjenis', '=', $id)->delete();
    }
}
