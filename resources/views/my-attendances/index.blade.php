@extends('layouts.default')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Kehadiran</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Kehadiran</a></div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Daftar Kehadiran</h4>
              </div>
              <div class="card-body">

                <div class="dropdown d-inline mr-2">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tambah Absensi
                    </button>
                    <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -133px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="#" id="btn-masuk" data-toggle="modal" data-target="#modalMasuk">Masuk</a>
                        <a class="dropdown-item" href="#">Sakit</a>
                        <a class="dropdown-item" href="#">Izin</a>
                        <a class="dropdown-item" href="#">Cuti</a>
                    </div>
                </div>

                <div class="clearfix mb-3"></div>

                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th>ID</th>
                      <th>Tipe</th>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th>Jam</th>
                      <th>#</th>
                    </tr>
                    @forelse ($attendances as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{!! $item->type_badge !!}</td>
                        <td>{!! $item->status_badge !!}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->time_in }}</td>
                        <td>
                            @if($item->file_url)
                            <a href="{{ $item->file_url }}" target="_blank">
                                <img src="{{ $item->file_url }}" alt="" width="50">
                            </a>
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" align="center">
                            <div class="empty-state" data-height="400" style="height: 400px;">
                                <div class="empty-state-icon">
                                  <i class="fas fa-question"></i>
                                </div>
                                <h2>Data Tidak Ditemukan</h2>
                                <p class="lead">
                                  Maaf kami tidak dapat menemukan data.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                  </table>
                </div>
                <div class="float-right">
                  {{ $attendances->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalMasuk">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <video id="video" width="100%" autoplay></video>
                <form action="{{ route('my-attendances.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="attend">
                    <textarea class="d-none" name="foto" id="data_foto"></textarea>
                    <canvas id="canvas" width="640" height="480" class="d-none"></canvas>
                    <center>
                        <button class="btn btn-primary mt-2" id="click-photo">Masuk</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript">
let camera_button = document.querySelector("#btn-masuk");
let video = document.querySelector("#video");
let click_button = document.querySelector("#click-photo");
let canvas = document.querySelector("#canvas");

camera_button.addEventListener('click', async function() {
   	let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
	video.srcObject = stream;
});

click_button.addEventListener('click', function() {
   	canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
   	let image_data_url = canvas.toDataURL('image/jpeg');
    $("#data_foto").val(image_data_url)

   	// data url of the image
   	console.log(image_data_url);
});
</script>
@endsection
