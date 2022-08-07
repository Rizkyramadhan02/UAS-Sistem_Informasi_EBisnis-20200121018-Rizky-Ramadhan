@extends('../layouts/mainapp')

@section('title', 'Mahasiswa')
@section('pagetitle', 'Detail Mahasiswa')

@section('container')
<a href="/mahasiswa" class="btn btn-dark mb-3"><i class="bi bi-arrow-bar-left"></i> Kembali</a>
  <form action="{{ route('dosen.update', $dosen->id) }}" method="post">
           @csrf

                        @method('PUT')
            <div class="content"> 
                <div class="body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama dosen</label>
                        <input type="text" class="form-control" id="nama" value="{{$dosen->nama}}"name="nama">
                        @error('nama')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                </div>
                <div class="body">
                    <div class="mb-3">
                        <label for="email" class="form-label">email dosen</label>
                        <input type="text" class="form-control" id="email" value="{{$dosen->email}}"name="email">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                </div> 
                    <button type="submit" class="btn btn-primary">Edit Data</button> 
            </div>
        </form>

@endsection
