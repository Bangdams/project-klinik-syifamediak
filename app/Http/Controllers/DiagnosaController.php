<?php

namespace App\Http\Controllers;

use App\Models\diagnosaModel;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout.pages.diagnosa.diagnosa',[
            'diagnosa' => diagnosaModel::simplePaginate(10),
            'cek' => false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layout.pages.diagnosa.tambah',[
            'cek'=> false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'nama_diagnosa' => $request->nama_diagnosa,
        ];

        diagnosaModel::create($data);
        return redirect('/diagnosa')->with('toast_success', 'Berhasil Tersimpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($data)
    {
        $diagnosa = diagnosaModel::find($data)->first();
    
        return view('layout.pages.diagnosa.editDiagnosa',[
            'data' => $diagnosa,
            'cek' => false,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $data)
    {
        $diagnosa = [
           'nama_diagnosa' => $request->nama_diagnnosa,
        ];
       diagnosaModel::where('id',$data)->update($diagnosa);
       return redirect('/diagnosa')->with('toast_success', 'Berhasil DiUbah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        diagnosaModel::destroy($data);
        return redirect('/diagnosa')->with('toast_error','Data Berhasil Dihapus!!');
    }
}
