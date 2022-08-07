@extends('../layouts/mainapp')

@section('title', 'absn')
@section('pagetitle', 'Detail absn')

@section('container')
<a href="/absen" class="btn btn-dark mb-3"><i class="bi bi-arrow-bar-left"></i> Kembali</a>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <th width=1%>No</th>
            <th>Nama mhs</th>
            <th>Waktu Absen</th>
            <th>Keterangan</th>
            <th width=20% style="text-align:center"> Action </th>
        </thead>
        @php($no = 1)

        <form method="post" action="{{ route('absen.store', $matakuliah->id) }}" enctype="multipart/form-data">
            <input type="hidden" name="idmatakuliah" value="{{ $matakuliah->id }}">
            @csrf

            @foreach ($mahasiswa as $mahasiswa)
            <tr>
                <td>{{ $no }}</td> 
                
                 @php($hadir = false) 
                @foreach ($absen as $key => $abs) 
                {{-- @php(dd($abs->keterangan)); --}}
                    @if(($absen[$key]->matakuliah_id == $matakuliah->id) && ($absen[$key]->mahasiswa_id == $mahasiswa->id))   
                        @php($hadir=true) 
                            @if($absen[$key]->keterangan=="Hadir" || $absen[$key]->keterangan=="Tidak Hadir" ) 
                             <td>
                                <div class="form-group">
                                    <label> {{ $mahasiswa->nama_mahasiswa }}</label>
                                </div>  
                            </td>
                            <td>
                                <div class="form-group">
                                    <label> {{ $absen[$key]->waktu_absen }}</label>
                                </div>  
                            </td>
                              @if($absen[$key]->keterangan == "Hadir")
                                  <td><h6 class="text-success">{{$absen[$key]->keterangan}}</h6>  </td> 
                                  <td>
                                <div class="form-group" style="style="text-align:center"">
                                    <label><input type="checkbox"  name="tidakhadir[]" value="{{ $mahasiswa->id }}"> Tidak Hadir </label> 
                                </div>
                            </td>
                                 @elseif($absen[$key]->keterangan == "Tidak Hadir")
                                  <td><h6 class="text-danger">{{$absen[$key]->keterangan}}</h6> </td> 
                                  <td>
                                <div class="form-group" style="style="text-align:center"">
                                    <label><input type="checkbox"  name="hadir[]" value="{{ $mahasiswa->id }}"> Hadir </label> 
                                </div>
                            </td> 
                                 @endif 
                            
                           @endif  
                    @endif
                @endforeach   
                @if(!$hadir)  
                    <td>
                        <div class="form-group">
                            <label> {{ $mahasiswa->nama_mahasiswa }}</label>
                        </div>  
                    </td>
                     <td>
                          <div class="form-group">
                               <label> - </label>
                                </div>  
                          </td>
                    <td>
                         <h6 class="text-warning">Belum Absen</h6> 
                    </td>  
                    <td>
                        <div class="form-group" style="style="text-align:center"">
                            <label><input type="checkbox"  name="hadir[]" value="{{ $mahasiswa->id }}"> Hadir </label> 
                        </div>
                    </td> 
                @endif
            </tr>
            @php($no++)
            @endforeach
            <tr>
                <td colspan=4>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </div>
                </td>
            </tr>
        </form>
    </table>
</div>



 
@endsection
