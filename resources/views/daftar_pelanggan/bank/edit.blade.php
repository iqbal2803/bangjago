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
        <form action="{{ route('daftar_pelanggan.update_daftar_bank') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><b>Edit Data Pelanggan</b></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Nama Bank</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <select class="form-control" name="id_bank" id="id_bank">
                          @foreach ($databank as $data)
                          <option value="{{$data->id}}"  @if ($daftar->id_bank==$data->id) selected @endif >{{$data->nama_bank}}</option>
                          @endforeach
                        </select>
                        <input type="hidden" class="form-control" name="id_daftar" id="id_daftar" value="{{$daftar->id}}">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Nomor Rekening</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="nomor_rekening" id="nomor_rekening" placeholder="Nomor Rekening" value="{{$daftar->nomor_rekening}}" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Nama Pemilik Rekening</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="nama_pemilik" id="nama_pemilik" placeholder="Pemilik Rekening" value="{{$daftar->nama_pemilik}}" required="">
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