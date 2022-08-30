@extends('layouts.default')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ $user->name }}</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Pegawai</a></div>
          <div class="breadcrumb-item">Slip Gaji</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column">
                        <li class="nav-item"><a href="{{ route('users.show', $user) }}" class="nav-link">Profile</a></li>
                        <li class="nav-item"><a href="{{ route('users.overview', $user) }}" class="nav-link">Overview</a></li>
                        <li class="nav-item"><a href="{{ route('users.attendances', $user) }}" class="nav-link">Kehadiran</a></li>
                        <li class="nav-item"><a href="#" class="nav-link active">Slip Gaji</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                <div class="card-header">
                    <h4>Daftar Slip Gaji</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <tr>
                            <th>ID</th>
                            <th>Periode</th>
                            <th>Jumlah Pendapatan</th>
                            <th>Jumlah Potongan</th>
                            <th>Gaji Bersih</th>
                            <th>#</th>
                          </tr>
                          @forelse ($sallaries as $item)
                          <tr>
                              <td>{{ $item->id }}</td>
                              <td>{{ $item->periode() }}</td>
                              <td>{{ $item->getTotalSallaryRupiah() }}</td>
                              <td>{{ $item->getTotalCutsRupiah() }}</td>
                              <td>{{ $item->getTotalFinalSallaryRupiah() }}</td>
                              <td>
                                  <a href="{{ route('sallaries.slip', $item) }}" class="btn btn-primary">Slip Gaji</a>
                              </td>
                          </tr>
                          @empty
                          <tr>
                              <td colspan="8" align="center">
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
                        {{ $sallaries->links() }}
                      </div>
                </div>
                </div>
            </div>
        </div>
      </div>
    </section>
  </div>

  {{-- Modal Masuk --}}
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

{{-- Modal Sakit --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modalSakit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sakit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('my-attendances.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="sick">
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Dari</label>
                        <div class="col-md-9">
                            <input type="date" min="{{ date('Y-m-d') }}" required name="start_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Sampai</label>
                        <div class="col-md-9">
                            <input type="date" min="{{ date('Y-m-d') }}" required name="end_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Keterangan</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Surat Sakit</label>
                        <div class="col-md-9">
                            <input type="file" required name="file" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <center>
                        <button class="btn btn-primary mt-2" id="click-photo">Simpan</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Cuti --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modalCuti">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cuti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('my-attendances.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="paid_leave">
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Dari</label>
                        <div class="col-md-9">
                            <input type="date" min="{{ date("Y-m-d", strtotime("+1 day")) }}" required name="start_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Sampai</label>
                        <div class="col-md-9">
                            <input type="date" min="{{ date("Y-m-d", strtotime("+1 day")) }}" required name="end_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Keterangan</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>

                    <center>
                        <button class="btn btn-primary mt-2" id="click-photo">Simpan</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Izin --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modalIzin">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Izin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('my-attendances.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="permission">
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Dari</label>
                        <div class="col-md-9">
                            <input type="date" min="{{ date("Y-m-d", strtotime("+1 day")) }}" required name="start_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Sampai</label>
                        <div class="col-md-9">
                            <input type="date" min="{{ date("Y-m-d", strtotime("+1 day")) }}" required name="end_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Keterangan</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>

                    <center>
                        <button class="btn btn-primary mt-2" id="click-photo">Simpan</button>
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
