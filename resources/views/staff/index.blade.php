@extends('inc.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Staff</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Staff</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Staff</h3>

          <div class="card-tools">
            <a href="{{route('staff.tambah_staff')}}"><button type="submit" class="btn btn-primary">Tambah Data</button></a>
          </div>
        </div>
        <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Hak Akses</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $no=1; @endphp
                  @foreach ($staffs as $data)
                  <tr>
                    <td>{{$no}}</td>
                    <td>{{ $data->name}}</td>
                    <td>{{ $data->email}}</td>
                    <td>{{ $data->no_telepon}}</td>
                    <td>{{ $data->nama_role}}</td>
                    <td>
                      <button type="button" class="btn btn-info btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">Aksi
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{url('staff/edit_staff/'.$data->id)}}">Edit</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#modal-sm{{ $data->id}}">Hapus</a>
                      </div>
                    </td>
                  </tr>

                  <div class="modal fade" id="modal-sm{{ $data->id}}">
                  <div class="modal-dialog modal-sm{{ $data->id}}">
                    <div class="modal-content">
                      <div class="modal-body">
                        <p>Apakah anda akan menghapus data pengguna?</p>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <a href="{{url('staff/hapus_staff/'.$data->id)}}"><button type="button" class="btn btn-primary" >Konfirmasi</button></a>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->


                  @php $no++; @endphp
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->

              

        <div class="card-footer">
          <!-- Footer -->
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection