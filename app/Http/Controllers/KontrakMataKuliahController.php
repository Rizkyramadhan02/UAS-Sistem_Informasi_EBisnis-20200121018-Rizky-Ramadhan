<?php

namespace App\Http\Controllers;

use App\Models\semester; 
use App\Models\mahasiswa; 
use App\Models\kontrakmatakuliah; 
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontrakMataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $kontrakmatakuliahs = kontrakmatakuliah::orderBy('updated_at', 'desc')->get(); 
        $semesters = semester::get(); 
        $mahasiswas = mahasiswa::get(); 

        return view('kontrakmatakuliah.index', compact('semesters','kontrakmatakuliahs','mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('semester.create');
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
        $semesters = semester::all();  
        //  Insert Data semester
        try {
            $kontrakmatakuliah = new kontrakmatakuliah; 
            $kontrakmatakuliah->mahasiswa_id = $request->mahasiswa_id;  
            $kontrakmatakuliah->semester_id = $request->semester_id;  
            $kontrakmatakuliah->save();
        } catch (\Throwable $th) {
            // return error
            return redirect('/kontrakmatakuliah')->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/kontrakmatakuliah')->with('success', 'Data kontrakmatakuliah ' . $request->kontrakmatakuliah . ' Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kontrakmatakuliah = kontrakmatakuliah::findOrFail($id);   
        
       return view('kontrakmatakuliah.show',compact('kontrakmatakuliah'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $kontrakmatakuliah = kontrakmatakuliah::findorfail($id);
        $semester = semester::get();
        $mahasiswa = mahasiswa::get();
        return view('kontrakmatakuliah.edit', compact('kontrakmatakuliah','semester','mahasiswa'));
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
        $kontrakmatakuliah = kontrakmatakuliah::findorfail($id);    
        $kontrakmatakuliah->mahasiswa_id = $request->mahasiswa_id;  
        $kontrakmatakuliah->semester_id = $request->semester_id;  
        $kontrakmatakuliah->save(); 
        return redirect('/kontrakmatakuliah')->with('success', 'Data kontrakmatakuliah ' . $request->kontrakmatakuliah . ' Berhasil Diubah');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kontrakmatakuliah = kontrakmatakuliah::where('id', $id)->get(); 
        $kontrakmatakuliah->each->delete(); 
        return redirect('/kontrakmatakuliah');
    }



















 








}
