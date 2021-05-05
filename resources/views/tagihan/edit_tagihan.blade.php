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
        <form action="{{ route('tagihan.update_tagihan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><b>Edit Data Tagihan</b></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form">
                  <div class="card-body">
                    <div class="row">
                      <div class="position-relative row form-group justify-content-center col-sm-12">
                        <div class="col-sm-2">
                          <img src="{{ asset('assets_admin/images/tagihan/'.$tagihan->logo_tagihan) }}" width="100px" height="100px" class="radius-10 bd-placeholder-img mb-2" alt="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label">Upload Logo Tagihan</label>
                        <div class="col-sm-8">
                          <input type="file" name="logo_tagihan" id="logo_tagihan" class="input-file">
                          <input type="hidden" class="form-control" name="id_tagihan" id="id_tagihan" value="{{$tagihan->id}}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Nama Tagihan</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="nama_tagihan" id="nama_tagihan" placeholder="Nama tagihan" value="{{$tagihan->nama_tagihan}}" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Biaya Tarik Tunai</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="biaya_tarik_tunai" id="biaya_tarik_tunai" placeholder="Biaya Tarik Tunai" value="{{$tagihan->biaya_tarik_tunai}}" required="">
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