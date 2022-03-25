<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\pasienModel;
use App\Models\pendaftaranModel;
use App\Models\obatModel;
use App\Models\resepModel;
use App\Models\pemeriksaanModel;

use Illuminate\Http\Request;

class pendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$pasien = pasienModel::select(['pasien.*', 'pendaftaran.status as status'])->join('pendaftaran', 'pasien.id', '=', 'pendaftaran.id_pasien');
        
        $now = Carbon::now();
        $tglPasien = pasienModel::all('tgl_lahir');

        /*if (!is_array($tglPasien)) {
            dd('cek');
            $umur = [];
        }else{
            dd('tes');
        }
         
        foreach ($tglPasien as $t) {
            $lahir = Carbon::parse($t->tgl_lahir);
        }
        $umur = $lahir->diffInYears($now);
       dd($umur);
       */
    
        return view('layout/pages/pendaftaran/pendaftaran',[
            'cek' => false,
            'data' => pasienModel::all(),
            'ktp' =>pasienModel::all('no_ktp','nama_pasien'),
        ]);
    }

    //Pilih Poli
    public function poli($data)
    {
        return view('layout.pages.pendaftaran.pilihPoli',[
            'data' => $data,
            'cek' => false,
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
        $validateData = $request->validate([
            'nama_pasien' => 'max:20',
            'alamat' => 'max:255',
            'tgl_lahir' => 'required|max:255',
            'no_telepon' => 'max:255',
            'jk' => 'required',
            'no_ktp' => 'required|unique:pasien',
            'no_bpjs' => 'unique:pasien',
        ],[
            'no_ktp.unique' => 'Nomer Ktp Sudah Terdaftar',
            'no_bpjs.unique' => 'Nomer Bpjs Sudah Terdaftar',
            'jk.required' => 'Jenis Kelamin Tidak Boleh Kosong'
        ]);
        
        pasienModel::create($validateData);
        $pendaftaran = pasienModel::orderBy('id','desc')->first();
        $cek = [
            'id_pasien' => $pendaftaran->id,
            'status' => 'sudah',
        ];

        pendaftaranModel::create($cek);
        return redirect('/pendaftaran')->with('toast_success','Data Berhasil Tersimpan!!');;
    }

     public function cari(Request $request)
    {
        $data = pasienModel::where('nama_pasien',$request->cari)
        ->orWhere('no_ktp', $request->cari)
        ->get();
       
        return view('layout/pages/pendaftaran/pendaftaran',[
            'data' => $data,
            'ktp' =>pasienModel::all('no_ktp','nama_pasien'),
            'cek' => false,
        ]);
    }

    public function daftar(Request $request, pasienModel $data)
    {
        $daftar = [
            'id_pasien' => $data->id,
            'poli' => $request->poli,
            'status' => 'belum',
        ];

        //pendaftaranModel::create($daftar);           
        if ($data->id != $request->id_pasien) {
            pendaftaranModel::create($daftar);
        }else{
            pendaftaranModel::where('id_pasien',$data->id)->update(['status' => 'belum', 'poli' => $request->poli]);
        }
        return redirect('dataPasien')->with('toast_success','Pasien Berhasil Daftar!!');;
    }

    public function riwayatPemeriksaan()
    {
        return view('layout/pages/pemeriksaan/riwayatPemeriksaan', [
            'data' => pemeriksaanModel::all(),
            'tgl_now' => Carbon::now()->format('Y-m-d'),
            'cek' => false
        ]);
    }

    public function show(pendaftaran $data)
    {
        dd($data);
    }
}
