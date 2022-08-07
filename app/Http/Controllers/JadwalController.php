<?php

namespace App\Http\Controllers;

use App\Models\jadwal; 
use App\Models\matakuliah; 
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class jadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $jadwals = jadwal::orderBy('updated_at', 'desc')->get();  
        $matakuliah = matakuliah::get();
        return view('jadwal.index', compact('jadwals','matakuliah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Generate NIM
        $jadwals = jadwal::all();  
        //  Insert Data jadwal
        try {
            $jadwal = new jadwal; 
            $jadwal->jadwal = $request->jadwal;  
            $jadwal->matakuliah_id = $request->matakuliah_id;  
            $jadwal->save();
        } catch (\Throwable $th) {
            // return error
            return redirect('/jadwal')->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/jadwal')->with('success', 'Data jadwal ' . $request->jadwal . ' Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwal = jadwal::findOrFail($id);   
        $matakuliah = matakuliah::get();
       return view('jadwal.show',compact('jadwal','matakuliah'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $jadwal = jadwal::findorfail($id);
        $matakuliah = matakuliah::get();
        return view('jadwal.edit', compact('jadwal','matakuliah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $jadwals = jadwal::findorfail($id);   
        $jadwals->jadwal = $request->jadwal;  
        $jadwals->matakuliah_id = $request->matakuliah_id;  
        $jadwals->save(); 
        return redirect('/jadwal')->with('success', 'Data jadwal ' . $request->jadwal . ' Berhasil Diubah');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = jadwal::where('id', $id)->get(); 
        $jadwal->each->delete(); 
        return redirect('/jadwal');
    }























    public function tambahmhs(Request $request , $id)
    {
        // dd($request->all());
        $mahasiswa_id = $request->mahasiswa; 
        $mahasiswa = mahasiswa::findorfail($mahasiswa_id);  
        $mahasiswa->id_jadwal = $id; 
        $mahasiswa->save(); 
        return redirect('/jadwal/'.$id)->with('success', 'Data mhs ' . $request->jadwal . ' Berhasil Diubah');
    }
    public function hapusmhs(Request $request,$id)
    {

        $mahasiswa = mahasiswa::findorfail($id);  
        $mahasiswa->id_jadwal = null; 
        $mahasiswa->save(); 
        return redirect('/jadwal/'.$id)->with('success', 'Data mhs ' . $request->jadwal . ' Berhasil dihapus');
    }











}
