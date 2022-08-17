@extends('layouts.admin')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('products.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Detail Produk</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Produk</a></div>
          <div class="breadcrumb-item">Detail Produk</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Data Produk</h4>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <center>
                        <img src="{{ $product->photo_url }}" class="img-fluid">
                        </center>
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <td>Kode Produk</td>
                                <td>{{ $product->code }}</td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>{{ $product->price_rupiah }}</td>
                            </tr>
                            <tr>
                                <td>Stok</td>
                                <td>{{ $product->stock }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('js')
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
<script>
    $.uploadPreview({
        input_field: "#image-upload",   // Default: .image-upload
        preview_box: "#image-preview",  // Default: .image-preview
        label_field: "#image-label",    // Default: .image-label
        label_default: "Pilih Foto",   // Default: Choose File
        label_selected: "Ganti Foto",  // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
    });
  </script>
@endsection
