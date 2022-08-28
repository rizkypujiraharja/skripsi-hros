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
            <div class="section-header d-flex justify-content-between">
                <h1>Dashboard</h1>
                <span>{{ $period }}</span>
            </div>

            <div class="section-body">
                @include('employee')
            </div>
        </section>
    </div>
@endsection
