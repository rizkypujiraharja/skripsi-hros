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
          <div class="breadcrumb-item">Profile</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column">
                        <li class="nav-item"><a href="#" class="nav-link active">Profile</a></li>
                        <li class="nav-item"><a href="{{ route('users.overview', $user) }}" class="nav-link">Overview</a></li>
                        <li class="nav-item"><a href="{{ route('users.attendances', $user) }}" class="nav-link">Kehadiran</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Slip Gaji</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
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
                                <table class="table table-sm">
                                    <tr>
                                        <td>Nama</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <td>{{ $user->nip }}</td>
                                    </tr>
                                    <tr>
                                        <td>KTP</td>
                                        <td>{{ $user->ktp }}</td>
                                    </tr>
                                    <tr>
                                        <td>NPWP</td>
                                        <td>{{ $user->npwp }}</td>
                                    </tr>

                                    <tr>
                                        <td>Alamat</td>
                                        <td>{{ $user->address }}</td>
                                    </tr>

                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td>{{ $user->birth_date }}</td>
                                    </tr>

                                    <tr>
                                        <td>Divisi</td>
                                        <td>{{ $user->division->name }}</td>
                                    </tr>

                                    <tr>
                                        <td>Posisi</td>
                                        <td>{{ $user->position }}</td>
                                    </tr>

                                    <tr>
                                        <td>Gaji Pokok</td>
                                        <td>{{ $user->sallary_rupiah }}</td>
                                    </tr>

                                    <tr>
                                        <td>Tanggal Mulai Kontrak</td>
                                        <td>{{ $user->joined_at }}</td>
                                    </tr>

                                    <tr>
                                        <td>Tanggal Akhir Kontrak</td>
                                        <td>{{ $user->contract_until ?? '-' }}</td>
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
