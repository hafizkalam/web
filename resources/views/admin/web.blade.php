@extends('admin.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Website</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Website</li>
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
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->description }}</td>
                                            <td>
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

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form method="POST" id="saveEdit" enctype='multipart/form-data' action="web">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Website</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-1 col-form-label">Description</label>
                            <div class="col-sm-11">
                                <input type="text" name="description" id="description" class="form-control">
                                <input type="text" name="name" id="name" class="d-none">
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
        $("#example1").DataTable({
            responsive: true
        });
        $('#example1 tbody').on('click', 'tr', function() {
            var table = $('#example1').DataTable();
            var data = table.row(this).data();
            $("#description").val(data[2]);
            $("#name").val(data[1]);
        });
    </script>
@endsection
