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
          <div class="breadcrumb-item">Kehadiran</div>
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
                        <li class="nav-item"><a href="#" class="nav-link active">Kehadiran</a></li>
                        <li class="nav-item"><a href="{{ route('users.slip', $user) }}" class="nav-link">Slip Gaji</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                <div class="card-header">
                    <h4>Daftar Kehadiran</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <div>
                            <form action="">
                                <select name="type" class="form-control" onchange="this.form.submit()">
                                    <option value="">Pilih Tipe</option>
                                    <option value="attend" {{ request()->type == 'attend' ? 'selected' : '' }}>Masuk</option>
                                    <option value="permission" {{ request()->type == 'permission' ? 'selected' : '' }}>Izin</option>
                                    <option value="sick" {{ request()->type == 'sick' ? 'selected' : '' }}>Sakit</option>
                                    <option value="not_attend" {{ request()->type == 'not_attend' ? 'selected' : '' }}>Tidak Hadir</option>
                                </select>
                            </form>
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
                            <td>{{ $item->type == 'attend' ? $item->time_in : '-' }}</td>
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

@endsection
