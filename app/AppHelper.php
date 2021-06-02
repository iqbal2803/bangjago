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

}