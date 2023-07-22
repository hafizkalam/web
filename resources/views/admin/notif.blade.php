<a class="nav-link" href="{{ url('transaksi') }}">
    <i class="far fa-bell"></i>
    @if ($total > 0)
        <span class="badge badge-warning navbar-badge">{{ $total }}</span>
    @endif
</a>
