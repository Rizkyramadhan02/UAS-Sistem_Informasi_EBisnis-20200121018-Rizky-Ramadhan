<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiFormatterController as ApiFormatterController;
use App\Http\Resources\matakuliahResource as matakuliahResource;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class matakuliahApiController extends ApiFormatterController
{
    public function index()
    {
        $matakuliah = MataKuliah::get();
        return $this->berhasil(MataKuliahResource::collection($matakuliah), 'Selamat, semua matakuliah berhasil didapat.');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $cekinput = Validator::make($input, [
            'dosen_id' => 'required', 
            'nama_matakuliah' => 'required', 
            'sks' => 'required', 
        ]);
        if ($cekinput->fails()) {
            return $this->gagal('Validasi eror.', $cekinput->errors());
        } 
        $matakuliah = MataKuliah::create($input);
       
        return $this->berhasil(new matakuliahResource($matakuliah), 'Selamat anda berhasil membuat matakuliah baru');
    }
    public function show($id)
    {
        $matakuliah = matakuliah::find($id);
        if (is_null($matakuliah)) {
            return $this->gagal('matakuliah tidak ditemukan');
        }
        return $this->berhasil(new matakuliahResource($matakuliah), 'Selamat matakuliah berhasil didapat');
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $cekinput = Validator::make($input, [
            'dosen_id' => 'required', 
            'nama_matakuliah' => 'required', 
            'sks' => 'required', 
        ]);
        if ($cekinput->fails()) {
            return $this->gagal('Validasi eror.', $cekinput->errors());
        }
        $matakuliah = matakuliah::findorfail($id); 
        $matakuliah->dosen_id = $request->dosen_id; 
        $matakuliah->nama_matakuliah =  $request->nama_matakuliah;
        $matakuliah->sks =  $request->sks;
        $matakuliah->save();

        return $this->berhasil(new matakuliahResource($matakuliah), 'Selamat, matakuliah berhasil diubah.');
    }
    public function destroy($id)
    {
        $matakuliah = matakuliah::FindOrFail($id);
        if ($matakuliah->delete()) {
            return $this->berhasil(new matakuliahResource($matakuliah), 'Selamat, matakuliah berhasil dihapus.');
        }
    }
}