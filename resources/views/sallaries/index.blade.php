@extends('layouts.default')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Penggajian</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Penggajian</a></div>
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
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalImport">
                                Proses
                            </button>
                            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalExport">
                                Export
                            </button>
                        </div>

                        <form action="" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request()->search }}">
                                <div class="input-group-append">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="clearfix mb-3"></div>

                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th>ID</th>
                      <th>Pegawai</th>
                      <th>Periode</th>
                      <th>Jumlah Pendapatan</th>
                      <th>Jumlah Potongan</th>
                      <th>Gaji Bersih</th>
                      <th>#</th>
                    </tr>
                    @forelse ($sallaries as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->name }}</td>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalImport">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Data Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sallaries.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Dari</label>
                        <div class="col-md-9">
                            <input type="file" name="file" required class="form-control">
                        </div>
                    </div>

                    <center>
                        <a class="btn btn-success mt-2" href="{{ route('sallaries.sample') }}">Download Form</a>
                        <button class="btn btn-primary mt-2" type="submit">Import</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalExport">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Data Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sallaries.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Bulan</label>
                        <div class="col-md-9">
                            <select name="month" class="form-control">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-md-3 text-md-right">Tahun</label>
                        <div class="col-md-9">
                            <input type="number" name="year" value="{{ date('Y') }}" required class="form-control">
                        </div>
                    </div>

                    <center>
                        <button class="btn btn-primary mt-2" type="submit">Export</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript">
</script>
@endsection
