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
                <div class="float-right">
                  <form action="" method="GET">
                    <div class="d-flex">
                        <select name="type" class="form-control mr-3" onchange="this.form.submit()">
                            <option value="">Pilih Tipe</option>
                            <option value="attend" {{ request()->type == 'attend' ? 'selected' : '' }}>Masuk</option>
                            <option value="permission" {{ request()->type == 'permission' ? 'selected' : '' }}>Izin</option>
                            <option value="sick" {{ request()->type == 'sick' ? 'selected' : '' }}>Sakit</option>
                            <option value="not_attend" {{ request()->type == 'not_attend' ? 'selected' : '' }}>Tidak Hadir</option>
                        </select>
                    </div>
                  </form>
                </div>

                <div class="clearfix mb-3"></div>

                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th>ID</th>
                      <th>Pegawai</th>
                      <th>Tipe</th>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th>Jam</th>
                      <th>#</th>
                    </tr>
                    @forelse ($attendances as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{!! $item->type_badge !!}</td>
                        <td>{!! $item->status_badge !!}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->time_in }}</td>
                        <td>
                            @if($item->status == 'pending')
                            <span data-title="{{ $item->user->name }}" href="{{ route('attendances.update', $item) }}" class="btn btn-sm btn-success btn-approve"> Approve</span>
                            <span data-title="{{ $item->user->name }}" href="{{ route('attendances.update', $item) }}" class="btn btn-sm btn-danger btn-reject"> Reject</span>
                            @endif
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
                  {{ $attendances->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<form action="" method="POST" id="updateForm">
    @csrf
    @method('PUT')
    <input type="hidden" name="status" id="statusAttendance">
    <input type="submit" style="display: none;">
</form>
@endsection

@section('js')

<script type="text/javascript">
    $('.btn-approve').on('click', function(){
        $("#statusAttendance").val('approved');
        update($(this).attr('href'), $(this).data('title'));
    });


    $('.btn-reject').on('click', function(){
        $("#statusAttendance").val('rejected');
        update($(this).attr('href'), $(this).data('title'));
    });

    function update(href, title) {
        swal({
          title: "Anda yakin akan mengupdate data kehadiran "+ title +" ?",
          text: "Setelah dihapus data tidak dapat dikembalikan !",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willUpdate) => {
          if (willUpdate) {
            $('#updateForm').attr('action', href);
            $('#updateForm').submit();
          }
        });
    }
    </script>
@endsection
