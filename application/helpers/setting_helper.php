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

?>