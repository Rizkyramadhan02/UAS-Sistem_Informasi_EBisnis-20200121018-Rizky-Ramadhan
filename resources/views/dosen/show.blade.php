@extends('../layouts/mainapp')

@section('title', 'dosen')
@section('pagetitle', 'Detail dosen')

@section('container')
<a href="/dosen" class="btn btn-dark mb-3"><i class="bi bi-arrow-bar-left"></i> Kembali</a>

        <!-- Row -->
        <div class="row gx-5">
            <!-- Column -->
            <div class="col">
                <div class="white-box">
                    <div class="user-bg"> <img width="100%" alt="{{ $dosen->nama }}"
                            src="https://source.unsplash.com/600x400?programming">
                        <div class="overlay-box">
                            <div class="user-content">
                                <a href="javascript:void(0)"><img src="https://source.unsplash.com/400x400?face"
                                        class="thumb-lg img-circle" alt="img"></a>
                                <h4 class="text-white mt-2">{{ $dosen->nama }}</h4> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Detail dosen</h2>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Nama : {{ $dosen->nama }}</li> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>

@endsection
