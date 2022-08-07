<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiFormatterController as ApiFormatterController;
use App\Http\Resources\MahasiswaResource as MahasiswaResource;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class MahasiswaApiController extends ApiFormatterController
{
    public function index()
    {
        $Mahasiswa = Mahasiswa::get();
        return $this->berhasil(MahasiswaResource::collection($Mahasiswa), 'Selamat, semua Mahasiswa berhasil didapat.');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $cekinput = Validator::make($input, [
            'nama_mahasiswa' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
        ]);
        if ($cekinput->fails()) {
            return $this->gagal('Validasi eror.', $cekinput->errors());
        }

        $Mahasiswa = Mahasiswa::create($input);
        $user = new user; 
        $user->name = $request->nama_mahasiswa; 
        $user->email = $request->email; 
        $user->password = bcrypt('12345678'); 
        $user->role = 'mahasiswa'; 
        $user->save();
        return $this->berhasil(new MahasiswaResource($Mahasiswa), 'Selamat anda berhasil membuat Mahasiswa baru');
    }
    public function show($id)
    {
        $Mahasiswa = Mahasiswa::find($id);
        if (is_null($Mahasiswa)) {
            return $this->gagal('Mahasiswa tidak ditemukan');
        }
        return $this->berhasil(new MahasiswaResource($Mahasiswa), 'Selamat Mahasiswa berhasil didapat');
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $cekinput = Validator::make($input, [
            'nama_mahasiswa' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
        ]);
        if ($cekinput->fails()) {
            return $this->gagal('Validasi eror.', $cekinput->errors());
        }
        $Mahasiswa = Mahasiswa::findorfail($id);
        $user = user::where('email', $Mahasiswa->email)->first(); 
        $user->email = $request->email;
        $user->save();
        $Mahasiswa->nama_mahasiswa = $request->nama_mahasiswa;
        $Mahasiswa->alamat =  $request->alamat;
        $Mahasiswa->no_tlp =  $request->no_tlp;
        $Mahasiswa->email =  $request->email;
        $Mahasiswa->save();

        return $this->berhasil(new MahasiswaResource($Mahasiswa), 'Selamat, Mahasiswa berhasil diubah.');
    }
    public function destroy($id)
    {
        $Mahasiswa = Mahasiswa::FindOrFail($id);
        if ($Mahasiswa->delete()) {
            return $this->berhasil(new MahasiswaResource($Mahasiswa), 'Selamat, Mahasiswa berhasil dihapus.');
        }
    }
}