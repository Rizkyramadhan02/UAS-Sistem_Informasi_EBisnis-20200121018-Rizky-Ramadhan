<?php

namespace App\Http\Controllers;

use App\Models\matakuliah;
use App\Models\dosen;
use App\Models\mahasiswa;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class matakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $matakuliah = matakuliah::orderBy('updated_at', 'desc')->get();
        $dosen = dosen::get();
        // $matakuliah = matakuliah::orderBy('updated_at', 'desc')->paginate(5);
        return view('matakuliah.index', compact('dosen','matakuliah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('matakuliah.create');
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
        $matakuliahs = matakuliah::all();  
        //  Insert Data matakuliah
        try {
            $matakuliah = new matakuliah; 
            $matakuliah->nama_matakuliah = $request->nama_matakuliah; 
            $matakuliah->sks = $request->sks; 
            $matakuliah->dosen_id = $request->dosen_id; 
            $matakuliah->save();
        } catch (\Throwable $th) {
            // return error
            return redirect('/matakuliah')->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/matakuliah')->with('success', 'Data matakuliah ' . $request->nama_matakuliah . ' Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matakuliah = matakuliah::findOrFail($id);  
        $mahasiswa = mahasiswa::get();   
        
       return view('matakuliah.show',compact('matakuliah','mahasiswa'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $dosen = dosen::get(); 
        $matakuliah = matakuliah::findorfail($id);
        return view('matakuliah.edit', compact('matakuliah','dosen'));
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
        $matakuliah = matakuliah::findorfail($id);   
        $matakuliah->nama_matakuliah = $request->nama_matakuliah; 
        $matakuliah->sks = $request->sks; 
        $matakuliah->dosen_id = $request->dosen_id; 
        $matakuliah->save(); 
        return redirect('/matakuliah')->with('success', 'Data matakuliah ' . $request->nama_matakuliah . ' Berhasil Diubah');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matakuliah = matakuliah::where('id', $id)->get(); 
        $matakuliah->each->delete(); 
        return redirect('/matakuliah');
    }























    public function tambahmhs(Request $request , $id)
    {
        // dd($request->all());
        $mahasiswa_id = $request->mahasiswa; 
        $mahasiswa = mahasiswa::findorfail($mahasiswa_id);  
        $mahasiswa->id_matakuliah = $id; 
        $mahasiswa->save(); 
        return redirect('/matakuliah/'.$id)->with('success', 'Data mhs ' . $request->nama_matakuliah . ' Berhasil Diubah');
    }
    public function hapusmhs(Request $request,$id)
    {

        $mahasiswa = mahasiswa::findorfail($id);  
        $mahasiswa->id_matakuliah = null; 
        $mahasiswa->save(); 
        return redirect('/matakuliah/'.$id)->with('success', 'Data mhs ' . $request->nama_matakuliah . ' Berhasil dihapus');
    }











}
