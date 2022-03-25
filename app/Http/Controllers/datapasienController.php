<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\pasienModel;
use Illuminate\Http\Request;

class datapasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$tgl_lahir = pasienModel::all('tgl_lahir')->count();
        for ($i=0; $i < $tgl_lahir; $i++) { 
            $tgl = pasienModel::all('tgl_lahir');
            echo $tgl;
        }
        $cek = Carbon::parse($tgl_lahir)->age;
        */
        return view('layout/pages/pendaftaran/dataPasien',[
            'data' => pasienModel::all(),
            'ktp' =>pasienModel::all('no_ktp','nama_pasien'),
            'cek' => false,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pasienModel  $pasienModel
     * @return \Illuminate\Http\Response
     */
    public function edit($datapasien)
    {
        $pasien = pasienModel::find($datapasien);

        return view('layout/pages/pendaftaran/editPasien',[
            'dataPasien' => $pasien,
            'cek' => false,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pasienModel  $pasienModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dataPasien)
    {
        $db = pasienModel::find($dataPasien);
        
        //Query Update Ke Tabel pasien
        $db->nama_pasien = $request->nama_pasien;
        $db->alamat = $request->alamat;
        $db->tgl_lahir = $request->tgl_lahir;
        $db->no_telepon = $request->no_telepon;
        $db->jk = $request->jk;
        $db->no_ktp = $request->no_ktp;
        $db->no_bpjs = $request->no_bpjs;
        $db->save();

        return redirect('/dataPasien')->with('toast_success', 'Pasien Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pasienModel  $pasienModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($datapasien)
    {
        //Query Delete
        pasienModel::destroy($datapasien);

        return redirect('/dataPasien');
    }

    //Custom Metode

    public function cari(Request $request)
    {
        $data = pasienModel::where('nama_pasien',$request->cari)
        ->orWhere('no_ktp', $request->cari)
        ->get();
       
        return view('layout/pages/pendaftaran/dataPasien',[
            'data' => $data,
            'ktp' =>pasienModel::all('no_ktp','nama_pasien'),
            'cek' => false,
        ]);
    }

}
