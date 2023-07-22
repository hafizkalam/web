@extends('admin.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
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
                                        <th hidden>id</th>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Profile</th>
                                        <th>Description</th>
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
                                            <td>{{ $value->email }}</td>
                                            <td>
                                                <img width="100px" src="{{ url('/profile_users/' . $value->profile) }}">
                                            </td>
                                            <td>{{ $value->desc }}</td>
                                            <td>
                                                <a href="userdelete/{{ $value->id }}/{{ $value->name }}"
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
                <form method="POST" enctype='multipart/form-data' action="user">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Profile Tenant</label>
                            <div class="col-sm-9">
                                <input type="file" name="profile" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Description Tenant</label>
                            <div class="col-sm-9">
                                <input type="text" name="desc" class="form-control">
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
                <form method="POST" id="saveEdit" enctype='multipart/form-data' action="user">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" id="name" class="form-control">
                                <input type="text" name="id" id="id" class="d-none">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Profile</label>
                            <div class="col-sm-9">
                                <input type="file" name="profile" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <input type="text" name="desc" id="desc" class="form-control">
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
            $("#name").val(data[2]);
            $("#email").val(data[3]);
            $("#profile").val(data[4]);
            $("#desc").val(data[5]);
            // alert(data[0]);
        });
    </script>
@endsection
