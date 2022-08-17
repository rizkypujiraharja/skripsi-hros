@extends('layouts.admin')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Pegawai</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Pegawai</a></div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Daftar Pegawai</h4>
              </div>
              <div class="card-body">
                <div class="float-left">
                    @if(!request()->user()->isKeuangan())
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pegawai</a>
                    @endif
                </div>
                <div class="float-right">
                  <form action="" method="GET">
                    <div class="input-group">
                      <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request()->search }}">
                      <div class="input-group-append">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="clearfix mb-3"></div>

                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Jabatan</th>
                      @if(request()->user()->isAdministrator())
                      <th>Hak Akses</th>
                      @endif
                      <th>Total Limit</th>
                      <th>Sisa Limit</th>
                      <th>Telephone</th>
                      <th>Email</th>
                      <th>#</th>
                    </tr>
                    @forelse ($users as $item)
                    <tr>
                        <td>{{ (($users->currentPage()-1) * $users->perPage()) + $loop->iteration }}</td>
                        <td>{{ $item->name }}<br>{{ $item->nip }}</td>
                        <td>{{ optional($item->jabatan)->name ?? "-" }}</td>
                        @if(request()->user()->isAdministrator())
                        <td>{{ $item->role }}</td>
                        @endif
                        <td>{{ number_format($item->limit_balance, 0, ',', '.') }}</td>
                        <td>{{ number_format($item->limit_remaining_admin, 0, ',', '.') }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <a href="{{ route('users.show', $item) }}" class="btn btn-sm btn-info"> <span class="fa fa-eye"></span></a>
                            <a href="{{ route('users.edit', $item) }}" class="btn btn-sm btn-warning"> <span class="fa fa-edit"></span></a>

                            @if(!request()->user()->isKeuangan())
                            <span data-title="{{ $item->name }}" href="{{ route('users.destroy', $item) }}" class="btn btn-sm btn-danger btn-delete"> <span class="fa fa-trash"></span></span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" align="center">
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
                  {{ $users->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<form action="" method="POST" id="deleteForm">
    @csrf
    @method('DELETE')
    <input type="submit" style="display: none;">
</form>
@endsection

@section('js')

<script type="text/javascript">
    $('.btn-delete').on('click', function(){
        var href = $(this).attr('href');
        var title = $(this).data('title');
        swal({
          title: "Anda yakin akan menghapus pegawai bernama "+ title +" ?",
          text: "Setelah dihapus data tidak dapat dikembalikan !",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $('#deleteForm').attr('action', href);
            $('#deleteForm').submit();
          }
        });
    });
    </script>
@endsection
