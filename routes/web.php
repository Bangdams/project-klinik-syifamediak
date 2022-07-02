<?php

use App\Http\Controllers\usersController;
use App\Http\Controllers\pendaftaranController;
use App\Http\Controllers\datapasienController;
use App\Http\Controllers\obatController;
use App\Http\Controllers\rekapobatController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\ResepObatController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\RekapObatsController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\CetakController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth', 'logincek:admin,apoteker,dokter']], function() {
    Route::get('dashboard', [usersController::class, 'dashboard']);
});

//Admin
Route::group(['middleware' => ['auth', 'logincek:admin']], function() {
    
    //halaman Dashboard
    Route::resources([
        'dataUsers' => usersController::class,
        'pendaftaran' => pendaftaranController::class,
        'dataPasien' => datapasienController::class,
        'obat' => obatController::class,
        'rekapObat' => rekapobatController::class,
        'rekapObats' => RekapObatsController::class,
        'resepObat' => ResepObatController::class,
        'rekamMedis' => RekamMedisController::class,
        'diagnosa' => DiagnosaController::class,
    ]);
    
    //Route Cetak
    Route::get('cetakObatHarian', [rekapobatController::class, 'cetak']);
    Route::get('cetakObat', [RekapObatsController::class, 'cetak']);
    Route::get('cetak-riwayat-pemeriksaan', [CetakController::class, 'cetak_riwayat_pemeriksaan']);
    Route::get('cetak_riwayat_pemeriksaan_tanggal', [CetakController::class, 'cetak_riwayat_pemeriksaan_tanggal']);

    //Route Riwayat Pemeriksaan
    Route::get('riwayatPemeriksaan', [pendaftaranController::class, 'riwayatPemeriksaan']);
    Route::get('dataPemeriksaan', [pendaftaranController::class, 'dataPemeriksaan']);
    Route::get('tanggalPemeriksaan', [pendaftaranController::class, 'tanggalPemeriksaan']);
    
    //Route Detail Resep
    //Route::get('/detailResep/{no_pemeriksaan}', [RekamMedisController::class, 'detailResep']);

    //Route Daftar Pasien
    //Route::post('/daftarPasien/{data}', [pendaftaranController::class, 'daftar']);
    Route::get('/daftarPasien/Poli/{data}', [pendaftaranController::class, 'poli']);
    Route::post('/daftarPasien/Poli/save/{data}', [pendaftaranController::class, 'daftar']);



    //Tampilan Add User
    Route::get('/addUser', [usersController::class, 'tambah']);


    //Tampilan Add Obat
    Route::get('/addObat', [obatController::class, 'tambah']);    
    Route::get('obat/tambahStok/{nama_obat}', [obatController::class, 'tambahStok']);
    Route::post('obat/tambahStok/save/{nama_obat}', [obatController::class, 'saveStok']);


    //Route Fitur Cari
    Route::post('/cari/user', [usersController::class, 'cari']);
    Route::post('/cari/pasien', [datapasienController::class, 'cari']);
    Route::post('/cari/obat', [obatController::class, 'cari']);
    Route::get('/cari/pasien/ktp', [pendaftaranController::class, 'cari']);
    //Route::get('/cari/rekapObat', [RekapObatsController::class, 'cari']);
});

//Dokter
Route::group(['middleware' => ['auth', 'logincek:dokter']], function() {
    
    //halaman Dashboard
    Route::resources([
        'pemeriksaan' => PemeriksaanController::class,
        'resep' => ResepController::class,
        'rekamMedis' => RekamMedisController::class,
    ]);

    Route::get('detail-rm-pasien/{data}', [RekamMedisController::class, 'detail']);
    Route::get('delete-resep/{data}', [ResepController::class, 'hapus']);

    //detail Obat
    Route::post('detailobat/tambah', [ResepController::class, 'simpan']);
    Route::post('cari', [RekamMedisController::class, 'cari']);
    /*
    Route::post('/cari/pasien', [datapasienController::class, 'cari']);
    Route::post('/cari/obat', [obatController::class, 'cari']);
    Route::get('/cari/pasien/ktp', [pendaftaranController::class, 'cari']);
    */

    //tampilan form pemeriksaan
    Route::get('/pemeriksaan/pasien/{pasien:nama_pasien}', [PemeriksaanController::class, 'pemeriksaan']);

    //cari
    Route::get('/cari', [RekamMedisController::class, 'cari']);
});

//Apoteker
Route::group(['middleware' => ['auth', 'logincek:admin,apoteker']], function() {

    //Route Obat
    Route::resources([
        'obat' => obatController::class,
        'rekapObat' => rekapobatController::class,
        'resepObat' => ResepObatController::class,
        'rekapObats' => RekapObatsController::class,
    ]);

    Route::get('cetakObat', [RekapObatsController::class, 'cetak']);

    //Tampilan Add Obat
    Route::get('/addObat', [obatController::class, 'tambah']);
    Route::get('obat/tambahStok/{nama_obat}', [obatController::class, 'tambahStok']);
    Route::post('obat/tambahStok/save/{nama_obat}', [obatController::class, 'saveStok']);

    //Route Fitur Cari
    Route::post('/cari/obat', [obatController::class, 'cari']);
});