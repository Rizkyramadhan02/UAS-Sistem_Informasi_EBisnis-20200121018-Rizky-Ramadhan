<?php

namespace App\Http\Controllers;

use App\Models\semester; 
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class semesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $semesters = semester::orderBy('updated_at', 'desc')->get(); 
        return view('semester.index', compact('semesters'));
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
            $semester = new semester; 
            $semester->semester = $request->semester;  
            $semester->save();
        } catch (\Throwable $th) {
            // return error
            return redirect('/semester')->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/semester')->with('success', 'Data semester ' . $request->semester . ' Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $semester = semester::findOrFail($id);   
        
       return view('semester.show',compact('semester'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $semester = semester::findorfail($id);
        return view('semester.edit', compact('semester'));
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
        $semesters = semester::findorfail($id);   
        $semesters->semester = $request->semester;  
        $semesters->save(); 
        return redirect('/semester')->with('success', 'Data semester ' . $request->semester . ' Berhasil Diubah');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $semester = semester::where('id', $id)->get(); 
        $semester->each->delete(); 
        return redirect('/semester');
    }























    public function tambahmhs(Request $request , $id)
    {
        // dd($request->all());
        $mahasiswa_id = $request->mahasiswa; 
        $mahasiswa = mahasiswa::findorfail($mahasiswa_id);  
        $mahasiswa->id_semester = $id; 
        $mahasiswa->save(); 
        return redirect('/semester/'.$id)->with('success', 'Data mhs ' . $request->semester . ' Berhasil Diubah');
    }
    public function hapusmhs(Request $request,$id)
    {

        $mahasiswa = mahasiswa::findorfail($id);  
        $mahasiswa->id_semester = null; 
        $mahasiswa->save(); 
        return redirect('/semester/'.$id)->with('success', 'Data mhs ' . $request->semester . ' Berhasil dihapus');
    }











}
