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
        <form action="{{ route('profil.update_profil') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><b>Edit Data Profil</b></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form">
                  <div class="card-body">
                    <div class="row">
                      <div class="position-relative row form-group justify-content-center col-sm-12">
                        <div class="col-sm-2">
                          <img src="{{ asset('assets_admin/images/profil/'.$profil->logo_profil) }}" width="100px" height="100px" class="radius-10 bd-placeholder-img mb-2" alt="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-auto">
                        <!-- select -->
                        <div class="form-group">
                          <label>Upload Logo Profil</label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <input type="hidden" class="form-control" name="id_profil" id="id_profil" value="{{$profil->id}}">
                        <input type="file" name="logo_profil" id="logo_profil" class="input-file"><br>
                          <p style="color:red;">*Ukuran Upload File Maksimal 10MB</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Alamat</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="{{$profil->alamat}}" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Hubungi Kami</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="hubungi_kami" id="hubungi_kami" placeholder="Hubungi Kami" value="{{$profil->hubungi_kami}}" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>SMS</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="sms" id="sms" placeholder="SMS" value="{{$profil->sms}}" required="">
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
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{$profil->email}}" required="">
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