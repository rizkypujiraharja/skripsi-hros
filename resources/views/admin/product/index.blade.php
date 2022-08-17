@extends('layouts.admin')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Produk</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Produk</a></div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Daftar Produk</h4>
              </div>
              <div class="card-body">
                <div class="float-left">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
                    <button onclick="report()" class="btn btn-info">Laporan Stok Produk</button>
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
                        <th>Foto</th>
                        <th>Kode Produk</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>#</th>
                    </tr>
                    @forelse ($products as $item)
                    <tr>
                        <td>{{ (($products->currentPage()-1) * $products->perPage()) + $loop->iteration }}</td>
                        <td><img src="{{ $item->photo_url }}" alt="" srcset="" style="height: 25px"></td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price_rupiah }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>
                            <a href="{{ route('products.show', $item) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Produk"> <span class="fa fa-eye"></span></a>
                            <a href="{{ route('products.edit', $item) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Produk"> <span class="fa fa-edit"></span></a>
                            <span data-title="{{ $item->name }}" href="{{ route('products.destroy', $item) }}" class="btn btn-sm btn-danger btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus Produk"> <span class="fa fa-trash"></span></span>
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
                  {{ $products->links() }}
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
          title: "Anda yakin akan menghapus Produk bernama "+ title +" ?",
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

    function report(){
        url = `{{url('products')}}/report`
        window.location = url
    }
    </script>
@endsection
