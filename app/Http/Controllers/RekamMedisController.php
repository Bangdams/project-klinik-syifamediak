<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rmModel;
use App\Models\pemeriksaanModel;
use App\Models\pasienModel;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $tes = pemeriksaanModel::all('id_pasien');
        $array = array();
        foreach ($tes as $c) {
            $p = $c;
            $r = array_push($array,$p->id_pasien);
        }
        $data = rmModel::where('id_pasien', $array)->get();
        $cek_jumlah = $data->count();

        if ($cek_jumlah == 0) {
            echo "cek";
        }elseif ($cek_jumlah > 1) {
            $db = rmModel::where('id_pasien',$array)->first();
        }
        */

        return view('layout.pages.rekamMedis.index',[
            'data' => pasienModel::all(),
            'cek' => false,
        ]);
    }

    public function cari(Request $request)
    {
        $data = pemeriksaanModel::where('nama_pasien',$request->cari)
        ->simplePaginate(5);
       
        return view('layout.pages.dataUsers',[
            'data' => $data,
            'cek' => false,
        ]);
    }

    public function detail($data)
    {
        $id = pasienModel::where('nama_pasien',$data)->first();
        $pemeriksaan = pemeriksaanModel::where('id_pasien', $id->id)->get();
        return view('layout/pages/rekamMedis/riwayat_rekam_medis',[
            'data' => $pemeriksaan,
            'cek' => false
        ]);
    }
}
