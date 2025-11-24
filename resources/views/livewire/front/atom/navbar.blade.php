<div>
    <nav class="main-navbar">
        <div class="container">
            <ul class="d-flex justify-content-center flex-wrap">
                <li class="menu-item {{ request()->routeIs('front.form.laporan.baru') ? 'active' : '' }}">
                    <a href="{{ route('front.form.laporan.baru') }}" class="menu-link">
                    <span><i class="bi bi-grid-fill"></i> Form Laporan</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('front.list.laporan') ? 'active' : '' }}">
                    <a href="{{ route('front.list.laporan') }}" class="menu-link">
                    <span><i class="bi bi-grid-fill"></i> Data Laporan</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('front.grafik') ? 'active' : '' }}">
                    <a href="{{ route('front.grafik') }}" class="menu-link">
                    <span><i class="bi bi-grid-fill"></i> Grafik Laporan</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>