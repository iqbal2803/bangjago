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
        <form action="{{ route('tagihan.store_tagihan') }}" method="POST" enctype="multipart/form-data">
      @csrf
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><b>Buat Data Tagihan Baru</b></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form">
                  <div class="card-body">
                    <div class="row">
                      <div class="position-relative row form-group">
                        <label class="col-sm-3 col-form-label">Upload Logo Tagihan</label>
                        <div class="col-sm-8">
                          <input type="file" name="logo_tagihan" id="logo_tagihan" class="input-file" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <div class="form-group">
                          <label>Nama tagihan</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="nama_tagihan" id="nama_tagihan" placeholder="Nama tagihan" required="">
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <input name="btn-tambah-form" id="btn-tambah-form" type="button" value="Tambah" class="btn btn-success">
                            <input name="btn-hapus-form" id="btn-hapus-form" type="button" value="Hapus Ongkos" class="btn btn-danger" disabled="">
                            <input type="hidden" name="txtCount" id="txtCount" value="0" style="width: 30px;" />
                        </div>
                    </div>

                    <div class="form-group" id="form-tambah">

                    </div>

                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" id="btn_simpan" name="btn_simpan" class="btn btn-primary">Submit</button>
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

@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function(){ // Ketika halaman sudah diload dan siap
    $("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
        var jumlah = parseInt($("#txtCount").val());
        var nextform = jumlah + 1;    
        
        document.getElementById("btn_simpan").disabled = false;
        document.getElementById("btn-hapus-form").disabled = false;

        $("#form-tambah").append(
            "<div class='form-group' id='form-tambah-group"+nextform+"'>"+
            "<div class='row'>"+
              "<div class='col-sm-1'>"+
                  "<div class='form-group'>"+
                      "<label>Nominal Awal</label>"+
                  "</div>"+
              "</div>"+
              "<div class='col-sm-2'>"+
                  "<input type='text' class='form-control' name='nominal_awal[]' id='nominal_awal"+nextform+"' placeholder='Nominal Awal' required=''>"+
              "</div>"+
              "<div class='col-sm-1'>"+
                  "<div class='form-group'>"+
                      "<label>Nominal Akhir</label>"+
                  "</div>"+
              "</div>"+
              "<div class='col-sm-2'>"+
                  "<input type='text' class='form-control' name='nominal_akhir[]' id='nominal_akhir"+nextform+"' placeholder='Nominal Akhir' required=''>"+
              "</div>"+
              "<div class='col-sm-2'>"+
                  "<div class='form-group'>"+
                      "<label>Ongkos Tagihan</label>"+
                  "</div>"+
              "</div>"+
              "<div class='col-sm-2'>"+
                  "<input type='text' class='form-control' name='ongkos_tagihan[]' id='ongkos_tagihan"+nextform+"' placeholder='Ongkos Tagihan' required=''>"+
              "</div>"+
            "</div>"+
            "</div>"
            );

        $("#txtCount").val(nextform);
    });

    $("#btn-hapus-form").click(function(){ // Ketika tombol Tambah Data Form di klik

        var jumlah = parseInt($("#txtCount").val());
        $('#form-tambah-group'+jumlah).remove();
        var nextform = jumlah - 1;
        $("#txtCount").val(nextform);

        if(nextform==0){
            document.getElementById("btn-hapus-form").disabled = true;
        }else{
            document.getElementById("btn-hapus-form").disabled = false;
            document.getElementById("btn_simpan").disabled = true;
        }
    });

});

</script>
@endsection