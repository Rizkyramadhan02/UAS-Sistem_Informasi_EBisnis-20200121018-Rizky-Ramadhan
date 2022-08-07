@extends('../layouts/mainapp')

@section('title', 'Mahasiswa')
@section('pagetitle', 'Detail Mahasiswa')

@section('container')
<a href="/mahasiswa" class="btn btn-dark mb-3"><i class="bi bi-arrow-bar-left"></i> Kembali</a>

        <!-- Row -->
    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="post">
           @csrf

                        @method('PUT')
            <div class="content"> 
                <div class="body"> 

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Mahasiswa</label>
                                        <input type="text" class="form-control" id="nama_mahasiswa" value="{{$mahasiswa->nama_mahasiswa}}"name="nama_mahasiswa">
                                        @error('nama_mahasiswa')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat Mahasiswa</label>
                                        <textarea class="form-control" id="alamat" name="alamat" >{{$mahasiswa->alamat}}</textarea>
                                        @error('alamat')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="no_tlp" class="form-label">no_tlp Mahasiswa</label>
                                        <input type="number" class="form-control" id="no_tlp" value="{{$mahasiswa->no_tlp}}"name="no_tlp">
                                        @error('no_tlp')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Mahasiswa</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{$mahasiswa->email}}">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>  
                    <button type="submit" class="btn btn-primary">Edit Data</button> 
            </div>
        </form>

@endsection
