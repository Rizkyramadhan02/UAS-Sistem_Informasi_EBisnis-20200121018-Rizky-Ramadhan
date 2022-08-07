<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mhs = Mahasiswa::orderBy('updated_at', 'desc')->get();
        // $mhs = Mahasiswa::orderBy('updated_at', 'desc')->paginate(5);
        return view('Mahasiswa.index', ['mahasiswas' => $mhs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('Mahasiswa.create');
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
        $mahasiswas = Mahasiswa::all();
        // if ($mahasiswas->count() > 0) {
        //     $last = $mahasiswas->last();
        //     $nim = $last->nim + 1;
        // } else {
        //     $nim = 20200121001;
        // }

        // Validate Data Mahasiswa
        $request->validate([ 
            'email' => 'required|unique:mahasiswa|max:100|min:3',
            'alamat' => 'required'
        ]);

        //  Insert Data Mahasiswa
        try {
            $mhs = new Mahasiswa;
            // $mhs->nim = $nim;
            $mhs->nama_mahasiswa = $request->nama_mahasiswa;
            $mhs->email = $request->email;
            $mhs->no_tlp = $request->no_tlp;
            $mhs->alamat = $request->alamat;
            $mhs->save();
            

            $user = new user; 
            $user->name = $request->nama_mahasiswa; 
            $user->email = $request->email; 
            $user->password = bcrypt('12345678'); 
            $user->role = 'mahasiswa'; 
            $user->save();
            
        } catch (\Throwable $th) {
            // return error
            return redirect('/mahasiswa')->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa ' . $request->nama_mahasiswa . ' Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return view('Mahasiswa.show', ['mahasiswa' => Mahasiswa::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        // $allmahasiswa = mahasiswa::get(); 
        $mahasiswa = mahasiswa::findorfail($id);
        return view('Mahasiswa.edit', compact('mahasiswa')); 
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
        $mahasiswa = mahasiswa::findorfail($id);  
        // return response()->json([
        //     'data' => $mahasiswa
        //   ]);
        $user = user::where('email', $mahasiswa->email)->first(); 
        $user->email = $request->email;
        $user->save(); 

        $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa;
        $mahasiswa->email = $request->email;
        $mahasiswa->no_tlp = $request->no_tlp;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->save(); 

        


        
 
        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa ' . $request->nama_mahasiswa . ' Berhasil Diubah');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $mahasiswa = mahasiswa::where('id', $id)->get(); 
        $user = user::where('email', $mahasiswa[0]->email)->get(); 
        $user->each->delete(); 
        $mahasiswa->each->delete(); 
        return redirect('/mahasiswa');
    }
}
