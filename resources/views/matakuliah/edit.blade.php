@extends('../layouts/mainapp')

@section('title', 'matakuliah')
@section('pagetitle', 'Detail matakuliah')

@section('container')
<a href="/matakuliah" class="btn btn-dark mb-3"><i class="bi bi-arrow-bar-left"></i> Kembali</a>

        <!-- Row -->
    <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="post">
           @csrf

                        @method('PUT')
            <div class="content"> 
               <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_matakuliah" class="form-label">nama matakuliah</label>
                        <input type="text" class="form-control" id="nama_matakuliah" value="{{$matakuliah->id}}"name="nama_matakuliah">
                        @error('nama_matakuliah')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                     <div class="mb-3">
                        <label for="sks" class="form-label">sks matakuliah</label>
                        <input type="number" class="form-control" id="sks" value="{{$matakuliah->sks}}" name="sks">
                        @error('sks')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Dosen </label>
                         <select class=" form-control block "
                            name="dosen_id" id="dosen_id" required >
                            @foreach ($dosen as $data)
                             <option value="{{ $data->id }}"  @if($data->id == $matakuliah->dosen_id)selected @endif>
                                    {{ $data->nama }}</option>
                            
                               
                            @endforeach
                        </select>
                        @error('dosen_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                </div>
                    <button type="submit" class="btn btn-primary">Edit Data</button> 
            </div>
        </form>

@endsection
