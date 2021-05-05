<?php
namespace App;

use Intervention\Image\Facades\Image;
use App\Currency;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AppHelper 
{
    public static function generateToken($len=32) 
    {
        $token = random_bytes($len);
        $token = bin2hex($token);
        return $token;
    }




/**
 * Save JSON File
 * @return Response
*/
    public static function convert_to_usd($amount) {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
        if($business_settings!=null){
            $currency = Currency::find($business_settings->value);
            return floatval($amount) / floatval($currency->exchange_rate);
        }
    }



//formats currency
    public static function format_price($price)
    {
        // if(BusinessSetting::where('type', 'symbol_format')->first()->value == 1){
        //     return currency_symbol().number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value,0,".");
        // }
        // return number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value,0,".").currency_symbol();
        return "Rp".number_format($price,0,0,".");
    }


//formats price to home default price with convertion
    public static function single_price($price)
    {
        $price = $price <= 0 ? 0 : $price;
        return format_price(convert_price($price));
    }


    public static function request_raja_ongkir($url,$tipe = 'GET',$param)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/".$url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $tipe,
        CURLOPT_POSTFIELDS => $param,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: ".env("RAJA_ONGKIR_KEY")
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {

          return "cURL Error #:" . $err;
        } else {
           $_respose = json_decode($response);
           if ($_respose->rajaongkir->status->code == 200)
           {
            //   dd($_respose->rajaongkir->results);
            return $_respose->rajaongkir->results;
          }else{
             return [];
          }


        }

    }


    public static function global_request_raja_ongkir($url,$tipe = 'GET',$param)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/".$url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $tipe,
        CURLOPT_POSTFIELDS => $param,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: ".env("RAJA_ONGKIR_KEY")
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return "cURL Error #:" . $err;
        } else {
           $_respose = json_decode($response);
          if ($_respose->rajaongkir->status->code == 200)
          {
              # code...
            return $_respose->rajaongkir;
          }else{
             return [];
          }


        }

    }

}