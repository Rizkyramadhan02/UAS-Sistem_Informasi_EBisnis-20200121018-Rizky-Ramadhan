@extends('../layouts/mainapp')

@section('title', 'jadwal')
@section('pagetitle', 'Detail jadwal')

@section('container')
<a href="/jadwal" class="btn btn-dark mb-3"><i class="bi bi-arrow-bar-left"></i> Kembali</a>

        <!-- Row -->
    <form action="{{ route('jadwal.update', $jadwal->id) }}" method="post">
           @csrf

                        @method('PUT')
            <div class="content"> 
                <div class="body"> 

                                    <div class="mb-3">
                                        <label for="jadwal" class="form-label">Nama jadwal</label>
                                        <input type="time" class="form-control" id="jadwal" value="{{$jadwal->jadwal}}"name="jadwal">
                                        @error('jadwal')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                        <div class="mb-3">
                                        <label for="matakuliah_id" class="form-label">Nama Dosen </label>
                                        <select class=" form-control block "
                                            name="matakuliah_id" id="matakuliah_id" required >
                                            @foreach ($matakuliah as $data)
                                            <option value="{{ $data->id }}"  @if($data->id == $jadwal->matakuliah_id)selected @endif>
                                                    {{ $data->nama_matakuliah }}</option> 
                                            
                                            @endforeach
                                        </select>
                                        @error('matakuliah_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div> 
                                </div>  
                    <button type="submit" class="btn btn-primary">Edit Data</button> 
            </div>
        </form>

@endsection
