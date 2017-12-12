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
?>