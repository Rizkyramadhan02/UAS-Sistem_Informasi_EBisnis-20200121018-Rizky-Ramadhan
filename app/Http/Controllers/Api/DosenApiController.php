<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiFormatterController as ApiFormatterController;
use App\Http\Resources\DosenResource as DosenResource;
use App\Models\dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class DosenApiController extends ApiFormatterController
{
    public function index()
    {
        $dosen = dosen::get();
        return $this->berhasil(DosenResource::collection($dosen), 'Selamat, semua dosen berhasil didapat.');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $cekinput = Validator::make($input, [
            'nama' => 'required', 
            'email' => 'required', 
        ]);
        if ($cekinput->fails()) {
            return $this->gagal('Validasi eror.', $cekinput->errors());
        }

        $dosen = dosen::create($input);
        $user = new user; 
        $user->name = $request->nama; 
        $user->email = $request->email;   
        $user->password = bcrypt('12345678'); 
        $user->role = 'dosen'; 
        $user->save();
        return $this->berhasil(new DosenResource($dosen), 'Selamat anda berhasil membuat dosen baru');
    }
    public function show($id)
    {
        $dosen = dosen::find($id);
        if (is_null($dosen)) {
            return $this->gagal('dosen tidak ditemukan');
        }
        return $this->berhasil(new DosenResource($dosen), 'Selamat dosen berhasil didapat');
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $cekinput = Validator::make($input, [
            'nama' => 'required', 
            'email' => 'required', 
        ]);
        if ($cekinput->fails()) {
            return $this->gagal('Validasi eror.', $cekinput->errors());
        }
        $dosen = dosen::findorfail($id);
        $user = user::where('email', $dosen->email)->first(); 
        $user->email = $request->email;
        $user->save();
        $dosen->nama = $request->nama; 
        $dosen->email =  $request->email;
        $dosen->save();

        return $this->berhasil(new DosenResource($dosen), 'Selamat, dosen berhasil diubah.');
    }
    public function destroy($id)
    {
        $dosen = dosen::FindOrFail($id);
        if ($dosen->delete()) {
            return $this->berhasil(new DosenResource($dosen), 'Selamat, dosen berhasil dihapus.');
        }
    }
}