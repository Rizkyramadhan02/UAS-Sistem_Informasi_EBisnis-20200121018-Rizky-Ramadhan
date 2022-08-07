@extends('../layouts/mainapp')

@section('title', 'List matakuliah')
@section('pagetitle', 'matakuliah')

@section('container')



{{-- jika message berhasil --}}
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- Jika message gagal --}}
@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<h1 class="mb-3">List matakuliah</h1>

<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Data matakuliah
</button>

<div class="table-responsive">
    <table class="table table-striped table-hover">

        {{-- <div class="position-relative mb-5">
                <div class="position-absolute top-0 end-0">{{ $matakuliah->links() }}
</div>
</div> --}}
<thead>
    <th>No</th> 
    <th>Nama matakuliah</th> 
    <th>SKS matakuliah</th> 
    <th>Dosen Pembimbing matakuliah</th> 
    <th>action</th>
</thead>
@php($no = 1)
@foreach ($matakuliah as $matakuliah)
<tr>
    <td>{{ $no }}</td>  
    <td><a href="/matakuliah/{{ $matakuliah->id }}">{{ $matakuliah->nama_matakuliah }}</a></td> 
    <td>{{ $matakuliah->sks }}</a></td> 
    <td> @foreach ($dosen as $data)
            @if($data->id == $matakuliah->dosen_id)
                {{ $data->nama }}
            @endif
         @endforeach</a></td> 
    <td>
         <form action="{{ route('matakuliah.destroy', $matakuliah->id) }}" method="POST"> 
            <a href="{{ route('matakuliah.edit',  $matakuliah->id) }}" class="btn btn-secondary  btn-xs"  > <i class="bi bi-pencil"></i></a> 
              @csrf
             @method('DELETE')
             <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger deleteconfirm"><i class="bi bi-trash"></i></button>
         </form> 
    </td>
</tr>
@php($no++)
@endforeach
</table>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('matakuliah.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data matakuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_matakuliah" class="form-label">Nama matakuliah</label>
                        <input type="text" class="form-control" id="nama_matakuliah" name="nama_matakuliah">
                        @error('nama_matakuliah')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                     <div class="mb-3">
                        <label for="sks" class="form-label">sks matakuliah</label>
                        <input type="text" class="form-control" id="sks" name="sks">
                        @error('sks')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Dosen </label>
                         <select class=" form-control block "
                            name="dosen_id" id="dosen_id" required >
                            @foreach ($dosen as $data)
                                <option value="{{ $data->id }}" >
                                    {{ $data->nama }}</option>
                            @endforeach
                        </select>
                        @error('dosen_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </div>
        </form>
    </div>
</div>




 
@endsection
