@extends('layouts.default')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Detail Pegawai</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Pegawai</a></div>
          <div class="breadcrumb-item">Detail Pegawai</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Data Pegawai</h4>
              </div>
              <div class="card-body">
                <div class="row">
                    @if($user->photo_url)
                    <div class="col-md-4">
                        <center>
                        <img src="{{ $user->photo_url }}" class="img-fluid">
                        </center>
                    </div>
                    @endif
                    <div class="col-md-8">
                        <table class="table">
                            <tr><td>{{ $user->name }}</td></tr>
                            <tr><td>{{ $user->nip }}</td></tr>
                            <tr><td>{{ optional($user->jabatan)->name ?? "-" }}</td></tr>
                            <tr><td>{{ $user->phone }}</td></tr>
                            <tr><td>{{ $user->email }}</td></tr>
                            <tr><td>{{ $user->address }}</td></tr>
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
