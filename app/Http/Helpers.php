<?php

//formats currency
if (! function_exists('format_price')) {
    function format_price($price)
    {
        // if(BusinessSetting::where('type', 'symbol_format')->first()->value == 1){
        //     return currency_symbol().number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value,0,".");
        // }
        // return number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value,0,".").currency_symbol();
        return number_format($price,0,0,".");
    }
}


?>
