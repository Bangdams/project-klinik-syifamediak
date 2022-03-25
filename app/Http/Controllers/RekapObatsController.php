<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\resepModel;
use App\Models\pemeriksaanModel;

class RekapObatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $cek = pemeriksaanModel::get();
        
        if (in_array($request->dari_tgl, $request->all())) {

            $dari_tgl = $request->dari_tgl;
            $ke_tgl = $request->ke_tgl;
            foreach ($cek as $c) {
                $isi = $c;
                $cari = $isi->whereBetween('tanggal',[$dari_tgl,$ke_tgl])->get('id_pemeriksaan');
            }

            $o = array();
            foreach ($cari as $k => $value) {
                array_push($o, $value->id_pemeriksaan);
            }

            $p = $cari->count();
            if ($p == 1) {
                $obat = resepModel::where('id_pemeriksaan',$o)->get();
                session()->put('dari_tgl', $request->dari_tgl);
                session()->put('ke_tgl', $request->ke_tgl);
            }else{
                $obat = resepModel::find($o);
                session()->put('dari_tgl', $request->dari_tgl);
                session()->put('ke_tgl', $request->ke_tgl);
            }

        }else{

            $obat = resepModel::all();
        }

         return view('layout.pages.rekap.rekapobat',[
            'obat' => $obat,
            'cek' => false,
        ]);
    }

    public function cetak()
    {

        return view('layout.pages.cetak.cetakObat',[
            'data' => resepModel::all()
        ]);
    }
}
