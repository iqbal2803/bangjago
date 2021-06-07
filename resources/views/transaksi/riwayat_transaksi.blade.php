@extends('inc.app')

@section('content')
<style>
  optgroup:empty {
    display: none
  }
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Riwayat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Riwayat</li>
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
          <h3 class="card-title" style="padding-top: 15px;">Riwayat Transaksi</h3>

          <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item">
            <select class="form-control filter-status" data-column="10"  name="filter_status" id="filter_status">
                <option value="">Pilih Status</option>
                <option value="Pending">Pending</option>
                <option value="Selesai">Selesai</option>
            </select>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item">
            <input type="hidden" name="cabang_id" id="cabang_id" value="{{$cabang_id}}">
            <select class="form-control filter-jenis-transaksi" data-column="1"  name="filter_jenis_transaksi" id="filter_jenis_transaksi">
                <option value="">Pilih Jenis Transaksi</option>
                <option value="transfer">Transfer</option>
                <option value="tarik tunai">Tarik Tunai</option>
                <option value="tagihan">Tagihan</option>
            </select>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item">
            <select class="form-control filter-bank" data-column="4"  name="filter_bank" id="filter_bank">
                <option value="">Pilih Bank/Tagihan</option>
                @foreach ($databank as $data)
                <option value="{{$data->nama_bank}}" class="optbank">{{$data->nama_bank}}</option>
                @endforeach
                @foreach ($datatagihan as $data1)
                <option value="{{$data1->nama_tagihan}}" class="opttagihan">{{$data1->nama_tagihan}}</option>
                @endforeach
            </select>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item">
            <input type="text" data-column="3" name="filter_tgl" id="filter_tgl" class="form-control filter-tgl" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="dd-mm-yyyy">
            </li>
            <li class="nav-item">
              @if(Auth::user()->role->nama_role=='Pemilik')<button type="submit" id="btn_cetak" class="btn btn-primary">Cetak Laporan</button>@endif
            </li>
          </ul>
        </div>
        <div class="card-body">
                <table id="example2" class="table table-striped">
                  <thead >
                  <tr>
                    <th>No</th>
                    <th>Jenis Transaksi</th>
                    <th>Nomor Pesanan</th>
                    <th>Tanggal</th>
                    <th>Nama Bank/Tagihan</th>
                    <th>Nomor Rekening/ID Pelanggan</th>
                    <th>Nama Pemilik Rekening/ID Tagihan</th>
                    <th>Nominal Transfer/Tagihan</th>
                    <th>Biaya Ongkos</th>
                    <th>Total</th>
                    <th>Status</th>
                    @if(Auth::user()->role->nama_role=='Admin Cabang')<th>Aksi</th>@endif
                  </tr>
                  </thead>
                  <tbody>
                  @php $no=1; @endphp
                  @foreach ($transaksi as $data)
                  <tr>
                    <td>{{$no}}</td>
                    <td>{{ $data->jenis_transaksi}}</td>
                    <td>{{ $data->nomor_transaksi}}</td>
                    <td>{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s') }}</td>
                    <td>{{ $data->nama_bank}}</td>
                    <td>{{ $data->nomor_rekening}}</td>
                    <td>{{ $data->nama_pemilik}}</td>
                    <td>{{ format_price($data->nominal_transfer)}}</td>
                    <td>{{ format_price($data->biaya_ongkos)}}</td>
                    <td>{{ format_price($data->total)}}</td>
                    <td>{{ $data->status}}</td>
                     @if(Auth::user()->role->nama_role=='Admin Cabang')
                     <td>
                      @if($data->status=='Pending')
                      <button type="button" class="btn btn-info btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">Aksi
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" data-toggle="modal" data-target="#modal-sm{{ $data->nomor_transaksi}}">Ganti Status</a>
                        <a class="dropdown-item" href="{{url('transaksi/cetak_invoice_transfer/'.$data->nomor_transaksi)}}">Cetak Invoice</a>
                      </div>
                      @else
                      <a href="{{url('transaksi/cetak_invoice_transfer/'.$data->nomor_transaksi)}}"><button class="btn btn-info btn-flat">Cetak Invoice</button></a>
                      @endif
                    </td>
                    @endif
                  </tr>

                  <div class="modal fade" id="modal-sm{{ $data->nomor_transaksi}}">
                    <div class="modal-dialog modal-sm{{ $data->nomor_transaksi}}">
                      <div class="modal-content">
                        <div class="modal-body">
                          <p>Apakah anda akan mengganti status transaksi?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <a href="{{url('transaksi/update_status_transfer/'.$data->nomor_transaksi)}}"><button type="button" class="btn btn-primary" >Konfirmasi</button></a>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

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
     
        var table = $('#example2').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            "paging":   true,
            "ordering": false,
            "info":     true
        } );


        var filter_bank = $('#filter_bank');
        var filter_tgl = $('#filter_tgl');
        var filter_status = $('#filter_status');
        var filter_jenis_transaksi = $('#filter_jenis_transaksi');

        $("select>option.optbank").wrap('<span>'); //hidden
        $("select>option.opttagihan").wrap('<span>'); //hidden



        $('.filter-bank').change(function () {
            table.column( filter_bank.data('column'))
            .search( filter_bank.val() )
            .draw();
        });

        $('.filter-tgl').change(function () {
            table.column( filter_tgl.data('column'))
            .search( filter_tgl.val() )
            .draw();
        });

        $('.filter-status').change(function () {
            table.column( filter_status.data('column'))
            .search( filter_status.val() )
            .draw();
        });

        $('.filter-jenis-transaksi').change(function () {
            table.column( filter_jenis_transaksi.data('column'))
            .search( filter_jenis_transaksi.val() )
            .draw();

            $("select span option").unwrap(); //tampil
            if (filter_jenis_transaksi.val()=="tagihan") {
              $("select>option.optbank").wrap('<span>'); //hidden
            }else if (filter_jenis_transaksi.val()=="transfer" || filter_jenis_transaksi.val()=="tarik tunai") {
              $("select>option.opttagihan").wrap('<span>'); //hidden
            }else {
              $("select>option.optbank").wrap('<span>'); //hidden
              $("select>option.opttagihan").wrap('<span>'); //hidden
            }
        });



        $("#btn_cetak").on('click',function(){

            var cabang_id = $('#cabang_id').val();
            var filter_bank ="null";
            var filter_tgl ="null";
            var filter_jenis_transaksi = "null";
            var filter_status ="null";
            var filter_search ="null";
            var dt_bank,dt_tgl,dt_jenis_transaksi,dt_search,cek="";
            dt_bank = $('#filter_bank').val();
            dt_tgl = $('#filter_tgl').val();
            dt_jenis_transaksi = $('#filter_jenis_transaksi').val();
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
            
            if(dt_bank!=""){
               filter_bank=dt_bank;
            }

            if(dt_jenis_transaksi!=""){
              filter_jenis_transaksi=dt_jenis_transaksi;
            }

            if(dt_search!=""){
               filter_search=dt_search;
            }
            //window.open('https://yoururl.com', '_blank');
            var data = filter_bank+"/"+filter_tgl+"/"+filter_search+"/"+filter_status;
            //alert(filter_bank+"|"+filter_tgl+"|"+filter_search+"|"+filter_search);
            window.location.href = "{{ url('transaksi/cetak_riwayat_transaksi/cabang_id/filter_jenis_transaksi/filter_bank/filter_tgl/filter_search/filter_status') }}".replace('filter_jenis_transaksi',filter_jenis_transaksi).replace('filter_bank',filter_bank).replace('cabang_id',cabang_id).replace('filter_tgl',filter_tgl).replace('filter_search',filter_search).replace('filter_status',filter_status);
            }
        });
    } );
    
  </script>
  @endsection