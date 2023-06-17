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
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-tambah">
                          Tambah
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;?>
                                @foreach ($data as $value)
                                <?php $no++ ;?>
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>Rp.{{ $value->harga }}</td>
                                    <td><img width="100px" src="{{ url('/picture_menu/'.$value->url) }}"></td>`
                                    <td>
                                        <a href="menudelete/{{ $value->id }}" class="btn btn-danger float-right">Delete</a>

                                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-edit">
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
    <div class="modal-dialog modal-xl">
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
                <label for="inputEmail3" class="col-sm-1 col-form-label">Nama Menu</label>
                <div class="col-sm-11">
                  <input type="text" name="name" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-1 col-form-label">Harga</label>
                <div class="col-sm-11">
                  <input type="text" name="harga" class="form-control">
                </div>
              </div>
              <div class="form-group row">
              <label for="inputEmail3" class="col-sm-1 col-form-label">Foto</label>
              <div class="col-sm-11">
                <input type="file" name="url" class="form-control">
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
    <div class="modal-dialog modal-xl">
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
              <label for="inputEmail3" class="col-sm-1 col-form-label">Nama Menu</label>
              <div class="col-sm-11">
                <input type="text" name="name" id="name" class="form-control">
                <input type="text" name="id" id="id" class="d-none">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-1 col-form-label">Harga</label>
              <div class="col-sm-11">
                <input type="text" name="harga" id="harga" class="form-control">
                <input type="text" name="id" id="id" class="d-none">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-1 col-form-label">Foto</label>
              <div class="col-sm-11">
                <input type="file" name="url" class="form-control">
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
        $("#name").val(data[1]);
        $("#harga").val(data[2]);
        $("#url").val(data[3]);
    });
</script>
@endsection
