@extends('layouts.admin')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('products.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Produk</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Produk</a></div>
          <div class="breadcrumb-item">Tambah Produk</div>
        </div>
      </div>
      <form class="form" action="{{ route('products.store') }}" method="POST" id="form-product" enctype="multipart/form-data">
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Data Produk Baru</h4>
              </div>
              <div class="card-body">
                @csrf
                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Produk</label>
                    <div class="col-sm-6 col-md-9 col-lg-6">
                        <input type="text" value="{{ old('name') }}" name="name" class="@error('name') is-invalid @enderror form-control">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Harga</label>
                    <div class="col-sm-6 col-md-9 col-lg-6">
                        <input type="number" min="1000" value="{{ old('price') }}" name="price" class="@error('price') is-invalid @enderror form-control">
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Stock</label>
                    <div class="col-sm-6 col-md-9 col-lg-6">
                        <input type="number" min="0" value="{{ old('stock') }}" name="stock" class="@error('stock') is-invalid @enderror form-control">
                        @error('stock')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Foto</label>
                    <div class="col-sm-6 col-md-9 col-lg-6">
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="photo" id="image-upload" accept="image/*" />
                        </div>
                        @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right"></label>
                    <div class="col-sm-6 col-md-9 col-lg-6">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </form>
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
