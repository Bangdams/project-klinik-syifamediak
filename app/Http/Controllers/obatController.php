<?php

namespace App\Http\Controllers;

use App\Models\obatModel;
use Illuminate\Http\Request;

class obatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout/pages/obat/dataObat', [
            'obat' => obatModel::simplePaginate(10),
            'cek' => false,
        ]);
    }

    public function tambahStok($nama_obat)
    {  
        $obat = obatModel::where('nama_obat', $nama_obat)->first();
        
        return view('layout.pages.obat.tambahStokObat',[
            'obat' => $obat,
            'cek' => false,
        ]);
    }

    public function saveStok(Request $request, $nama_obat)
    {
        $stokObat = obatModel::where('nama_obat',$nama_obat)->first();

        $stokObat->stok = $request->stok + $stokObat->stok;

        $stokObat->save();

        return redirect('obat')->with('toast_success','Stok Obat Berhasil Ditambah');
    }

    // Menu Tambah Obat
    public function tambah()
    {
        return view('layout.pages.obat.addObat',[
            'cek' => false,
        ]);
    }

    //Simpan Tambah Obat
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|min:5|unique:obat',
            'harga' => 'required|max:255',
            'stok' => 'required|max:255',
            'jenis' => 'required|min:3'
        ],[
            'nama_obat.min' => 'Nama Obat Harus Lebih Dari 5 Huruf',
            'nama_obat.unique' => 'Obat Sudah Ada',
            'harga.required' => 'Harga Tidak Boleh Kosong',
            'stok.required' => 'Stok Tidak Boleh Kosong',
            'jenis.required' => 'Jenis Tidak Boleh Kosong'
        ]);

        $addObat = [
            'nama_obat' => $request->nama_obat,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'jenis' => $request->jenis,
        ];

        obatModel::create($addObat);

        return redirect('/obat')->with('toast_success','Data Berhasil Tersimpan!!');;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\obatModel  $obatModel
     * @return \Illuminate\Http\Response
     */
    public function edit(obatModel $obat)
    {
        if ($obat == !null) {
            return view('layout/pages/obat/editObat', [
                'obat' => $obat,
                'cek' => false,
            ]);
        }

        return redirect('/obat');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\obatModel  $obatModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, obatModel $obat)
    {
        $obat->nama_obat = $request->nama_obat;
        $obat->jenis = $request->jenis;
        $obat->harga = $request->harga;
        $obat->save();

        return redirect('/obat')->with('toast_success','Obat Berhasil Di Edit!!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\obatModel  $obatModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($obat)
    {
        obatModel::destroy($obat);
        return redirect('/obat')->with('toast_error','Obat Berhasil Dihapus!!');;
    }

    //Custom Metode

    public function cari(Request $request)
    {
        $data = obatModel::where('nama_obat',$request->cari)
        ->orWhere('jenis', $request->cari)
        ->get();
       
        return view('layout/pages/obat/dataObat',[
            'obat' => $data,
            'cek' => false,
        ]);
    }    
}
