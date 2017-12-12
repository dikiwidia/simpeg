<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Dapatkan field value dengan memasukan table dan where id condition
function read_custom_id($table,$cond,$get){
    $ci =& get_instance();
    $ci->load->model('crud');
    
    $f = $ci->crud->read_fields($table);
    $arr = array(
        $f[0] => $cond
    );
    $r = $ci->crud->read_cond($table,$arr);
    return $r[0][$get];
}

function read_custom_cond_bool($table,$arr){
    $ci =& get_instance();
    $ci->load->model('crud');
    
    $f = $ci->crud->read_cond_bool($table,$arr);
    return $f;
}

function read_custom_cond($table,$arr,$get){
    $ci =& get_instance();
    $ci->load->model('crud');

    $r = $ci->crud->read_cond($table,$arr);
    return $r[0][$get];
}

?>