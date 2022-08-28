<div class="row">
    <div class="col-md-12">
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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Statistik Jam Masuk</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('js')
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["<= 8:30", "08:31 - : 08:45", "08:46 - 09:00", "09:01 - 09:15", "09:16 - 09:30", "> 09:30"],
            datasets: [{
            label: 'Total',
            data: {{ json_encode($stats) }},
            borderWidth: 2,
            backgroundColor: 'rgba(63,82,227,.8)',
            borderWidth: 0,
            borderColor: 'transparent',
            pointBorderWidth: 0,
            pointRadius: 3.5,
            pointBackgroundColor: 'transparent',
            pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
            }]
        },
        options: {
            legend: {
            display: false
            },
            scales: {
            yAxes: [{
                gridLines: {
                    drawBorder: false,
                    color: '#f2f2f2',
                },
                ticks: {
                    beginAtZero: true,
                    stepSize: 1,
                }
            }],
            xAxes: [{
                gridLines: {
                display: false,
                tickMarkLength: 15,
                }
            }]
            },
        }
        });
    </script>
@endsection
