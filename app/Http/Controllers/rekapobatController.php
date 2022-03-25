<?php

namespace App\Http\Controllers;

use App\Models\resepModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class rekapobatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout/pages/obat/rekapObat',[
            'tgl_now' => Carbon::now()->format('Y-m-d'),
            'obat' => resepModel::simplePaginate(10),
            'cek' => false,
        ]);
    }

    public function cetak()
    {
        return view('layout/pages/cetak/cetakObatHarian',[
            'tgl_now' => Carbon::now()->format('Y-m-d'),
            'data' => resepModel::simplePaginate(10),
            'cek' => false,
        ]);
    }
}
