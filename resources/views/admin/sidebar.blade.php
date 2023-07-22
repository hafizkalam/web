<li class="nav-item">
    <a href="{{ url('dashboard') }}" class="nav-link" id="dashboard">
        <i class="nav-icon fas fa-home"></i>
        <p>
            Home
        </p>
    </a>
</li>

@if (Auth::user()->level == '1')
    <li class="nav-item">
        <a href="{{ url('web') }}" class="nav-link" id="web">
            <i class="nav-icon fas fa-light fa-house-user"></i>
            <p>
                Web
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('meja') }}" class="nav-link" id="meja">
            <i class="nav-icon fas fa-solid fa-qrcode"></i>
            <p>
                Meja
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('tenant') }}" class="nav-link" id="tenant">
            <i class="nav-icon fas fa-light fa-store"></i>
            <p>
                Tenant
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('transaksi') }}" class="nav-link" id="transaksi">
            <i class="nav-icon fas fa-solid fa-shopping-cart"></i>
            <p>
                Transaksi
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('user') }}" class="nav-link" id="user">
            <i class="nav-icon fas fa-duotone fa-users"></i>
            <p>
                User
            </p>
        </a>
    </li>
@elseif(Auth::user()->level == '2')
    <li class="nav-item">
        <a href="{{ url('info-tenant') }}" class="nav-link" id="info">
            <i class="nav-icon fas fa-solid fa-user"></i>
            <p>
                Info
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('transaksi') }}" class="nav-link" id="transaksi">
            <i class="nav-icon fas fa-solid fa-shopping-cart"></i>
            <p>
                Transaksi
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('menu') }}" class="nav-link" id="menu">
            <i class="nav-icon fas fa-solid fa-bars"></i>
            <p>
                Menu
            </p>
        </a>
    </li>
@else
    <li class="nav-item">
        <a href="{{ url('transaksi') }}" class="nav-link" id="transaksi">
            <i class="nav-icon fas fa-solid fa-shopping-cart"></i>
            <p>
                Transaksi
            </p>
        </a>
    </li>
@endif
<li class="nav-item">
    <a href="{{ url('change-password') }}" class="nav-link" id="password">
        <i class="nav-icon fas fa-key"></i>
        <p>
            Change Password
        </p>
    </a>
</li>
