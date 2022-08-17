@extends('layouts.default')
@section('css')
<style type="text/css">
    .card-recent {
      height: 250px;
    }
</style>
@endsection
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Koperasi Karyawan</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div style="margin-top: 20vh">
                            <center>
                                <img src="{{ asset('logo.png') }}" style="width:300px;margin-bottom:35px">
                                <hr>
                                <p style="font-size: 14pt">
                                    PT. Ordivo Teknologi Indonesia adalah salah satu perusahaan tekstil yang berdiri sejak tahun 1964 di Bandung.
                                    Orientasi produk kami yang sebagian besar adalah ekspor, menjadikan kami terus mengembangkan diri baik dari kualitas produk yang dihasilkan
                                    maupun sumber daya manusia yang menjadi motor penggerak.
                                </p>
                                <p>Jl. Moh. Toha Jl. Cisirung No.KM 6.8, Pasawahan, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa Barat 40256</p>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
