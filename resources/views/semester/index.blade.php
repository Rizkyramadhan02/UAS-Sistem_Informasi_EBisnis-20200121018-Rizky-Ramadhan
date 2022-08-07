@extends('../layouts/mainapp')

@section('title', 'List semester')
@section('pagetitle', 'semester')

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


<h1 class="mb-3">List semester</h1>

<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Data semester
</button>

<div class="table-responsive">
    <table class="table table-striped table-hover">

        {{-- <div class="position-relative mb-5">
                <div class="position-absolute top-0 end-0">{{ $semester->links() }}
</div>
</div> --}}
<thead>
    <th>No</th> 
    <th>Nama semester</th>  
    <th>action</th>
</thead>
@php($no = 1)
@foreach ($semesters as $smt)
<tr>
    <td>{{ $no }}</td>  
    <td> {{ $smt->semester }} </td>  
    <td>
         <form action="{{ route('semester.destroy', $smt->id) }}" method="POST"> 
             <a href="{{ route('semester.edit',  $smt->id) }}" class="btn btn-secondary  btn-xs"  > <i class="bi bi-pencil"></i></a> 
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
        <form action="{{ route('semester.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data semester</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="semester" class="form-label">Nama semester</label>
                        <input type="text" class="form-control" id="semester" name="semester">
                        @error('semester')
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


 