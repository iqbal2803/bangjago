@extends('inc.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Bang-Jago</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Fixed Navbar Layout</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <form action="{{ route('staff.update_staff',$staff->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><b>Edit Data Staff</b></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Nama</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Staff" value="{{$staff->name}}" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Email</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{$staff->email}}" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Password</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>No Telepon</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="no_telepon" id="no_telepon" placeholder="No Telepon" value="{{$staff->no_telepon}}" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Hak Akses</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <select class="form-control" name="role_id" id="role_id">
                          @foreach ($datarole as $data)
                          <option value="{{$data->id}}" @php if($data->id==$staff->role_id) echo "selected" @endphp >{{$data->nama_role}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div>
      </form>
    </section>
    <!-- /.content --> 

  </div>
<!-- /.content-wrapper
  @endsection