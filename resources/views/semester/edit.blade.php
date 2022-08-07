@extends('../layouts/mainapp')

@section('title', 'semester')
@section('pagetitle', 'Detail semester')

@section('container')
<a href="/semester" class="btn btn-dark mb-3"><i class="bi bi-arrow-bar-left"></i> Kembali</a>

        <!-- Row -->
    <form action="{{ route('semester.update', $semester->id) }}" method="post">
           @csrf

                        @method('PUT')
            <div class="content"> 
                <div class="body"> 

                                    <div class="mb-3">
                                        <label for="semester" class="form-label">Nama semester</label>
                                        <input type="text" class="form-control" id="semester" value="{{$semester->semester}}"name="nama_semester">
                                        @error('semester')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                      
                                </div>  
                    <button type="submit" class="btn btn-primary">Edit Data</button> 
            </div>
        </form>

@endsection
