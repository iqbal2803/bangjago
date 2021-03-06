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
                      <div class="col-sm-auto">
                        <!-- select -->
                        <div class="form-group">
                          <label>Upload Logo Tagihan</label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                          <input type="hidden" class="form-control" name="id_tagihan" id="id_tagihan" value="{{$tagihan->id}}">
                        <input type="file" name="logo_tagihan" id="logo_tagihan" class="input-file"><br>
                          <p style="color:red;">*Ukuran Upload File Maksimal 10MB</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <div class="form-group">
                          <label>Nama Tagihan</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="nama_tagihan" id="nama_tagihan" placeholder="Nama tagihan" value="{{$tagihan->nama_tagihan}}" required="">
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <input name="btn-tambah-form" id="btn-tambah-form" type="button" value="Tambah" class="btn btn-success">
                            <input name="btn-hapus-form" id="btn-hapus-form" type="button" value="Hapus Ongkos" class="btn btn-danger" @php if($jumlah_tagihan_ongkos==0) echo 'disabled' @endphp>
                            <input type="hidden" name="txtCount" id="txtCount" value="{{$jumlah_tagihan_ongkos}}" style="width: 30px;" />
                        </div>
                    </div>

                    <div class="form-group" id="form-tambah">
                    @php $next=1; @endphp
                    @foreach ($dt_tagihan_ongkos as $tagihan_ongkos)
                    <div class='form-group' id='form-tambah-group{{$next}}'>
                    <div class='row'>
                      <div class='col-sm-1'>
                          <div class='form-group'>
                              <label>Nominal Awal</label>
                          </div>
                      </div>
                      <div class='col-sm-2'>
                          <input type='text' class='form-control' name='nominal_awal[]' id='nominal_awal{{$next}}' placeholder='Nominal Awal' value="{{$tagihan_ongkos->nominal_awal}}" required=''>
                      </div>
                      <div class='col-sm-1'>
                          <div class='form-group'>
                              <label>Nominal Akhir</label>
                          </div>
                      </div>
                      <div class='col-sm-2'>
                          <input type='text' class='form-control' name='nominal_akhir[]' id='nominal_akhir{{$next}}' placeholder='Nominal Akhir' value="{{$tagihan_ongkos->nominal_akhir}}" required=''>
                      </div>
                      <div class='col-sm-2'>
                          <div class='form-group'>
                              <label>Ongkos Tagihan</label>
                          </div>
                      </div>
                      <div class='col-sm-2'>
                          <input type='text' class='form-control' name='ongkos_tagihan[]' id='ongkos_tagihan{{$next}}' placeholder='Ongkos Tagihan' value="{{$tagihan_ongkos->ongkos_tagihan}}" required=''>
                      </div>
                    </div>
                    </div>
                    @php $next++; @endphp
                    @endforeach

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
            document.getElementById("btn_simpan").disabled = true;
        }else{
            document.getElementById("btn-hapus-form").disabled = false;
        }
    });

});

</script>
@endsection