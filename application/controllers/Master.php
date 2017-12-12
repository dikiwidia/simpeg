<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	/*
	* MASTER CLASS
	* AUTHOR  : MOCH DIKI WIDIANTO
	* NOTES   : A3
    */
	public function __construct() {

	$speg_agama;
	$speg_biodata;

	parent::__construct();
		hak_akses(1);
		$this->speg_agama 	= 'speg_agama';
		$this->speg_biodata = 'speg_biodata';
    }
    
	public function index(){
		
    }
    
    public function bio(){
		if($this->uri->segment(3) == "create"){
			$arr = array(
				'nama_biodata' 		=> $this->input->post('nama_biodata'),
				'jkelamin_biodata'  => $this->input->post('jkelamin_biodata'),
				'tmplahir_biodata'  => $this->input->post('tmplahir_biodata'),
				'tglahir_biodata' 	=> $this->input->post('tglahir_biodata'),
				'alamat_biodata' 	=> $this->input->post('alamat_biodata'),
				'kontak_biodata' 	=> $this->input->post('kontak_biodata'),
				'surel_biodata' 	=> $this->input->post('surel_biodata'),
				'id_agama'	 		=> $this->input->post('id_agama'),
				'id_user'	 		=> 0
			);
			$this->crud->create($this->speg_biodata,$arr);
			redirect('/master/bio');
		} else {
			$data['agama'] 		= $this->crud->read($this->speg_agama);
			$data['biodata'] 	= $this->crud->read($this->speg_biodata);
			$this->template->display('master/bio',$data);
		}
	}
	public function test(){
		$q = $this->crud->read_fields('speg_user');
		print_r($q);
		$v = $q[0];
		echo $v;
	}
}
