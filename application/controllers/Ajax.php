<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	/*
	* DASBOR CLASS
	* AUTHOR  : MOCH DIKI WIDIANTO
	* NOTES   : 
	*/
	public function __construct() {
	parent::__construct();
		
	}
    
    public function index(){
		redirect(base_url());
    }
    
    public function checking_id(){
        $v_int = $this->input->post('v');
        $table = $this->input->post('t');

        $f     = $this->crud->read_fields($table);
        $arr   = array(
            $f[0] => $v_int
        );
        $r     = $this->crud->read_cond_bool($table,$arr);
        return $r;
    }

    public function checking_username(){
        //if($this->input->post('v') == NULL){redirect(base_url());}
        $v_int = $this->input->post('nama_user');
        $table = 'speg_user';
        $arr   = array(
                'nama_user' => $v_int
        );
        $r = $this->crud->read_numrows($table,$arr);      
        echo $r;
    }

    public function checking(){
        if($this->input->post('tbl_name') == NULL){redirect(base_url());}
        $v_1 = $this->input->post('tbl_name');
        $v_2 = $this->input->post('field');
        $v_3 = $this->input->post('value');
        //$v_1 = "speg_data_golgaji";
        //$v_2 = "kode_golgaji";
        //$v_3 = "G-1A";

        $arr   = array(
                $v_2 => $v_3
        );
        $r = $this->crud->read_numrows($v_1,$arr);      
        echo $r;
    }
}
