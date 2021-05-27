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
        <form action="{{ route('bank.update_ongkos_tarik_tunai') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><b>Edit Data Ongkos Tarik Tunai</b></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form role="form">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-1">
                        <div class="form-group">
                          <label>Nominal Awal</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="nominal_awal" id="nominal_awal" placeholder="Nominal Awal" value="{{$ongkos->nominal_awal}}" required="">
                        <input type="hidden" class="form-control" name="id_ongkos" id="id_ongkos" value="{{$ongkos->id}}">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <div class="form-group">
                          <label>Nominal</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="nominal_akhir" id="nominal_akhir" placeholder="Nominal Akhir" value="{{$ongkos->nominal_akhir}}" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <div class="form-group">
                          <label>Ongkos Sesama Bank</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="ongkos_sesama_bank" id="ongkos_sesama_bank" placeholder="Ongkos Sesama Bank" value="{{$ongkos->ongkos_sesama_bank}}" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <div class="form-group">
                          <label>Ongkos Antar Bank</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="ongkos_antar_bank" id="ongkos_antar_bank" placeholder="Ongkos Antar Bank" value="{{$ongkos->ongkos_antar_bank}}" required="">
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