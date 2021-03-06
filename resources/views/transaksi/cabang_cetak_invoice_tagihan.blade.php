<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel</title>
  <meta http-equiv="Content-Type" content="text/html;"/>
  <meta charset="UTF-8">
  <style>

      #example2 tr{
      font-size: 10pt;
      }
      #example2 td{
      font-size: 10pt;
        padding-top: 5px;
        padding-bottom: 5px;
      }

      .bordertabel{
      font-size: 10pt;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
      }

      #example2 th{
        font-size: 8pt;
        padding-top: 5px;
        text-align: center;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
      } 

      #example2 {
        width: 160px;
        border-collapse: collapse;
      }


    </style>
  </head>
  <body>
    <div>
      <table id="example2">
          <thead >
            <tr>
              <th colspan="3" class="strong" style="border-top: 0px">
                <p style="font-size: 10pt;"><center> TAGIHAN<br> BANG JAGO<br> {{tanggal_indonesia(date('Y-m-d'))}}</center></p>
              </th>
            </tr>
          </thead>
        </table>
      <div>
        <table id="example2">
          <thead >
            <tr>
              <th colspan="3" class="strong">
                <p style="font-size: 10pt;"><center>{{$cabang->alamat}}<br>{{$cabang->nama_kota}} {{$cabang->kode_pos}}</center></p>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="bordertabel">Nomor Transaksi</td>
              <td width="2%" class="bordertabel">:</td>
              <td class="bordertabel">{{$transaksi->nomor_transaksi}}</td>
            </tr>
            <tr>
              <td>Jenis Tagihan</td>
              <td>:</td>
              <td>{{$transaksi->nama_bank}}</td>
            </tr>
            <tr>
              <td>Nomor ID</td>
              <td>:</td>
             <td>{{$transaksi->nomor_rekening}}</td>
            </tr>
            <tr>
              <td>Nama ID</td>
              <td>:</td>
              <td>{{$transaksi->nama_pemilik}}</td>
            </tr>
            <tr>
              <td>Jumlah Tagihan</td>
              <td>:</td>
              <td>Rp{{format_price($transaksi->nominal_transfer)}}</td>
            </tr>
            <tr>
              <td class="bordertabel">Biaya Ongkos</td>
              <td class="bordertabel">:</td>
              <td class="bordertabel">Rp{{format_price($transaksi->biaya_ongkos)}}</td>
            </tr>
            <tr>
              <td class="bordertabel">Total</td>
              <td class="bordertabel">:</td>
              <td class="bordertabel">Rp{{format_price($transaksi->total)}}</td>
            </tr>
          </tbody>
        </table>

        
      </div>

      
    </div>
    <table id="example2">
          <thead >
            <tr>
              <th colspan="3" class="strong" style="border-top: 0px;border-bottom: 0px">
    <center><p style="font-size: 7pt;">LAYANAN PELANGGAN<br><br>HUBUNGI KAMI : <br>{{$profile->hubungi_kami }}<br><br>SMS : {{$profile->sms }}<br><br>EMAIL : {{$profile->email }}</p></center>
  </th></tr></thead></table>
  </body>
  </html>