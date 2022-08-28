
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Human Resource Information System</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('/stisla-2.2.0/dist/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/stisla-2.2.0/dist/assets/modules/fontawesome/css/all.min.css') }}">

  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('/stisla-2.2.0/dist/assets/modules/bootstrap-social/bootstrap-social.css') }}">
  <link rel="stylesheet" href="{{ asset('/stisla-2.2.0/dist/assets/modules/select2/dist/css/select2.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('/stisla-2.2.0/dist/assets/css/style.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/stisla-2.2.0/dist/assets/css/components.css') }}">

<body class="layout-3">
  <div id="app">
    <div class="main-wrapper container">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <a href="{{ route('app.index') }}"><img src="{{ asset('logo.png') }}" class="navbar-brand sidebar-gone-hide" style="height: 50px;padding:2px"></a>
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        <form class="form-inline ml-auto">
          <ul class="navbar-nav">
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg {{ count($carts) ? 'beep' : '' }}"><i class="fas fa-shopping-cart"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Keranjng Belanja
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
              @foreach ($carts as $item)
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-icon">
                            <img src="{{ $item->product->photo_url }}" alt="" style="width: -webkit-fill-available">
                        </div>
                        <div class="dropdown-item-desc">
                            {{ $item->product->name }}
                            <div class="time text-primary">{{ $item->quantity }} x {{ $item->product->price_rupiah }}</div>
                        </div>
                    </a>
                @endforeach
                </div>
              <div class="dropdown-footer text-center">
                <a href="{{ route('app.cart') }}">Checkout <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ \Auth::user()->photoUrl ?? asset('stisla-2.2.0/dist/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ request()->user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
            {{-- <div class="dropdown-title">Logged in 5 min ago</div> --}}

            <a href="{{ route('profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Setting Profile
            </a>
            {{--
            <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
            </a>
            <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
            </a> --}}
            {{-- <div class="dropdown-divider"></div> --}}
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            </div>
        </li>
        </ul>
      </nav>

      <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="{{ route('app.index') }}" class="nav-link"><i class="fa fa-home"></i><span>Home</span></a>
            </li>
            <li class="nav-item">
              <a href="{{ route('app.orders.index') }}" class="nav-link"><i class="fa fa-shopping-cart"></i><span>Riwayat Pesanan</span></a>
            </li>
            <li class="nav-item">
              <a href="{{ route('app.product') }}" class="nav-link"><i class="fa fa-box"></i><span>Produk</span></a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <div class="main-wrapper">
          <div class="section-body">
            @yield('content')
          </div>
        </section>
      </div>
      @include('layouts.partials._footer')
    </div>
  </div>


<!-- General JS Scripts -->
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/popper.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/chart.min.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/js/stisla.js') }}"></script>

<!-- Plugins -->
 <script src="{{ asset('/stisla-2.2.0/dist/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
 <script src="{{ asset('/stisla-2.2.0/dist/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{ asset('/stisla-2.2.0/dist/assets/js/scripts.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/js/custom.js') }}"></script>
<script type="text/javascript">
    @if(Session::has('alert-success'))
    swal("Success", "{{Session::get('alert-success')}}!", "success", {
      button: "Ok !",
    });
    @elseif(Session::has('alert-error'))
    swal("Error", "{{Session::get('alert-error')}}!", "error", {
      button: "Ok !",
    });
    @endif
</script>
@yield('js')
</body>
</html>
