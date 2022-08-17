@extends('layouts.admin')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Jabatan</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Jabatan</a></div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Daftar Jabatan</h4>
              </div>
              <div class="card-body">
                <div class="float-left">
                    <a href="{{ route('jabatans.create') }}" class="btn btn-primary">Tambah Jabatan</a>
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
                        <th>#</th>
                    </tr>
                    @forelse ($jabatans as $item)
                    <tr>
                        <td>{{ (($jabatans->currentPage()-1) * $jabatans->perPage()) + $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="{{ route('jabatans.edit', $item) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Jabatan"> <span class="fa fa-edit"></span></a>
                            <span data-title="{{ $item->name }}" href="{{ route('jabatans.destroy', $item) }}" class="btn btn-sm btn-danger btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus Jabatan"> <span class="fa fa-trash"></span></span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" align="center">
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
                  {{ $jabatans->links() }}
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
          title: "Anda yakin akan menghapus Jabatan bernama "+ title +" ?",
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
