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
      <form action="{{ route('role.update_role',$role->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><b>Edit Data Role</b></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Nama Role</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="nama_role" id="nama_role" placeholder="Nama Role" value="{{ $role->nama_role }}" required="">
                      </div>
                    </div>
                    @php
                        $permissions = json_decode($role->permission);
                    @endphp
                    <div class="row">
                      <div class="col-sm-3" style="padding-top: 10px;padding-left: 30px;">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="permission1" name="permission[]" value="1" @php if(in_array(1, $permissions)) echo "checked"; @endphp>
                          <label class="custom-control-label" for="permission1">Data Pelanggan</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3" style="padding-top: 10px;padding-left: 30px;">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="permission2" name="permission[]" value="2" @php if(in_array(2, $permissions)) echo "checked"; @endphp>
                          <label class="custom-control-label" for="permission2">Pengaturan Bank</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3" style="padding-top: 10px;padding-left: 30px;">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="permission3" name="permission[]" value="3" @php if(in_array(3, $permissions)) echo "checked"; @endphp>
                          <label class="custom-control-label" for="permission3">Pengaturan Tagihan</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3" style="padding-top: 10px;padding-left: 30px;">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="permission4" name="permission[]" value="4" @php if(in_array(4, $permissions)) echo "checked"; @endphp>
                          <label class="custom-control-label" for="permission4">Riwayat Transaksi</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3" style="padding-top: 10px;padding-left: 30px;">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="permission5" name="permission[]" value="5" @php if(in_array(5, $permissions)) echo "checked"; @endphp>
                          <label class="custom-control-label" for="permission5">Laporan</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3" style="padding-top: 10px;padding-left: 30px;">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="permission6" name="permission[]" value="6" @php if(in_array(6, $permissions)) echo "checked"; @endphp>
                          <label class="custom-control-label" for="permission6">Data Cabang</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3" style="padding-top: 10px;padding-left: 30px;">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="permission7" name="permission[]" value="7" @php if(in_array(7, $permissions)) echo "checked"; @endphp>
                          <label class="custom-control-label" for="permission7">Pengaturan Staff</label>
                        </div>
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