<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('index') }}"><img src="{{ asset('logo.png') }}" class="logo-l" style="height: 35px;"></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('index') }}"><img src="{{ asset('icon.png') }}" class="logo-m" style="width: 46px"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('/') ? 'active' : '' }}"><a class="nav-link" href="{{ route('index') }}"><i class="fas fa-th-large"></i> <span>Dashboard</span></a></li>
            @if(auth()->user()->isHrd())
            <li class="{{ request()->is('users*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i> <span>Data Pegawai</span></a></li>
            <li class="{{ request()->is('attendances*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('attendances.index') }}"><i class="fas fa-calendar"></i> <span>Data Kehadiran</span></a></li>
            @endif

            @if(auth()->user()->isFinance())
            <li class="{{ request()->is('salaries*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('sallaries.index') }}"><i class="fas fa-dollar-sign"></i> <span>Penggajian</span></a></li>
            @endif

            <li class="{{ request()->is('my-attendances') ? 'active' : '' }}"><a class="nav-link" href="{{ route('my-attendances.index') }}"><i class="fas fa-sign-in-alt"></i> <span>Absensi</span></a></li>
        </ul>
    </aside>
</div>
