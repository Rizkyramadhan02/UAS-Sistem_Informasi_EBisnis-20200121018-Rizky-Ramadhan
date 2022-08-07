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

 

<div class="table-responsive">
    <table class="table table-striped table-hover">

        {{-- <div class="position-relative mb-5">
                <div class="position-absolute top-0 end-0">{{ $matakuliah->links() }}
</div>
</div> --}}
<thead>
    <th>No</th> 
    <th>Nama matakuliah</th>  
    <th>sks</th>  
    <th>action</th>
</thead>
@php($no = 1)
@foreach ($matakuliah as $matakuliah)
<tr>
    <td>{{ $no }}</td>  
    <td><a href="/absen/{{ $matakuliah->id }}">{{ $matakuliah->nama_matakuliah }}</a></td>  
    <td><a href="/absen/{{ $matakuliah->id }}">{{ $matakuliah->sks }}</a></td>  
     <td>  <a class="btn btn-primary "  href="/absen/{{ $matakuliah->id }}"><i class="bi bi-eye"></i></a>  </td> 
</tr>
@php($no++)
@endforeach
</table>
</div>
 
@endsection
