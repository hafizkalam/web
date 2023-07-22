@extends('layoutnew.guest')

@section('content')
    <section id="menu" class="menu">
        <div id="loading-indicator">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Our Menu</h2>
            </div>

            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <?php $n = 0; ?>
                @foreach ($menu_tenant_lama as $key => $judul)
                    <li class="nav-item">
                        @if ($loop->first)
                            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#{{ $key }}">
                                <h4>{{ $judul }}</h4>
                            </a>
                        @else
                            <a class="nav-link " data-bs-toggle="tab" data-bs-target="#{{ $key }}">
                                <h4>{{ $judul }}</h4>
                            </a>
                        @endif

                    </li><!-- End tab nav item -->
                @endforeach
            </ul>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                <?php $n = 0; ?>
                @foreach ($menu_tenant as $key => $menu)
                    <div class="tab-pane fade   <?php if ($n == 0) {
                        echo 'active show';
                    } ?> " id="{{ $key }}">
                        <div class="tab-header text-center">
                            <p>Menu </p>
                        </div>
                        <div class="row gy-5">
                            @foreach ($menu as $value)
                                <div class="col-lg-4 menu-item">
                                    <img src="{{ url('storage/' . $value->foto) }}" class="menu-img img-fluid"
                                        style="height:150px">
                                    <h4>{{ $value->name }}</h4>
                                    <p class="ingredients">
                                        {{ $value->desc }}
                                    </p>
                                    <p class="price">
                                        Rp {{ number_format($value->harga) }}
                                    </p>
                                    <div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary btn-number"
                                                    onClick="jumlah('jumlah{{ $value->id }}','{{ $value->id }}','kurang')"
                                                    data-type="minus"
                                                    style="background-color:#ec2727; color: white;">-</button>
                                            </div>
                                            <input type="text" class="form-control text-center"
                                                id="jumlah{{ $value->id }}" value="0" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary btn-number"
                                                    style="background-color:#ec2727; color: white;"
                                                    onClick="jumlah('jumlah{{ $value->id }}','{{ $value->id }}','tambah')"
                                                    data-type="plus">+</button>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- Menu Item -->
                            @endforeach
                        </div>
                    </div>
                    <?php $n++; ?>
                @endforeach
            </div>

        </div>
    </section><!-- End Menu Section -->
    <!-- Large modal -->
    <div class="modal" id="modal-checkout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content" id="listmenu">

            </div>
        </div>
    </div>
    <div class="modal" id="modal-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-start text-black p-4">
                    <div id="ListOrder"></div>
                </div>
                <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
                    <button type="button" class="btn btn-primary btn-lg mb-1" onClick="PesananDiterima()"
                        style="background-color: #35558a;">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#loading-indicator').hide();

        @foreach ($tmp as $value)
            $("#jumlah{{ $value->id_menu }}").val("{{ $value->qty }}");
        @endforeach
        $("#lblCartCount").load("{{ url('jumlah-pesanan') }}");

        $("#listmenu").load("{{ url('list-pesanan') }}");

        function jumlah(idhasil, idmenu, jenis) {
            var idhasil = idhasil;
            var hasil = $("#" + idhasil).val();
            if (jenis == 'tambah') {
                hasil = parseInt(hasil) + 1;
            } else {
                hasil = parseInt(hasil) - 1;
            }
            if (hasil < 0) {
                hasil = 0;
            }

            $("#" + idhasil).val(hasil);
            if (hasil >= 0) {
                TambahPesanan(hasil, idmenu);
            }
        }

        function Checkout() {
            $("#modal-checkout").modal('show');
        }

        function CloseCheckout() {
            $('#modal-checkout').modal('hide');
        }

        function PesananDiterima() {
            $.confirm({
                title: 'Konfirmasi',
                content: 'Apakah anda yakin ?',
                buttons: {
                    Ya: function() {
                        location.reload();
                    },
                    Tidak: function() {
                        // Code to execute if the user cancels
                        // ...
                    }
                }
            });

        }

        function TambahPesanan(qty, idmenu) {
            var data = {
                'id_menu': idmenu,
                'no_transaksi': '{{ $faktur }}',
                "qty": qty,
                "total": 0
            }
            $('#loading-indicator').show();
            $('button').prop('disabled', true);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                url: "{{ url('tambah-pesanan') }}",
                data: data,
                dataType: "JSON",
                success: function() {

                    $('button').prop('disabled', false);
                    $('#loading-indicator').hide();
                    $("#lblCartCount").load("{{ url('jumlah-pesanan') }}");
                    $("#listmenu").load("{{ url('list-pesanan') }}");
                    if (qty > 0) {
                        toastr.success('Keranjang berhasil diperbarui', 'Berhasil');

                    }
                    //$('.tampildata').load("tampil.php");
                }
            });
        }

        function DeleteDataKeranjang(id_transaksi, id_menu) {
            // alert(id_transaksi + id_menu);
            var data = {
                'id_menu': id_menu,
                'no_transaksi': id_transaksi

            }
            $('#loading-indicator').show();
            $('button').prop('disabled', true);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                url: "{{ url('delete-pesanan') }}",
                data: data,
                dataType: "JSON",
                success: function() {
                    $('#loading-indicator').hide();
                    $('button').prop('disabled', false);

                    $("#lblCartCount").load("{{ url('jumlah-pesanan') }}");
                    $("#listmenu").load("{{ url('list-pesanan') }}");

                    toastr.error('Data berhasil dihapus', 'Berhasil');
                    //$('.tampildata').load("tampil.php");
                }
            });
        }

        function order(fakturs = '') {
            if (fakturs == '') {
                var url = "{{ url('order/') }}";
            } else {
                var url = "{{ url('order/') }}" + "/" + fakturs;
            }
            $('#loading-indicator').show();
            $('button').prop('disabled', true);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'GET',
                url: url,
                dataType: "JSON",
                success: function(data) {
                    $("#ListOrder").html(data.html);
                    $('#loading-indicator').hide();
                    $('button').prop('disabled', false);
                }
            });
        }

        function Bayar() {
            var nama = $("#nama_pemesanan").val();
            var email = $("#email_pemesanan").val();
            var telp = $("#telp_pemesanan").val();
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!emailRegex.test(email)) {
                alert('Email tidak valid');
            } else {
                // UpdateNotes('999999999');
                if (nama != "" && email != "" && telp != "") {
                    $.confirm({
                        title: 'Konfirmasi',
                        content: 'Apakah Anda Yakin?',
                        buttons: {
                            Ya: function() {
                                $('#loading-indicator').show();
                                $('button').prop('disabled', true);

                                $('#modal-checkout').modal('hide');
                                $("#modal-order").modal('show');
                                order();
                                // Code to execute if the user confirms
                                // ...
                            },
                            Tidak: function() {
                                // Code to execute if the user cancels
                                // ...
                            }
                        }
                    });
                } else {
                    alert("Nama,Email,Telp Harus diisikan");
                }
            }


        }

        function UpdateNotes(id) {
            // alert(id);
            var notes = $("#notes" + id).val();

            // var email = $("#email_pemesanan").val();
            // if (email != "") {
            //     var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            //     if (!emailRegex.test(email)) {
            //         alert('Email tidak valid');
            //         $("#email_pemesanan").val("");
            //     }
            // }
            // alert(notes);
            var data = {
                'id': id,
                "notes": notes,
                "nama_pemesanan": $("#nama_pemesanan").val(),
                "email_pemesanan": $("#email_pemesanan").val(),
                "telp_pemesanan": $("#telp_pemesanan").val()
            }
            // $('#loading-indicator').show();
            // $('button').prop('disabled', true);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                url: "{{ url('notes-pesanan') }}",
                data: data,
                dataType: "JSON",
                success: function() {

                    $("#lblCartCount").load("{{ url('jumlah-pesanan') }}");
                    $("#listmenu").load("{{ url('list-pesanan') }}");

                    // toastr.success('Notes berhasil diperbarui', 'Berhasil');
                    //$('.tampildata').load("tampil.php");
                }
            });
        }
    </script>
@endsection
