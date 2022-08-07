@extends('../layouts/mainapp')

@section('title', 'Dashboard')
@section('pagetitle', 'Dashboard Admin')

@section('container')
<h1 class="mb-3">Selamat Datang {{Auth::user()->name}} - Hari ini tanggal : {{Carbon\Carbon::now()->format('Y-m-d')}}</h1>
{{-- <iframe width="100%" height="350" src="https://www.youtube.com/embed/6oHk5d_KpkU?controls=0&amp;start=13&autoplay=1" title="ASMR" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}



@if(Auth::user()->role=="mahasiswa")
        <?php
                $absen = App\Models\absen::where('tanggal_absen',Carbon\Carbon::now()->format('Y-m-d'))->get(); 
                $matakuliah = App\Models\matakuliah::get(); 
                $mahasiswa = App\Models\mahasiswa::where('email', Auth::user()->email)->first();   
        ?>
        @php($hadir = false) 
        @foreach ($absen as $key => $abs)  
            @if(($abs->mahasiswa_id == $mahasiswa->id))
                @foreach ($matakuliah as $m => $matkuls)  
                    @if(($matkuls->id == $abs->matakuliah_id)) 
                        <p> Status Absen Hari ini : </p>
                        <ul>
                            <li>{{$matkuls->nama_matakuliah}} : {{$abs->keterangan}} </li>
                        </ul> 
                    @endif
                @endforeach
                @php($hadir=true)
            @endif
        @endforeach
            {{-- {{dd($mahasiswa)}} --}}

    @if(!$hadir)
        <p>  Status Absen Hari ini : Belum Absen  </p>
    @endif
@endif

@endsection
