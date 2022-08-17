@extends('layouts.default')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Pegawai</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Pegawai</a></div>
          <div class="breadcrumb-item">Tambah Pegawai</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Data Pegawai Baru</h4>
              </div>
              <div class="card-body">
                <form class="form" action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nomor Induk Pegawai</label>
                        <div class="col-sm-6 col-md-9 col-lg-6">
                            <input type="text" value="{{ old('nip') ?? $user->nip }}" name="nip" class="@error('nip') is-invalid @enderror form-control" {{ request()->user()->isKeuangan() ? 'readonly' : '' }}>
                            @error('nip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Lengkap</label>
                        <div class="col-sm-6 col-md-9 col-lg-6">
                            <input type="text" value="{{ old('name') ?? $user->name }}" name="name" class="@error('name') is-invalid @enderror form-control" {{ request()->user()->isKeuangan() ? 'readonly' : '' }}>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Jabatan</label>
                        <div class="col-sm-6 col-md-9 col-lg-6">
                            <select name="jabatan_id" class="form-control" {{ request()->user()->isKeuangan() ? 'readonly' : '' }}>
                                @if(request()->user()->isKeuangan())
                                    @foreach ($jabatans as $jabatan)
                                    @if($jabatan->id == $user->jabatan_id)
                                    <option value="{{ $jabatan->id }}" {{ $jabatan->id == $user->jabatan_id ? 'selected' : ''}}>{{ $jabatan->name }}</option>
                                    @endif
                                    @endforeach
                                @else
                                    <option value="">-- Pilih Jabatan --</option>
                                    @foreach ($jabatans as $jabatan)
                                        <option value="{{ $jabatan->id }}" {{ $jabatan->id == $user->jabatan_id ? 'selected' : ''}}>{{ $jabatan->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('jabatan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Limit Pembelian</label>
                        <div class="col-sm-6 col-md-9 col-lg-6">
                            <input type="number" value="{{ old('limit_balance') ?? $user->limit_balance }}" name="limit_balance" class="@error('limit_balance') is-invalid @enderror form-control">
                            @error('limit_balance')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Alamat</label>
                        <div class="col-sm-6 col-md-9 col-lg-6">
                            <input type="text" value="{{ old('address') ?? $user->address }}" name="address" class="@error('address') is-invalid @enderror form-control" {{ request()->user()->isKeuangan() ? 'readonly' : '' }}>
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Telepon</label>
                        <div class="col-sm-6 col-md-9 col-lg-6">
                            <input type="text" value="{{ old('phone') ?? $user->phone }}" name="phone" class="@error('phone') is-invalid @enderror form-control" {{ request()->user()->isKeuangan() ? 'readonly' : '' }}>
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    @if(!request()->user()->isKeuangan())
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Foto</label>
                        <div class="col-sm-6 col-md-9 col-lg-6">
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="photo" id="image-upload" accept="image/*" />
                            </div>
                            <span class="text-small text-info">*Kosongkan jika tidak ingin diubah</span>
                            @error('photo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Email</label>
                        <div class="col-sm-6 col-md-9 col-lg-6">
                            <input type="text" value="{{ old('email') ?? $user->email }}" name="email" class="@error('email') is-invalid @enderror form-control" {{ request()->user()->isKeuangan() ? 'readonly' : '' }}>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    @if(request()->user()->isAdministrator())
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Role</label>
                        <div class="col-sm-6 col-md-9 col-lg-6">
                            <select name="role" class="@error('role') is-invalid @enderror form-control select2">
                                {{-- <option value="administrator" {{ $user->role == 'adminsitrator' ? 'selected' : '' }}>Administrator</option> --}}
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="keuangan" {{ $user->role == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    @else
                    <input type="hidden" name="role" value="{{ $user->role }}" />
                    @endif

                    @if(!request()->user()->isKeuangan())
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Password</label>
                        <div class="col-sm-6 col-md-9 col-lg-6">
                            <input type="password" name="password" class="@error('password') is-invalid @enderror form-control" {{ request()->user()->isKeuangan() ? 'readonly' : '' }}>
                            <span class="text-small text-info">*Kosongkan jika tidak ingin diubah</span>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right"></label>
                        <div class="col-sm-6 col-md-9 col-lg-6">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
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
