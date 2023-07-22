@extends('admin.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Password</h1>
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

                            <form action="{{ url('change-password') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @elseif (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <label for="oldPasswordInput" class="form-label">Old Password</label>
                                        <input name="old_password" type="password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            id="oldPasswordInput" placeholder="Old Password">
                                        @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="newPasswordInput" class="form-label">New Password</label>
                                        <input name="new_password" type="password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            id="newPasswordInput" placeholder="New Password">
                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                                        <input name="new_password_confirmation" type="password" class="form-control"
                                            id="confirmNewPasswordInput" placeholder="Confirm New Password">
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-success">Submit</button>
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
