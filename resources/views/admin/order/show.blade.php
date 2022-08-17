@extends('layouts.admin')

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('orders.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Detail Pesanan</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ route('orders.index') }}">Pesanan</a></div>
          <div class="breadcrumb-item">Detail Pesanan</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                  <h4>Invoice : {{$order->invoice_code }}</h4>
                  <a class="btn btn-primary" href="{{ route('orders.export', $order) }}">Download PDF</a>
                </div>
                <div class="card-body">
                  <div class="row mb-2">
                    <div class="col-md-6">
                      <b>Nama Pegawai</b><br>
                      {{ $order->employee_name }}<br>
                    </div>
                    <div class="col-md-3">
                      <b>Total Harga</b><br>
                      {{ $order->total_harga }}
                    </div>
                    <div class="col-md-3">
                      <b>Status Pesanan</b><br>
                      {!! $order->label_status !!}<br><br>
                    </div>
                  </div>
                </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h4>Data Produk</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <tr>
                      <th>No</th>
                      <th>Nama Produk</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Sub Total</th>
                    </tr>
                    @php $no = 1 @endphp
                    @forelse ($order->details as $detail)
                        <tr >
                            <td>{{ $no }}</td>
                            <td>{{ $detail->product_name }}</td>
                            <td>{{ $detail->harga}}</td>
                            <td>{{ $detail->quantity}}</td>
                            <td>{{ $detail->sub_total_harga}}</td>
                        </tr>
                        @php $no++ @endphp
                    @empty
                    <tr>
                        <td colspan="5" align="center">
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
              </div>
            </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('js')

@endsection
