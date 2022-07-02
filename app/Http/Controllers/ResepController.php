<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\obatModel;
use App\Models\resepModel;
use App\Models\pendaftaranModel;
use App\Models\detailResep;
use App\Models\rmModel;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailResep = session()->get('id_pemeriksaan');
        return view('layout.pages.resep.resep',[
            'obat' => obatModel::all(),
            'resep' => resepModel::where('id_pemeriksaan', $detailResep)->get(),
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$detailResep = detailResep::where('no_pemeriksaan', $no_pemeriksaan)->get();

        /*$data = [
            'no_pemeriksaan' => $detailResep->no_pemeriksaan,
            'id' => $detailResep->id_obat,
            'satuan' => $detailResep->satuan,
            'jumlah' => $detailResep->jumlah,
            'status' => 'belum bayar'
        ];
        
        dd($detailResep);
        resepModel::create($detailResep);
        */

        $id_user = $request->id_pasien;
        $id_pemeriksaan = session()->get('id_pemeriksaan');

        pendaftaranModel::where('id_pasien', $id_user)->update(['status' => 'sudah']);
        
        $rm = [
            'id_pasien' => $id_user,
            'id_pemeriksaan' => $id_pemeriksaan,
        ];
        rmModel::create($rm);

        $request->session()->forget('no_pemeriksaan');
        $request->session()->forget('nama_pasien');
        $request->session()->forget('id_pemeriksaan');
        $request->session()->forget('harga');

        return redirect('/pemeriksaan')->with('toast_success','Data Berhasil Tersimpan!!');
        
    }

    public function simpan(Request $request)
    {
        $id_pemeriksaan = session()->get('id_pemeriksaan');
        $resep = resepModel::all('id_pemeriksaan');
        $obat = obatModel::where('id', $request->id_obat)->first();
        $jml = $request->jumlah*$obat->harga;
        
        $total = $jml + session()->get('harga');

        $data = [
            'id_pemeriksaan' => $id_pemeriksaan,
            'id' => $request->id_obat,
            'satuan' => $request->satuan,
            'jumlah' => $request->jumlah,
            'sub_total' => $total,
        ];
        
        if (!is_array($resep)) {
            $data['status'] = 'belum bayar';
        }
        
        foreach ($resep as $r) {
            if ($r->id_pemeriksaan == $id_pemeriksaan) {
                $data['status'] = null;
            }else{
                $data['status'] = 'belum bayar';
            }
        }
      
        resepModel::create($data);

        return redirect('/resep')->with('toast_success','Data Berhasil Tersimpan!!');
    }

    public function hapus($data)
    {  
        $hapus = resepModel::where('no_resep', $data)->first()->delete();
        return redirect('/resep');
    }

}
