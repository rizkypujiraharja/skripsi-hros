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
@endsection

