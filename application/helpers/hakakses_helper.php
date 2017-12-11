<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function user_data($arg){
    $ci =& get_instance();
    $q = $ci->session->userdata['user'];
    if($q[$arg] == "" && $q[$arg] == NULL){
        return "Session Tidak Terdefinisi";
    }else{
        return $q[$arg];
    }
}

function hak_akses($arg){
    $ci =& get_instance();
    $q = $ci->session->userdata['user']['level_user'];
    //$q minimal 1
    if($q > $arg){
        //can access
        return $q;
    } else {
        redirect('/');
    }
}

?>