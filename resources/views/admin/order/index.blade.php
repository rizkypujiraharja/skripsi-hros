@extends('layouts.admin')

@php
    $auth = request()->user();
@endphp

@section('css')
<link rel="stylesheet" href="{{asset('/stisla-2.2.0/dist/assets/modules/bootstrap-daterangepicker/daterangepicker.css')}}">
@endsection
@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Pesanan</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Pesanan</a></div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Daftar Pesanan</h4>
              </div>
              <div class="card-body">
                <div class="float-left d-flex">
                    <button onclick="report()" class="btn btn-info">Laporan Pesanan</button>
                </div>
                <div class="float-right">
                  <form action="" method="GET" >
                    <div class="input-group">
                      @if(request()->daterange)
                        @php
                        $daterange=explode(" - ", request()->daterange);
                        $date_from = \Carbon\Carbon::createFromFormat('d/m/Y', $daterange[0]);
                        $date_to = \Carbon\Carbon::createFromFormat('d/m/Y', $daterange[1]);

                        $from = $date_from->format('d/m/Y');
                        $to = $date_to->format('d/m/Y');
                        @endphp
                        <input type="text" class="form-control daterange-cus mr-2" name="daterange" id="daterange" value="{{ $from }} - {{ $to }}">
                      @else
                      <input type="text" class="form-control daterange-cus mr-2" name="daterange" id="daterange" value="{{ date('d/m/Y', strtotime('-1 months'))}} - {{date("d/m/Y")}}">
                      @endif
                      <input type="text" class="form-control" name="search" placeholder="Search" id="search" value="{{ request()->search }}">
                      <div class="input-group-append">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="clearfix mb-3"></div>

                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th>No</th>
                      <th>Kode Pesanan</th>
                      <th>Nama Pemesan</th>
                      <th>Total Harga</th>
                      <th>Status</th>
                      <th>Tanggal Pengajuan</th>
                      <th>#</th>
                    </tr>
                    @forelse ($orders as $item)
                    <tr>
                        <td>{{ (($orders->currentPage()-1) * $orders->perPage()) + $loop->iteration }}</td>
                        <td>{{ $item->invoice_code }}</td>
                        <td>{{ $item->employee_name }}</td>
                        <td>{{ $item->total_harga }}</td>
                        <td align="center">{!! $item->label_status !!}</td>
                        <td>{{ $item->tanggal_pesan }}</td>
                        <td>
                            <a href="{{ route('orders.show', $item) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Pesanan"> <span class="fa fa-eye"></span></a>

                            @if(!$item->isFinished() && !$item->isCanceled() && !$item->isRejected())
                                {{-- Batalkan Pesanan --}}
                                {{-- <span class="btn btn-sm btn-warning btn-status" href="{{ route('orders.change-status', $item) }}" data-toggle="tooltip" data-placement="top" data-action="4" data-title="Batalkan Pesanan"> <span class="fa fa-undo"></span></span> --}}

                                @if($item->isWaiting() && $auth->isAdministrator())
                                {{-- Siapkan Pesanan --}}
                                <span class="btn btn-sm btn-primary btn-status" href="{{ route('orders.change-status', $item) }}" data-total="{{ $item->total_harga }}" data-limit="{{ number_format($item->user->limit_remaining_admin, 0, ',', '.') }}" data-toggle="tooltip" data-placement="top" data-action="1" data-title="Terima Pesanan"> <span class="fa fa-check"></span></span>
                                @endif

                                @if($item->isProcessing() && ($auth->isAdmin() || $auth->isAdministrator()))
                                {{-- Tandai Siap Diambil --}}
                                <span class="btn btn-sm btn-primary btn-status" href="{{ route('orders.change-status', $item) }}" data-toggle="tooltip" data-placement="top" data-action="2" data-title="Tandai Siap Diambil"> <span class="fa fa-box"></span></span>
                                @endif


                                @if($item->isReady() && ($auth->isAdmin() || $auth->isAdministrator()))
                                {{-- Tandai Selesai --}}
                                <span class="btn btn-sm btn-primary btn-status" href="{{ route('orders.change-status', $item) }}" data-toggle="tooltip" data-placement="top" data-action="3" data-title="Tandai Selesai"> <span class="fa fa-hands"></span></span>
                                @endif

                                @if($item->isWaiting() && $auth->isAdministrator())
                                {{-- Tolak Pesanan --}}
                                    <span class="btn btn-sm btn-danger btn-status" href="{{ route('orders.change-status', $item) }}" data-toggle="tooltip" data-placement="top" data-action="5" data-title="Tolak Pesanan"> <span class="fa fa-times"></span></span>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" align="center">
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
                <div class="float-right">
                  {{ $orders->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<form action="" method="POST" id="changeStatusForm">
    @csrf
    @method('PATCH')
    <input type="hidden" name="status" id="selectedStatus">
    <input type="submit" style="display: none;">
</form>
@endsection

@section('js')
<script src="{{asset('/stisla-2.2.0/dist/assets/modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript">
  $('.daterange-cus').daterangepicker({
    locale: {format: 'DD/MM/YYYY'},
    drops: 'down',
    opens: 'left'
  });

</script>
<script type="text/javascript">
    $('.btn-status').on('click', function(){
        var href = $(this).attr('href');
        var title = $(this).data('title');
        var action = $(this).data('action');
        var message = "Status tidak dapat dikembalikan"

        $("#selectedStatus").val(action);
        if(action == '1') {
            var total = $(this).data('total');
            var limit = $(this).data('limit');
            message = "Sisa limit belanja Rp. " + limit + " . Total belanja " + total
        }

        swal({
          title: title + "?",
          text: message,
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((changeStatus) => {
          if (changeStatus) {
            $('#changeStatusForm').attr('action', href);
            $('#changeStatusForm').submit();
          }
        });
    });

    function submitForm()
    {
        console.log('change')
    }
    function report(){
        daterange = $('#daterange').val()
        search = $('#search').val()
        url = `{{url('orders')}}/report?daterange=${daterange}&search=${search}`
        window.location = url
    }
    </script>
@endsection
