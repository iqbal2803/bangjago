@extends('inc.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header d-flex">
          <h3 class="card-title" style="padding-top: 15px;">Laporan Transaksi Tagihan</h3>

          <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item">
            <select class="form-control filter-tagihan" data-column="3"  name="filter_tagihan" id="filter_tagihan">
                <option value="">Pilih Tagihan</option>
                @foreach ($datatagihan as $data)
                <option value="{{$data->nama_tagihan}}">{{$data->nama_tagihan}}</option>
                @endforeach
            </select>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item">
            <input type="text" data-column="2" name="filter_tgl" id="filter_tgl" class="form-control filter-tgl" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="dd-mm-yyyy">
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item">
              <button type="submit" id="btn_cetak" class="btn btn-primary">Cetak Laporan</button>
            </li>
          </ul>
        </div>
        <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Pesanan</th>
                    <th>Tanggal</th>
                    <th>Jenis Tagihan</th>
                    <th>ID Pelanggan</th>
                    <th>Nama Pemilik ID</th>
                    <th>Nominal Tagihan</th>
                    <th>Biaya Ongkos</th>
                    <th>Total</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $no=1; @endphp
                  @foreach ($transaksi as $data)
                  <tr>
                    <td>{{$no}}</td>
                    <td>{{ $data->nomor_transaksi}}</td>
                    <td>{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s') }}</td>
                    <td>{{ $data->jenis_tagihan}}</td>
                    <td>{{ $data->nomor_id}}</td>
                    <td>{{ $data->nama_pemilik}}</td>
                    <td>{{ $data->nominal_tagihan}}</td>
                    <td>{{ $data->biaya_ongkos}}</td>
                    <td>{{ $data->total}}</td>
                    <td>{{ $data->status}}</td>
                  </tr>
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

  @section('script')
  <script type="text/javascript">
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    // $('#example2 thead tr').clone(true).appendTo( '#example2 thead' );
    //     $('#example2 thead tr:eq(1) th').each( function (i) {
    //         var title = $(this).text();
    //         $(this).html( '<input type="text" placeholder="Search '+title+'"  style="width: 100%" />' );
     
    //         $( 'input', this ).on( 'keyup change', function () {
    //             if ( table.column(i).search() !== this.value ) {
    //                 table
    //                     .column(i)
    //                     .search( this.value )
    //                     .draw();
    //             }
    //         } );
    //     } );
     
        var table = $('#example1').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            "paging":   false,
            "ordering": false,
            "info":     false
        } );


        // var filter_tagihan = $('#filter_tagihan').val();
        // var filter_tgl = $('#filter_tgl').val();
        // var filter_search = table.search();

        var filter_tagihan = $('#filter_tagihan');
        var filter_tgl = $('#filter_tgl');


        $('.filter-bank').change(function () {
            table.column( filter_tagihan.data('column'))
            .search( filter_tagihan.val() )
            .draw();

        });

        $('.filter-tgl').change(function () {
            table.column( filter_tgl.data('column'))
            .search( filter_tgl.val() )
            .draw();
        });




        $("#btn_cetak").on('click',function(){

            var filter_tagihan = "null";
            var filter_tgl ="null";
            var filter_search ="null";
            var dt_tagihan,dt_tgl,dt_search,cek="";
            dt_tagihan = $('#filter_tagihan').val();
            dt_tgl = $('#filter_tgl').val();
            dt_search = table.search();

            if(dt_tgl!=""){
              filter_tgl=dt_tgl;
              if(!/^[0-9\.\-\/]+$/.test(dt_tgl)){
                alert("Tanggal belum lengkap");
                cek="break";
              }
            }

            if(cek!=""){
              return;
            }else{
            
            if(dt_tagihan!=""){
              filter_tagihan=dt_tagihan;
            }

            if(dt_search!=""){
              filter_search=dt_search;
            }
            //window.open('https://yoururl.com', '_blank');
            var data = filter_tagihan+"/"+filter_tgl+"/"+filter_search;
            //alert(filter_tagihan+"|"+filter_tgl+"|"+filter_search);
            window.location.href = "{{ url('laporan/cetak_laporan_transaksi_tagihan/filter_tagihan/filter_tgl/filter_search') }}".replace('filter_tagihan',filter_tagihan).replace('filter_tgl',filter_tgl).replace('filter_search',filter_search);
          }
        });
    } );
    
  </script>
  @endsection