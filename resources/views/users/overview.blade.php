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
          <div class="breadcrumb-item">Overview</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column">
                        <li class="nav-item"><a href="{{ route('users.show', $user) }}" class="nav-link">Profile</a></li>
                        <li class="nav-item"><a href="#" class="nav-link active">Overview</a></li>
                        <li class="nav-item"><a href="{{ route('users.attendances', $user) }}" class="nav-link">Kehadiran</a></li>
                        <li class="nav-item"><a href="{{ route('users.slip', $user) }}" class="nav-link">Slip Gaji</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @include('employee-overview')
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
