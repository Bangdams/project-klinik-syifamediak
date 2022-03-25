<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rmModel;
use App\Models\resepModel;
use App\Models\obatModel;
use App\Models\pemeriksaanModel;

class ResepObatController extends Controller
{
    public function index()
    {
        return view('layout.pages.pemberianObat.dataObat',[
            'obat' => resepModel::where('status', 'belum bayar')->get(),
            'cek' => false,
        ]);
    }

    //Route Detail Resep
    public function edit($data)
    {
        $resep = pemeriksaanModel::where('id_pemeriksaan', $data)->first();
        
        $data = resepModel::where('id_pemeriksaan', $data)->get();
        $no_pemeriksaan = $resep->no_pemeriksaan;
        /*dd($data);
        $datas = count($data);
            for ($i=0; $i <= $datas; $i++) { 
                $total = $data;
            }
        dd($total);
        */
        return view('layout.pages.pemberianObat.detailResep',[
            'no_pemeriksaan' => $no_pemeriksaan,
            'data' => $data,
            'cek' => false,
            'total' => $data->sum('sub_total'),
        ]);
    }



    public function update(Request $request)
    {
        resepModel::where('id_pemeriksaan', $request->id_pemeriksaan)->update(['status' => 'sudah bayar']);
        return redirect('/dashboard')->with('toast_success','Data Berhasil Diedit!!');
    }
}
