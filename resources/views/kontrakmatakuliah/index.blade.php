@extends('../layouts/mainapp')

@section('title', 'List kontrakmatakuliah')
@section('pagetitle', 'kontrakmatakuliah')

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


<h1 class="mb-3">List kontrakmatakuliah</h1>

<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Data kontrakmatakuliah
</button>

<div class="table-responsive">
    <table class="table table-striped table-hover"> 
<thead>
    <th>No</th> 
    <th>Mahasiswa Id</th>  
    <th>Semester Id</th>  
    <th>action</th>
</thead>
@php($no = 1)
@foreach ($kontrakmatakuliahs as $kon)
<tr>
    <td>{{ $no }}</td>  
    <td>   
    <b>( {{ $kon->mahasiswa_id }} ) </b>  
      @foreach ($mahasiswas as $data)
         @if($data->id == $kon->mahasiswa_id) 
                 {{ $data->nama_mahasiswa }} 
         @endif 
      @endforeach
    </td>  
    <td><b>( {{ $kon->semester_id }} ) </b>  
      @foreach ($semesters as $data)
         @if($data->id == $kon->semester_id) 
                 {{ $data->semester }} 
         @endif 
      @endforeach </td>  
    <td>
         <form action="{{ route('kontrakmatakuliah.destroy', $kon->id) }}" method="POST"> 
             <a href="{{ route('kontrakmatakuliah.edit',  $kon->id) }}" class="btn btn-secondary  btn-xs"  > <i class="bi bi-pencil"></i></a> 
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
        <form action="{{ route('kontrakmatakuliah.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data kontrakmatakuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Mahasiswa </label>
                         <select class=" form-control block "
                            name="mahasiswa_id" id="mahasiswa_id" required >
                            @foreach ($mahasiswas as $data)
                                <option value="{{ $data->id }}" >
                                    {{ $data->nama_mahasiswa }}</option>
                            @endforeach
                        </select>
                        @error('mahasiswa_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                     <div class="mb-3">
                        <label for="nama" class="form-label">Nama Mahasiswa </label>
                         <select class=" form-control block "
                            name="semester_id" id="semester_id" required >
                            @foreach ($semesters as $data)
                                <option value="{{ $data->id }}" >
                                    {{ $data->semester }}</option>
                            @endforeach
                        </select>
                        @error('semester_id')
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


 