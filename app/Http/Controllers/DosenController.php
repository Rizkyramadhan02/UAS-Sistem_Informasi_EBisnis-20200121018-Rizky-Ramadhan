<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use App\Models\user;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class dosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = dosen::orderBy('updated_at', 'desc')->get();
        // $dosen = dosen::orderBy('updated_at', 'desc')->paginate(5);
        return view('dosen.index', ['dosens' => $dosen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('dosen.create');
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

        $request->validate([ 
            'email' => 'required|unique:mahasiswa|max:100|min:3', 
        ]);
        // Generate NIM
        $dosens = dosen::all();  
        //  Insert Data dosen
        try {
            $dosen = new dosen; 
            $dosen->nama = $request->nama;  
            $dosen->email = $request->email; 
            $dosen->save();

            $user = new user; 
            $user->name = $request->nama; 
            $user->email = $request->email; 
            $user->password = bcrypt('12345678'); 
            $user->role = 'dosen'; 
            $user->save();
        } catch (\Throwable $th) {
            // return error
            return redirect('/dosen')->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/dosen')->with('success', 'Data dosen ' . $request->nama . ' Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return view('dosen.show', ['dosen' => dosen::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $alldosen = dosen::get(); 
        $dosen = dosen::findorfail($id);
        
        return view('dosen.edit', compact('dosen','alldosen'));
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
        $dosen = dosen::findorfail($id);  
        
        $user = user::where('email', $dosen->email)->first(); 
        $user->email = $request->email;
        $user->save(); 
        $dosen->nama = $request->nama; 
        $dosen->email = $request->email; 

        $dosen->save(); 
        return redirect('/dosen')->with('success', 'Data dosen ' . $request->nama . ' Berhasil Diubah');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = dosen::where('id', $id)->get(); 
        
        $user = user::where('email', $dosen[0]->email)->get(); 
        $user->each->delete(); 
        $dosen->each->delete(); 
        return redirect('/dosen');
    }
}
