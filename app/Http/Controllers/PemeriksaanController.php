<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\pendaftaranModel;
use App\Models\pemeriksaanModel;
use App\Models\pasienModel;
use App\Models\diagnosaModel;
use App\Models\rmModel;


class PemeriksaanController extends Controller
{
    public function index()
    {
        if (Auth::user()->poli == 'umum') {
            $data = pendaftaranModel::where('status', 'belum')->where('poli', 'umum')->get();
        }elseif (Auth::user()->poli == 'bidan') {
           $data = pendaftaranModel::where('status', 'belum')->where('poli', 'bidan')->get();
        }else{
            $data =  pendaftaranModel::where('status', 'belum')->get();
        }

        return view('layout.pages.pemeriksaan.dataPemeriksaan',[
            'data' => $data,
            'cek' => false,
        ]);
    }

    //Form Pemeriksaan
    public function pemeriksaan(pasienModel $pasien)
    {   
        $now = Carbon::now();
        $no_rm = pemeriksaanModel::all('no_pemeriksaan');
        //$thnbln = $now->year . $now->month;

        $cek = pemeriksaanModel::count();
        $cek_idPasien = pemeriksaanModel::where('id_pasien', $pasien->id)->count();

        $ambil_noPemeriksaan = pemeriksaanModel::where('id_pasien', $pasien->id)->first();

        if ($cek == 0) {
            $urut = 100001;
            $nomer = 'RM-' . $urut;
        } else {
            if ($cek_idPasien == 0) {
                $ambil = pemeriksaanModel::all()->last();
                $urut = substr($ambil->no_pemeriksaan, -6) +1;
                $nomer = 'RM-' . $urut;
            }else{
               $nomer = $ambil_noPemeriksaan->no_pemeriksaan;
            }
        }

        return view('layout.pages.pemeriksaan.pemeriksaan',[
            'id_pasien' => $pasien,
            'cek' => false,
            'nomer' => $nomer,
            'diagnosa' => diagnosaModel::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = [
            'no_pemeriksaan' => $request->no_pemeriksaan,
            'id_pasien' => $request->id_pasien,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'suhu_badan' => $request->suhu_badan,
            'tekanan_darah' => $request->tekanan_darah,
            'keluhan' => $request->keluhan,
            'id_diagnosa' => $request->diagnosa,
            'harga' => $request->harga,
            'terapi' => $request->terapi,
            'id' => $request->id,
        ];
        pemeriksaanModel::create($data);

        $pendaftaran = pemeriksaanModel::orderBy('id_pemeriksaan','desc')->first();

        $request->session()->put('id_pemeriksaan',$pendaftaran->id_pemeriksaan);
        $request->session()->put('no_pemeriksaan',$request->no_pemeriksaan);
        $request->session()->put('nama_pasien',$request->nama_pasien);
        $request->session()->put('id_pasien',$request->id_pasien);
        $request->session()->put('harga',$request->harga);
        
        return redirect('/resep')->with('toast_success','Pasien Selesai Diperiksa');;
    }
}
