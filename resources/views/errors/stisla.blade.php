<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>Koprasi Karyawan</title>

<!-- General CSS Files -->
<link rel="stylesheet" href="{{ asset('/stisla-2.2.0/dist/assets/modules/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/stisla-2.2.0/dist/assets/modules/fontawesome/css/all.min.css') }}">

<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('/stisla-2.2.0/dist/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('/stisla-2.2.0/dist/assets/css/components.css') }}">
<style>
    .select2{
        width: 100% !important;
    }
</style>
@yield('css')
</head>

<body>
    <div id="app">
        <section class="section">
          <div class="container mt-5">
            <div class="page-error">
              <div class="page-inner">
                <h1>@yield('code')</h1>
                <div class="page-description">
                    @yield('message')
                </div>
              </div>
            </div>
            <div class="simple-footer mt-5">
              Koprasi Karyawan - PT. Ordivo Teknologi Indonesia
            </div>
          </div>
        </section>
    </div>
</body>


<!-- General JS Scripts -->
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/popper.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/js/stisla.js') }}"></script>

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{ asset('/stisla-2.2.0/dist/assets/js/scripts.js') }}"></script>
<script src="{{ asset('/stisla-2.2.0/dist/assets/js/custom.js') }}"></script>
</body>
</html>
