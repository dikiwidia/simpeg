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

?>