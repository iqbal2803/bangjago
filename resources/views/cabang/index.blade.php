@extends('inc.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cabang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cabang</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Cabang</h3>

          <div class="card-tools">
            <a href="{{route('cabang.tambah_cabang')}}"><button type="submit" class="btn btn-primary">Tambah Data</button></a>
          </div>
        </div>
        <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Cabang</th>
                    <th>Alamat</th>
                    <th>Penanggung Jawab</th>
                    <th>No. Telepon PIC</th>
                    <th>Jam Operasional</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $no=1; @endphp
                  @foreach ($cabangs as $data)
                  <tr>
                    <td>{{$no}}</td>
                    <td>{{ $data->nama_cabang}}</td>
                    <td>{{ $data->alamat}}</td>
                    <td>{{ $data->penanggung_jawab}}</td>
                    <td>{{ $data->no_telepon_pic}}</td>
                    <td>{{ $data->jam_operasional}}</td>
                    <td>
                      <button type="button" class="btn btn-info btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">Aksi
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{url('cabang/edit_cabang/'.$data->id)}}">Edit</a>
                        <a class="dropdown-item" href="{{url('cabang/hapus_cabang/'.$data->id)}}">Hapus</a>
                        <a class="dropdown-item" href="{{url('transaksi/riwayat_transaksi/'.$data->id)}}">Laporan</a>
                      </div>
                    </td>
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