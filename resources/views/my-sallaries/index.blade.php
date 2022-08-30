@extends('layouts.default')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Slip Gaji</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Slip Gaji</a></div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
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
