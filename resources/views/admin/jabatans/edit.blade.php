@extends('layouts.admin')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('jabatans.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Edit Jabatan</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Jabatan</a></div>
          <div class="breadcrumb-item">Edit Jabatan</div>
        </div>
      </div>
      <form class="form" action="{{ route('jabatans.update', $jabatan) }}" method="POST" id="form-jabatan" enctype="multipart/form-data">
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Edit Jabatan: {{ $jabatan->name }}</h4>
              </div>
              <div class="card-body">
                @csrf
                @method('PUT')
                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Jabatan</label>
                    <div class="col-sm-6 col-md-9 col-lg-6">
                        <input type="text" value="{{ old('name', $jabatan->name) }}" name="name" class="@error('name') is-invalid @enderror form-control">
                        @error('name')
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
