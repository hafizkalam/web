@extends('admin.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Menu</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                data-target="#modal-tambah">
                                Tambah
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th hidden> id</th>
                                        <th>No</th>
                                        <th>Nama Menu</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Description</th>
                                        <th>Ketersedian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    @foreach ($data as $value)
                                        <?php $no++; ?>
                                        <tr>
                                            <td hidden>{{ $value->id }}</td>
                                            <td>{{ $no }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ number_format($value->harga) }}</td>
                                            <td><img width="100px" src="{{ url('storage/' . $value->foto) }}">
                                            </td>
                                            <td>{{ $value->desc }}</td>
                                            <td><input type="checkbox" name="my-checkbox"
                                                    @if ($value->status) checked @endif
                                                    id="{{ $value->id }}" data-off-color="danger" data-on-color="success"
                                                    data-on-text="Tersedia" data-off-text="Habis" data-bootstrap-switch>
                                            </td>
                                            <td>
                                                <a href="menudelete/{{ $value->id }}"
                                                    class="btn btn-danger float-right">Delete</a>

                                                <button type="button" class="btn btn-primary float-right"
                                                    data-toggle="modal" data-target="#modal-edit">
                                                    Edit
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" enctype='multipart/form-data' action="menu">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Menu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Menu</label>
                            <div class="col-sm-9">
                                <input type="text" name="name_menu" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="text" name="harga_menu" class="form-control" id="harga">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                                <input type="file" name="foto_menu" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="desc_menu"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between bg-light">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" id="saveEdit" enctype='multipart/form-data' action="menu">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Menu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Menu</label>
                            <div class="col-sm-9">
                                <input type="text" name="name_menu" id="name_menu" class="form-control">
                                <input type="text" name="id" id="id" class="d-none">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="text" name="harga_menu" id="harga_menu" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                                <input type="file" name="foto_menu" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <input type="text" name="desc_menu" id="desc_menu" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between bg-light">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="edit" class="btn btn-primary">Save </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
    <script>
        $("#example1").DataTable();
        $('#example1 tbody').on('click', 'tr', function() {
            var table = $('#example1').DataTable();
            var data = table.row(this).data();
            $("#id").val(data[0]);
            $("#name_menu").val(data[2]);
            $("#harga_menu").val(data[3]);
            $("#foto_menu").val(data[4]);
            $("#desc_menu").val(data[5]);
            // alert(data[2]);
        });
        $("#harga").on("change", function() {
            $("#harga").val(formatRupiah(this.value));
        });
        $("#harga_menu").on("change", function() {
            $("#harga_menu").val(formatRupiah(this.value));
        });



        function StatusMenu(id) {
            var isChecked = $(this).prop("checked");
            alert(id);
        }
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $("input[data-bootstrap-switch]").on("switchChange.bootstrapSwitch", function(event, state) {
            // state parameter represents the new state of the switch (true for checked, false for unchecked)
            var data = {
                'status': state,
                'id': this.id
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                url: "{{ url('status-menu') }}",
                data: data,
                dataType: "JSON",
                success: function() {

                    //$("#lblCartCount").load("{{ url('jumlah-pesanan') }}");
                    //$("#listmenu").load("{{ url('list-pesanan') }}");

                    // toastr.error('Data berhasil dihapus', 'Berhasil');
                    //$('.tampildata').load("tampil.php");
                }
            });
        });
    </script>
@endsection
