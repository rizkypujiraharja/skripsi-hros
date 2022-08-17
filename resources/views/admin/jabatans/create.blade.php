@extends('layouts.admin')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('jabatans.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Jabatan</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Jabatan</a></div>
          <div class="breadcrumb-item">Tambah Jabatan</div>
        </div>
      </div>
      <form class="form" action="{{ route('jabatans.store') }}" method="POST" id="form-product" enctype="multipart/form-data">
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Data Jabatan Baru</h4>
              </div>
              <div class="card-body">
                @csrf
                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Jabatan</label>
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
