<?php 

if (!function_exists('levelAlias')) {
    function levelAlias($level) 
    {
        $alias = '';

        switch ($level) {
            case 'MANAGER':
                $alias = 'Manager';
                break;
            
            case 'BRANCH_MANAGER':
                $alias = 'Branch Manager';
                break;
            
            default:
                $alias = 'Staff';
                break;
        }

        return $alias;
    }
}

if (!function_exists('generateToken')) {
    function generateToken($len=32) 
    {
        $token = random_bytes($len);
        $token = bin2hex($token);
        return $token;
    }
}

if (!function_exists('checkboxValue')) {
    function checkboxValue($arr, $value) 
    {
        $arr = $arr === NULL ? [] : $arr;
        foreach ($arr as $val) {
            if ($val == $value) {
                return 'checked';
            }
        }
    }
}

if (!function_exists('checkboxValueObj')) {
    function checkboxValueObj($arr, $value) 
    {
        $arr = $arr === NULL ? [] : $arr;
        foreach ($arr as $val) {
            if ($val->name == $value) {
                return 'checked';
            }
        }
    }
}

if (!function_exists('angka')) {
	function angka($num)
	{
		return number_format($num,0,",",".");
	}
}

if (!function_exists('angkaDecimal')) {
	function angkaDecimal($num)
	{
		return number_format($num,2,",",".");
	}
}

if (!function_exists('arraySearch')) {
	function arraySearch($arr, $condition=[])
	{
        if ($arr === NULL) {
            return FALSE;
        }

        foreach ($arr as $idx => $row) {
            $found = [];
            foreach ($condition as $key => $val) {
                $found[$key] = ($row[$key] == $val);
            }

            if (!in_array(FALSE, $found)) {
                return $idx;
            }
        }

        return FALSE;
	}
}

if (!function_exists('arrayObjSearch')) {
	function arrayObjSearch($arr, $condition=[])
	{
        if ($arr === NULL) {
            return FALSE;
        }

        foreach ($arr as $idx => $row) {
            $found = [];
            foreach ($condition as $key => $val) {
                $found[$key] = ($row->{$key} == $val);
            }

            if (!in_array(FALSE, $found)) {
                return $idx;
            }
        }

        return FALSE;
	}
}

if (!function_exists('getStartBookDate')) {
	function getStartBookDate()
	{
        $tanggal_start = date("d-m-Y");
        if (session()->has('when_to_dive')) {
            $tanggal_start = date("d-m-Y", strtotime(session()->get('when_to_dive')));
        }
        if (session()->has('tgl_start')) {
            $tanggal_start = date("d-m-Y", strtotime(session()->get('tgl_start')));
        }

        return $tanggal_start;
	}
}

if (!function_exists('getEndBookDate')) {
	function getEndBookDate()
	{
        $tanggal_end = date("d-m-Y", strtotime(getStartBookDate(). ' + 1 days'));
        if (session()->has('tgl_end')) {
            $tanggal_end = date("d-m-Y", strtotime(session()->get('tgl_end')));
        }

        return $tanggal_end;
	}
}

if (!function_exists('percentage')) {
	function percentage($num, $from)
	{
        return $num / $from * 100;
	}
}

if (!function_exists('datediff')) {
	function datediff($earlier, $later)
	{
        $earlier = $earlier === NULL ? date("Y-m-d") : $earlier;
        $later = $later === NULL ? date("Y-m-d") : $later;

        $earlier = new DateTime($earlier);
        $later = new DateTime($later);

        $diff = $later->diff($earlier)->format("%a");
        return $diff;
	}
}

if (!function_exists('firstLetter')) {
	function firstLetter($word)
	{
        return substr($word, 0, 1);
	}
}

if (!function_exists('firstWord')) {
	function firstWord($words)
	{
        $words = explode(" ", $words);
        return $words[0];
	}
}

if (!function_exists('currentDateAdd')) {
	function currentDateAdd($days=0)
	{
        return date("Y-m-d H:i:s", strtotime(' + '.$days.' days'));
	}
}

if (!function_exists('getStatusBookingDashboard')) {
	function getStatusBookingDashboard()
	{
        return [
            'paid' => 'Paid',
            'book' => 'Book',
            'review' => 'Review'
        ];
	}
}

if (!function_exists('statusBookingDashboard')) {
	function statusBookingDashboard($status)
	{
        if ($status == 'paid') {
            return ['payment_received'];
        }
        elseif($status == 'book') {
            return ['awaiting_payment'];
        }
        else {
            return [];
        }
	}
}

if (!function_exists('statusBooking')) {
	function statusBooking($status)
	{
        if ($status == 'payment_received') {
            return strtoupper('Confirmed');
        }
        elseif ($status == 'awaiting_payment') {
            return strtoupper('Awaiting Payment');
        }
        elseif ($status == 'expired_payment') {
            return strtoupper('Expired Payment');
        }
        elseif ($status == 'cancel') {
            return strtoupper('Cancel');
        }
	}
}

if (!function_exists('statusBookingReservation')) {
	function statusBookingReservation($status)
	{
        if ($status == 'payment_received') {
            return ('Paid');
        }
        elseif ($status == 'awaiting_payment') {
            return ('Awaiting Payment');
        }
        elseif ($status == 'expired_payment') {
            return ('Expired Payment');
        }
        elseif ($status == 'cancel') {
            return ('Cancel');
        }
	}
}

if (!function_exists('getStatusBookingReservation')) {
	function getStatusBookingReservation()
	{
        return [
            'payment_received'  => statusBookingReservation('payment_received'),
            'awaiting_payment'  => statusBookingReservation('awaiting_payment'),
            'expired_payment'  => statusBookingReservation('expired_payment'),
            'cancel'  => statusBookingReservation('cancel')
        ];
	}
}

if (!function_exists('statusBookingColor')) {
	function statusBookingColor($status)
	{
        if ($status == 'payment_received') {
            return 'text-success';
        }
        elseif ($status == 'awaiting_payment') {
            return 'text-primary';
        }
        elseif ($status == 'expired_payment') {
            return 'text-danger';
        }
        elseif ($status == 'cancel') {
            return 'text-danger';
        }
	}
}

if (! function_exists('tglIndo'))
{
	function tglIndo($parm)
	{
		if($parm == null){
			return "-";
		}
		$array_bulan = array(1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		$dataBulan = date('n',strtotime($parm));
		return date('d',strtotime($parm))." ".$array_bulan[$dataBulan]." ".date('Y',strtotime($parm));
	}
}

if (! function_exists('penyebut'))
{
	function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = penyebut($nilai - 10). " Belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
        }
        return $temp;
    }
}

if (! function_exists('terbilang')) {
    function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }
        return $hasil;
    }
}

if (!function_exists('thousandsCurrencyFormat')) {
    function thousandsCurrencyFormat($num) {
        if($num>1000) {
            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];
    
            return $x_display;
        }
      
        return $num;
    }
}

if (!function_exists('limit_string')) {
    function limit_string($string,$limit,$text) {
        if (!empty($string) AND !empty($limit) AND !empty($text)) {

            if (strlen($string) > $limit){
                $string = substr($string, 0, $limit) . $text;
            }
        }
        return $string;
    }
}

