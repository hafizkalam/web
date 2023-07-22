@extends('admin.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Meja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Meja</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <form class="form-inline" action="create" method="POST">
                            @csrf
                            <div class="form-group mb-8">
                                <input type="text" class="form-control" name="no_meja"
                                    placeholder="Tambahkan Nomor Meja">
                            </div>
                            <button type="submit" class="btn btn-primary ml-1 mb-2">Create</button>
                        </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Meja</th>
                                    <th>QR code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @foreach ($meja as $value)
                                    <?php $no++; ?>
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $value->no_meja }}</td>
                                        <td>
                                            <a href="{{ 'qrcode/' . $value->id }}" class="btn btn-primary"
                                                target="blank">Generate</a>
                                        </td>
                                        <td>
                                            <a href="mejadelete/{{ $value->id }}"
                                                class="btn btn-danger float-right">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
@endsection

@section('script')
    <script>
        $("#example1").DataTable();
    </script>
@endsection
