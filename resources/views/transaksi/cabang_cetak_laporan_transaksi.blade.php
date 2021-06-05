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
                        @if (file_exists(asset('assets_admin/images/profil/'.$profile->logo_profil)))
                        <img loading="lazy"  src="{{ asset('assets_admin/images/profil/'.$profile->logo_profil) }}" height="40" style="display:inline-block;">
                        @endif
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
                    <th>Nama Bank/Tagihan</th>
                    <th>Nomor Rekening/ID</th>
                    <th>Nama Pemilik Rekening/ID</th>
                    <th>Nominal Transfer/Tagihan</th>
                    <th>Biaya Ongkos</th>
                    <th>Total</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $no=1; @endphp
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
                  @php $no++; @endphp
                  @endforeach
                  </tbody>
                </table>
        </div>

        

    </div>
</body>
</html>