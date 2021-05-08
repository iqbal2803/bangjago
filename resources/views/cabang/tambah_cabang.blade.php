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
      <form action="{{ route('cabang.store_cabang') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><b>Buat Data Cabang Baru</b></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Provinsi</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <select class="form-control" name="provinsi_id" id="provinsi">
                         
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Kota</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <select class="form-control" name="kota_id" id="kota">
                         
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Nama Cabang</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="nama_cabang" id="nama_cabang" placeholder="Nama Cabang" required="">
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
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Penanggung Jawab</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="penanggung_jawab" id="penanggung_jawab" placeholder="Penanggung Jawab" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>No Telepon PIC</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="no_telepon_pic" id="no_telepon_pic" placeholder="No Telepon PIC" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Jam Operasional</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="jam_operasional" id="jam_operasional" placeholder="jam Operasional" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-1">
                        <!-- select -->
                        <div class="form-group">
                          <label>Pilih User</label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <select class="form-control" name="staff_id" id="staff_id">
                          @foreach ($datauserscabang as $data)
                          <option value="{{$data->id}}">{{$data->nama}}</option>
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
<!-- /.content-wrapper-->
  @endsection
  @section('script')
<script type="text/javascript">
    function getProvinsi(){
        $.ajax({
           type:"GET",
           url:'{{ route('cabang.provinsi') }}',
           success: function(data){
               $('#provinsi').select2({
                data: data,
                templateResult: function (repo) {
                    if (repo.loading) return repo.text;

                    var markup = "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__title'>" + repo.text + "</div></div>";

                    return markup;
                },

                escapeMarkup: function (markup) {
                    return markup;
                },
                templateSelection: function (repo) {
                    return repo.TEXT || repo.text;
                },
                placeholder: "Pilih provinsi",
                minimumInputLength : -1
            });

           }
       });
    }

    function getKota(){
        var provinsi= $('#provinsi').val();
        $('#kota').html('<option></option>');
        // $("#kota_kabupaten").select2("destroy").select2();
        $.ajax({
           type:"GET",
           url:'{{ route('cabang.kota') }}',
           data: {
                id_provinsi : provinsi
           },
           success: function(data){
               $('#kota').select2({
                data: data,
                templateResult: function (repo) {
                    if (repo.loading) return repo.text;

                    var markup = "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__title'>" + repo.text + "</div></div>";

                    return markup;
                },

                escapeMarkup: function (markup) {
                    return markup;
                },
                templateSelection: function (repo) {
                    return repo.TEXT || repo.text;
                },
                placeholder: "Pilih kota/kabupaten",
                minimumInputLength : -1
            });
           }
       });
    }

$(document).ready(function(){
    getProvinsi();
    $('#provinsi').on('change', function() {
        var data = $('#provinsi').select2('data');
        $('input[name="province"]').val(data[0].text);
        getKota();
    });
});


</script>
@endsection

