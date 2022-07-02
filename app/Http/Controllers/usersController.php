<?php

namespace App\Http\Controllers;

use App\Models\usersModel;
use App\Models\pasienModel;
use App\Models\obatModel;
use App\Models\pendaftaranModel;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class usersController extends Controller
{
    public function index()
    {

        $user = [
            'apoteker',
            'dokter',
        ];

        $data = usersModel::whereIn('level', $user)->get();

        return view('layout.pages.dataUsers',[
            'data' => $data,
            'cek' => false,
        ]);
    }

    public function tambah()
    {
        return view('layout.pages.user.addUser',[
            'cek' => false,
        ]);
    }

    //Menyimpan Dari Tambah Data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'min:5',
            'email' => 'required|email|max:255|unique:user|string',
            'password' => 'required|string|min:5|max:15',
            'level' => 'required',
        ],[
            'name.min' => 'Nama Harus Lebih Dari 5 Huruf',
            'email.unique' => 'Email Sudah Terdaftar',
            'password.min' => 'Password Harus Lebih Dari 5 Huruf',
            'password.required' => 'Password Tidak Boleh Kosong',
            'level.required' => 'Pilih Hak Akses',
        ]);


        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'level' => $request->level,
            'poli' => $request->poli,    
        ];

        $data['password'] = bcrypt($data['password']);

        usersModel::create($data);

        return redirect('/dataUsers')->with('toast_success','Data Berhasil Tersimpan!!');
    }

    //Menampilkan Edit Data
    public function edit($dataUsers)
    {  
        $user = usersModel::find($dataUsers);
       
        return view('layout/pages/user/editUser',[
            'dataUsers' => $user,
            'cek' => false,
        ]);
    }

    //Menyimpan Hasil Edit
    public function update(Request $request, $dataUsers)
    {
        $user = usersModel::find($dataUsers);
        
        $data = $request->validate([
            'name' => 'min:5',
            'level' => 'required',
            'email' => 'required|unique:user,email,'.$user->id

        ],[
            'name.min' => 'Nama Harus Lebih Dari 5 Huruf',
            'email.unique' => 'Email Sudah Terdaftar',
            'level.required' => 'Pilih Hak Akses',
        ]);

        //Query Update Ke Tabel pasien
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        if ($request->password == true) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect('/dataUsers')->with('toast_success','Data Berhasil Diedit!!');
    }

    //Menghapus Data
    public function destroy($dataUsers)
    {
        usersModel::destroy($dataUsers);
        return redirect('/dataUsers')->with('toast_error','Data Berhasil Hapus!!');
    }

    //Custom Metode
    public function dashboard()
    {
        /*if (Auth::user()->level == !null) {
            return view('layout.pages.dashboard',[
                'jml_dokter' => usersModel::where('level', 'dokter')->count(),
                'jml_pasien' => pasienModel::all()->count(),
                'jml_obat' => obatModel::all()->count(),
                'cek' => false,
            ]);
        }*/
        
        return view('layout.pages.dashboard',[
            'jml_dokter' => usersModel::where('level', 'dokter')->count(),
            'jml_pasien' => pasienModel::all()->count(),
            'jml_obat' => obatModel::all()->count(),
            'daftar_pasien' => pendaftaranModel::where('status', 'belum')->get(),
            'cek' => false,
        ]);
    }

    public function cari(Request $request)
    {
        $data = usersModel::where('name',$request->cari)
        ->orWhere('email', $request->cari)
        ->simplePaginate(5);
       
        return view('layout.pages.dataUsers',[
            'data' => $data,
            'cek' => false,
        ]);
    }

}
