<?php

namespace App\Http\Controllers;

use App\Models\matakuliah;
use App\Models\dosen;
use App\Models\absen;
use Carbon\Carbon;
use App\Models\mahasiswa;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Auth::user()->email)
        $iddosen = dosen::where('email', Auth::user()->email)->first();
        $id = $iddosen->id;
        $matakuliah = matakuliah::where('dosen_id', $id)->orderBy('updated_at', 'desc')->get();
        $dosen = dosen::get();
        // $matakuliah = matakuliah::orderBy('updated_at', 'desc')->paginate(5);
        return view('absen.index', compact('dosen','matakuliah'));
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
        // dd($request->all());
        // Generate NIM
        $tanggal= Carbon::now()->format('Y-m-d'); 
        $waktu_absen= Carbon::now(); 
        // dd($tanggal);
        if(isset($request->hadir)){
            foreach ($request->hadir as $i => $total){
                $absen = absen::where('tanggal_absen',$tanggal)->where('mahasiswa_id', $request->hadir[$i])->where('matakuliah_id',$request->idmatakuliah)->first(); 
                if($absen == null){
                $absen = new absen; 
                    $absen->waktu_absen = $waktu_absen; 
                    $absen->tanggal_absen = $tanggal; 
                    $absen->mahasiswa_id= $request->hadir[$i]; 
                    $absen->matakuliah_id= $request->idmatakuliah;
                    $absen->keterangan= 'Hadir';
                    $absen->save();
                }else{
                    $absen->waktu_absen = $waktu_absen; 
                    $absen->tanggal_absen = $tanggal; 
                    $absen->mahasiswa_id= $request->hadir[$i]; 
                    $absen->matakuliah_id= $request->idmatakuliah;
                    $absen->keterangan= 'Hadir';
                    $absen->save();
                }
             } 
        }
        if(isset($request->tidakhadir)){
         
            foreach ($request->tidakhadir as $i => $total){
                // $absen = absen::findorfail($id);  
                $absen = absen::where('tanggal_absen',$tanggal)->where('mahasiswa_id', $request->tidakhadir[$i])->where('matakuliah_id',$request->idmatakuliah)->first(); 
                if($absen == null){
                $absen = new absen; 
                    $absen->waktu_absen = null; 
                    $absen->tanggal_absen = $tanggal; 
                    $absen->mahasiswa_id= $request->tidakhadir[$i]; 
                    $absen->matakuliah_id= $request->idmatakuliah;
                    $absen->keterangan= 'Tidak Hadir';
                    $absen->save();
                }else{
                    $absen->waktu_absen = null; 
                    $absen->tanggal_absen = $tanggal; 
                    $absen->mahasiswa_id= $request->tidakhadir[$i]; 
                    $absen->matakuliah_id= $request->idmatakuliah;
                    $absen->keterangan= 'Tidak Hadir';
                    $absen->save();
                }
                
            // dd($absen); 
             } 
        }
        
        //  dd($request->idmatakuliah);
        //    Redirect to Index
        
        // return redirect("/absen")->with('success', 'Data absen  Berhasil Ditambahkan');
        return redirect("/absen/$request->idmatakuliah")->with('success', 'Data absen  Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tanggal= Carbon::now()->format('Y-m-d'); 
        // $tanggal= Carbon::now()->format('Y-m-d'); 

        $absen = absen::where('tanggal_absen',$tanggal)->get(); 
        $matakuliah = matakuliah::findOrFail($id);  
        $mahasiswa = mahasiswa::get();    
        // $absen = $absen->toArray(); 
        // dd($absen);
        return view('absen.show',compact('matakuliah','mahasiswa','absen'));
    }


 



    public function tambahmhs(Request $request , $id)
    {
        // dd($request->all());
        $mahasiswa_id = $request->mahasiswa; 
        $mahasiswa = mahasiswa::findorfail($mahasiswa_id);  
        $mahasiswa->id_matakuliah = $id; 
        $mahasiswa->save(); 
        return redirect('/matakuliah/'.$id)->with('success', 'Data mhs ' . $request->nama . ' Berhasil Diubah');
    }
    public function hapusmhs(Request $request,$id)
    {

        $mahasiswa = mahasiswa::findorfail($id);  
        $mahasiswa->id_matakuliah = null; 
        $mahasiswa->save(); 
        return redirect('/matakuliah/'.$id)->with('success', 'Data mhs ' . $request->nama . ' Berhasil dihapus');
    }











}
