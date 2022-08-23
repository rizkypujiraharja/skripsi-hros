<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <img alt="image" src="{{ $user->photo_url }}" class="img-fluid" data-toggle="tooltip" title="" data-original-title="Danny Stenvenson">
                <div class="text-center mt-4">
                    <h6 class="mb-0">{{ $user->name }}</h6>
                    <small>{{ $user->email }}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Sisa Cuti</h4>
                  </div>
                  <div class="card-body">
                    {{ $total['remain_paid_leave'] }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-hospital"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Sakit</h4>
                  </div>
                  <div class="card-body">
                    {{ $total['sick'] }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Izin</h4>
                  </div>
                  <div class="card-body">
                    {{ $total['permission'] }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-times"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Tidak Hadir</h4>
                  </div>
                  <div class="card-body">
                    {{ $total['not_present'] }}
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
