<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\pemeriksaanModel;
use Carbon\Carbon;

class CetakController extends Controller
{
    public function cetak_riwayat_pemeriksaan()
    {
        return view('layout/pages/cetak/riwayat_pemeriksaan',[
            'data' => pemeriksaanModel::all(),
            'tgl_now' => Carbon::now()->format('Y-m-d'),
            'cek' => false
        ]);
    }

    public function cetak_riwayat_pemeriksaan_tanggal()
    {
        $cek = pemeriksaanModel::get();
        
        if (session('dari_tgl') == true) {
            $dari_tgl = session('dari_tgl');
            $ke_tgl = session('ke_tgl');
            foreach ($cek as $c) {
                $isi = $c;
                $cari = $isi->whereBetween('tanggal',[$dari_tgl,$ke_tgl])->get();
            }
            $data = $cari;
        }else{

            $data = pemeriksaanModel::all();
            session()->forget('dari_tgl');
            session()->forget('ke_tgl');
        }

        return view('layout/pages/cetak/cetak_riwayats',[
            'data' => $data
        ]);
    }
}
