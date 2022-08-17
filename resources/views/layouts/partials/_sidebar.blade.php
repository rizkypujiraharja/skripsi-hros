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
        </ul>
    </aside>
</div>