<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Jika kosong ganti dengan sometext
function ifempty($cond,$get = "No Data"){
    if($cond == "" || $cond == NULL){
        $result = $get;
    }else{
        $result = $cond;
    }
    return $result;
}

function ifemptydate($cond,$get = "No Data"){
    if($cond == "0000-00-00 00:00:00"){
        $r = $get;
    } else {
        $r = $cond;
    }
    return $r;
}

function date_id($arg = "1901-01-01"){
    $param = explode('-',$arg);
    $day 	= $param[2];
    $month 	= $param[1];
    $year 	= $param[0];
    
    switch ($month){
        case 1: 
            $mo = "Januari";
            break;
        case 2:
            $mo = "Februari";
            break;
        case 3:
            $mo = "Maret";
            break;
        case 4:
            $mo = "April";
            break;
        case 5:
            $mo = "Mei";
            break;
        case 6:
            $mo = "Juni";
            break;
        case 7:
            $mo = "Juli";
            break;
        case 8:
            $mo = "Agustus";
            break;
        case 9:
            $mo = "September";
            break;
        case 10:
            $mo = "Oktober";
            break;
        case 11:
            $mo = "November";
            break;
        case 12:
            $mo = "Desember";
            break;
    }

    $r = $day.' '.$mo.' '.$year;
    return $r;
}
?>