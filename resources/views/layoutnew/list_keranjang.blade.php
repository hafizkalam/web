<div class="modal-header border-bottom-0">
    <h5 class="modal-title" id="exampleModalLabel">
        Keranjang Pesanan
    </h5>
    <button type="button" class="close" onclick="CloseCheckout()" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" id="listmenu">
    <table class="table table-image">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total Harga</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $qty = $harga = $totalHarga = 0;
            ?>
            @foreach ($tmp as $value)
                <?php
                $qty += $value->qty;
                $harga += $value->menu->harga;
                $totalHarga += $value->menu->harga * $value->qty;
                ?>

                <tr>
                    <td style="vertical-align: middle;">{{ $value->menu->name }} </td>
                    <td style="vertical-align: middle;">Rp {{ number_format($value->menu->harga) }}
                    </td>
                    <td>
                        <div class="form-inline">
                            <div class="form-group mb-2">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-outline-secondary btn-number"
                                        onClick="jumlah('jumlah{{ $value->menu->id }}','{{ $value->menu->id }}','kurang')"
                                        data-type="minus" style="background-color:#ec2727; color: white;">-</button>
                                </div>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control text-center" id="jumlah{{ $value->id }}"
                                    value="{{ $value->qty }}" readonly>
                            </div>

                            <div class="form-group mb-2">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary btn-number"
                                        style="background-color:#ec2727; color: white;"
                                        onClick="jumlah('jumlah{{ $value->menu->id }}','{{ $value->menu->id }}','tambah')"
                                        data-type="plus">+</button>
                                </div>
                            </div>

                        </div>


                    </td>
                    <td style="vertical-align: middle;">Rp
                        {{ number_format($value->menu->harga * $value->qty) }}</td>

                    <td style="vertical-align: middle;" class="qty">
                        <input type="text" class="form-control" id="notes{{ $value->id }}"
                            onBlur="UpdateNotes('{{ $value->id }}')" value="{{ $value->notes }}">
                    </td>
                    <td style="vertical-align: middle;">
                        <button class="btn btn-danger btn-sm"
                            onclick="DeleteDataKeranjang('{{ $value->no_transaksi }}','{{ $value->id_menu }}')">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <th>Total</th>
                <th style="vertical-align: middle;">Rp {{ number_format($harga) }}</th>
                <th style="vertical-align: middle;">{{ number_format($qty) }}</th>
                <th style="vertical-align: middle;">Rp {{ number_format($totalHarga) }}</th>
                <th colspan="2"></th>
            </tr>
        </tfoot>

    </table>

</div>
<div class="modal-footer border-top-0 d-flex justify-content-between">

    <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick='CloseCheckout()'>Close</button>

    <div class="form-group row">
        <div class="col-sm-12">
            <input type="text" name="nama" id="nama_pemesanan" value="{{ $nama_pemesanan }}"
                placeholder="Masukkan Nama" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <input type="email" name="email" id="email_pemesanan" value="{{ $email_pemesanan }}"
                placeholder="Masukkan Email" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <input type="number" name="noTelp" value="{{ $telp_pemesanan }}" id="telp_pemesanan"
                placeholder="Masukkan No Telefon" onblur="UpdateNotes('99999999')" class="form-control">
        </div>
    </div>

    <div>
        <button type="button" class="btn btn-primary" onClick="Bayar()"><i class="fa fa-money-bill"></i>
            Cash</button>
        <button type="button" class="btn btn-success" id="pay-button"><i class="fa fa-credit-card"></i>
            Online
            Payment</button>
    </div>

</div>

<script>
    $('#loading-indicator').hide();
    $('button').prop('disabled', false);
    @if ($totalHarga <= 0)
        $("#tombolCheckout").prop('disabled', true);
    @endif
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        var nama = $("#nama_pemesanan").val();
        var email = $("#email_pemesanan").val();
        var telp = $("#telp_pemesanan").val();

        if (nama != "" && email != "" && telp != "") {
            window.snap.pay('{{ $snap_token }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */

                    $('#modal-checkout').modal('hide');
                    $("#modal-order").modal('show');
                    order(result.order_id);
                    // $("#ListOrder").load("{{ url('order/') }}" + "/" + );
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        } else {
            alert("Nama,Email,Telp Harus diisikan");
        }
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token

    });
</script>
