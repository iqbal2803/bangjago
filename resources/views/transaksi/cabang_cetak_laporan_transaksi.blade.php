<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">
    <style>
    #example2 tr{
      font-size: 11pt;
    }
    #example2 td{
      text-align: center;
      font-size: 11pt;
    }

    #example2 th{
      text-align: center;
      border: 1px solid black;
      font-size: 11pt;
    }

    #example2 {
      width: 100%;
      border-collapse: collapse;
    }
    </style>
</head>
<body>
    <div>

        

        <div style="background: #eceff4;padding: 1.5rem;">
            <table width="100%" border="0">
                <tr>
                    <td rowspan="2" width="15%">
                        @if (file_exists(asset('assets_admin/images/profil/'.$profile->logo_profil)))
                        <img loading="lazy"  src="{{ asset('assets_admin/images/profil/'.$profile->logo_profil) }}" height="40" style="display:inline-block;">
                        @endif
                    </td>
                    <td rowspan="2" width="50%" style="font-size: 1.5rem;" class="strong"><center>Laporan Transaksi  @if($jenis_transaksi=="transfer")
                    Transfer 
                    @elseif($jenis_transaksi=="tarik tunai")
                    Tarik Tunai
                    @elseif($jenis_transaksi=="tagihan")
                    Tagihan
                    @endif
                    </center></td>
                    <td rowspan="2" width="25%">
                        <b>Cabang :</b> {{$cabang->nama_cabang}}<br>
                        <b>Tanggal :</b> {{tanggal_indonesia(date('Y-m-d'))}}
                    </td>
                </tr>
            </table>

        </div>
        <div>
            <table id="example2">
                  <thead >
                  <tr>
                    <th>No</th>
                    <th>Nomor Pesanan</th>
                    <th>Tanggal</th>
                    @if ($jenis_transaksi=="null")
                    <th>Jenis Transaksi</th>
                    @endif
                    <th>Nama Bank/Tagihan</th>
                    <th>Nomor Rekening/ID</th>
                    <th>Nama Pemilik Rekening/ID</th>
                    <th>Nominal Transfer/Tagihan</th>
                    <th>Biaya Ongkos</th>
                    <th>Total</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php 
                  $no=1;
                  $total_nominal=0;
                  $total_biaya_ongkos=0;
                  $total_semua=0; 
                  @endphp
                  @foreach ($transaksi as $data)
                  <tr style="border:1px solid black;">
                    <td style="border:1px solid black;">{{$no}}</td>
                    <td style="border:1px solid black;">{{ $data->nomor_transaksi}}</td>
                    <td style="border:1px solid black;">{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s') }}</td>
                    @if($jenis_transaksi=="null")
                    <td style="border:1px solid black;">
                      @if($data->jenis_transaksi=="transfer")
                      Transfer 
                      @elseif($data->jenis_transaksi=="tarik tunai")
                      Tarik Tunai
                      @elseif($data->jenis_transaksi=="tagihan")
                      Tagihan
                      @endif
                    </td>
                    @endif
                    <td style="border:1px solid black;">{{ $data->nama_bank}}</td>
                    <td style="border:1px solid black;">{{ $data->nomor_rekening}}</td>
                    <td style="border:1px solid black;">{{ $data->nama_pemilik}}</td>
                    <td style="border:1px solid black;">{{ format_price($data->nominal_transfer)}}</td>
                    <td style="border:1px solid black;">{{ format_price($data->biaya_ongkos)}}</td>
                    <td style="border:1px solid black;">{{ format_price($data->total)}}</td>
                  </tr>
                  @php 
                  $no++;
                  $total_nominal=$total_nominal+$data->nominal_transfer;
                  $total_biaya_ongkos=$total_biaya_ongkos+$data->biaya_ongkos;
                  $total_semua=$total_semua+$data->total; 
                  @endphp
                  @endforeach
                  <tr>
                    @if($jenis_transaksi=="null")
                    <td colspan="6"></td>
                    @else
                    <td colspan="5"></td>
                    @endif
                    <td style="border:1px solid black;text-align: center;">Total</td>
                    <td style="border:1px solid black;">{{ format_price($total_nominal)}}</td>
                    <td style="border:1px solid black;">{{ format_price($total_biaya_ongkos)}}</td>
                    <td style="border:1px solid black;">{{ format_price($total_semua)}}</td>
                  </tr>
                  </tbody>
                </table>
        </div>

        

    </div>
</body>
</html>