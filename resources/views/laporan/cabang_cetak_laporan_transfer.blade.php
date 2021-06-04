<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">
    <style>
    #example2 tr{
      border: 1px solid black;
      border-collapse: collapse;
    }
    #example2 td{
        text-align: center;
      border: 1px solid black;
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
                        <img loading="lazy"  src="{{ asset('assets_admin/images/profil/'.$profile->logo_profil) }}" height="40" style="display:inline-block;">
                    </td>
                    <td rowspan="2" width="50%" style="font-size: 1.5rem;" class="strong"><center>Laporan Transaksi Transfer</center></td>
                    <td rowspan="2" width="25%">
                        <b>Cabang :</b> {{$cabang->nama_cabang}}<br>
                        <b>Tanggal :</b> {{tanggal_indonesia(date('Y-m-d'))}}
                    </td>
                </tr>
            </table>

        </div>
        <div>
            <table id="example2" style="border-collapse:collapse;border: 1px solid black;">
                  <thead >
                  <tr>
                    <th>No</th>
                    <th>Nomor Pesanan</th>
                    <th>Tanggal</th>
                    <th>Nama Bank</th>
                    <th>Nomor Rekening</th>
                    <th>Nama Pemilik Rekening</th>
                    <th>Nominal Transfer</th>
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
                  <tr>
                    <td>{{$no}}</td>
                    <td>{{ $data->nomor_transaksi}}</td>
                    <td>{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s') }}</td>
                    <td>{{ $data->nama_bank}}</td>
                    <td>{{ $data->nomor_rekening}}</td>
                    <td>{{ $data->nama_pemilik}}</td>
                    <td>{{ format_price($data->nominal_transfer)}}</td>
                    <td>{{ format_price($data->biaya_ongkos)}}</td>
                    <td>{{ format_price($data->total)}}</td>
                  </tr>
                  @php 
                  $no++;
                  $total_nominal=$total_nominal+$data->nominal_transfer;
                  $total_biaya_ongkos=$total_biaya_ongkos+$data->biaya_ongkos;
                  $total_semua=$total_semua+$data->total; 
                  @endphp
                  @endforeach
                  <tr style="border-collapse:collapse;border-left: 0px;border-bottom: 0px;border-right: 0px">
                    <td colspan="6" style="border-collapse:collapse;border-left: 0px;border-bottom: 0px;border-right: 0px"></td>
                    <td>{{ format_price($total_nominal)}}</td>
                    <td>{{ format_price($total_biaya_ongkos)}}</td>
                    <td>{{ format_price($total_semua)}}</td>
                  </tr>
                  </tbody>
                </table>
        </div>

        

    </div>
</body>
</html>