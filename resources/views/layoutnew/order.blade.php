@if ($cara_pembayaran == 'offline')
    <h5 class="modal-title text-uppercase mb-5" id="exampleModalLabel">No Meja {{ $no_meja }}</h5>
    <h4 class="mb-5" style="color: #35558a;">Thanks for your order</h4>
    <p class="mb-5" style="color: #35558a;">Pesanan Akan Diproses Setelah Anda Menyelesaikan Pembayaran
        di Kasir</p>
    <p class="mb-5" style="color: #35558a;">Silahkan Tunjukkan ke Kasir</p>
    <p class="mb-0" style="color: #35558a;">List Pesanan</p>
    <hr class="mt-2 mb-4"
        style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
@else
    <h5 class="modal-title text-uppercase mb-5" id="exampleModalLabel">No Meja {{ $no_meja }}</h5>
    <h4 class="mb-5" style="color: #35558a;">Thanks for your order</h4>
    <p class="mb-0" style="color: #35558a;">List Pesanan</p>
    <hr class="mt-2 mb-4"
        style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
@endif

<div class="d-flex justify-content-between">
    <p class="fw-bold mb-0">No Pesanan</p>
    <p class="text-muted mb-0">{{ $faktur }}</p>
</div>

<?php
$total = 0;
?>
@foreach ($tmp as $value)
    <?php $total += $value->total; ?>
    <div class="d-flex justify-content-between">
        <p class="small mb-0">{{ $value->menu->name }}</p>
        <p class="small mb-0">{{ number_format($value->total) }}</p>
    </div>
@endforeach

<div class="d-flex justify-content-between">
    <p class="fw-bold">Total</p>
    <p class="fw-bold" style="color: #35558a;">{{ number_format($total) }}</p>
</div>

<div class="d-flex justify-content-center" id="statusOrder">

    <span class="badge badge-primary">Menuggu Otorisasi</span>
</div>
<script>
    setInterval(function() {
        cekStatus();
    }, 3000);

    function cekStatus() {
        $("#statusOrder").load("{{ url('order-status/' . $faktur) }}");
    }
    // $('#loading-indicator').hide();
    // $('button').prop('disabled', false);
</script>
