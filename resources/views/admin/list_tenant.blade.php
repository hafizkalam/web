@extends('admin.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Tenant</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">List Tenant</li>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Desc</th>
                                        <th>Profile</th>
                                        <th>Nonaktifkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    @foreach ($data as $value)
                                        <?php $no++; ?>
                                        <tr>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->desc }}</td>
                                            <td><img width="100px" src="{{ url('storage/' . $value->foto) }}">
                                            </td>
                                            <td><input type="checkbox" name="my-checkbox"
                                                    @if ($value->status != 2) checked @endif
                                                    id="{{ $value->id }}" data-off-color="danger" data-on-color="success"
                                                    data-on-text="Tidak" data-off-text="Ya" data-bootstrap-switch>
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
                url: "{{ url('blokir-tenant') }}",
                data: data,
                dataType: "JSON",
                success: function() {

                }
            });
        });
    </script>
@endsection
