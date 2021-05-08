@extends('inc.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tagihan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tagihan</li>
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
          <h3 class="card-title">Data tagihan</h3>

          <div class="card-tools">
            <a href="{{route('tagihan.tambah_tagihan')}}"><button type="submit" class="btn btn-primary">Tambah Data</button></a>
          </div>
        </div>
        <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Logo</th>
                    <th>Nama Tagihan</th>
                    <th>Biaya Tagihan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $no=1; @endphp
                  @foreach ($tagihans as $tagihan)
                  <tr>
                    <td>{{$no}}</td>
                    <td><img src="{{ asset('assets_admin/images/tagihan/'.$tagihan->logo_tagihan) }}" width="100px" height="100px" class="radius-10 bd-placeholder-img mb-2" alt="">
                    </td>
                    <td>{{ $tagihan->nama_tagihan}}</td>
                    <td>{{ $tagihan->biaya_tarik_tunai}}</td>
                    <td>
                      <button type="button" class="btn btn-info btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">Aksi
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{url('tagihan/edit_tagihan/'.$tagihan->id)}}">Edit</a>
                        <a class="dropdown-item" href="{{url('tagihan/hapus_tagihan/'.$tagihan->id)}}">Hapus</a>
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