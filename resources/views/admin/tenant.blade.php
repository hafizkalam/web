@extends('admin.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Info Tenant</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card card-info">
                            <form class="form-horizontal" action="{{ url('edit-tenant') }}" enctype='multipart/form-data'
                                method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $tenant->name }}" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-4 col-form-label">Deskripsi</label>
                                        <div class="col-sm-8">
                                            <textarea name="desc" class="form-control">{{ $tenant->desc }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-4 col-form-label">Profile</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="profile" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-4 col-form-label">Status Tenant</label>
                                        <div class="col-sm-8">
                                            @if ($tenant->status != 2)
                                                <input type="checkbox" name="status"
                                                    @if ($tenant->status) checked @endif data-off-color="danger"
                                                    data-on-color="success" data-on-text="Buka" data-off-text="Tutup"
                                                    data-bootstrap-switch>
                                            @endif
                                            @if ($tenant->status == 2)
                                                Terblokir
                                                <input type="text" class="d-none" name="status" value="2">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Simpan</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- /.card-body -->

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
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
@endsection
