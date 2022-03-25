<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rmModel;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout.pages.rekamMedis.index',[
            'data' => rmModel::all(),
            'cek' => false,
        ]);
    }
}
