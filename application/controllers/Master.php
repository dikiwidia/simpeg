<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	/*
	* MASTER CLASS
	* AUTHOR  : MOCH DIKI WIDIANTO
	* NOTES   : A3
    */

	private $speg_agama, $speg_biodata, $speg_user, $speg_data_golgaji;

	public function __construct() {
	parent::__construct();
		hak_akses(1);
		$this->speg_agama 			= 'speg_agama';
		$this->speg_biodata 		= 'speg_biodata';
		$this->speg_user 			= 'speg_user';
		$this->speg_data_golgaji 	= 'speg_data_golgaji';
    }
    
	public function index(){
		
    }
    
    public function bio(){
		if($this->uri->segment(3) == "create"){
			if(empty($this->input->post('nama_biodata'))){redirect('/master/bio');}
			if(date_validation($this->input->post('tglahir_biodata'))==FALSE){$dob = "1901-01-01";}
			else{$dob = $this->input->post('tglahir_biodata');}
			$arr = array(
				'nama_biodata' 		=> $this->input->post('nama_biodata'),
				'jkelamin_biodata'  => $this->input->post('jkelamin_biodata'),
				'tmplahir_biodata'  => $this->input->post('tmplahir_biodata'),
				'tglahir_biodata' 	=> $dob,
				'alamat_biodata' 	=> $this->input->post('alamat_biodata'),
				'kontak_biodata' 	=> $this->input->post('kontak_biodata'),
				'surel_biodata' 	=> $this->input->post('surel_biodata'),
				'id_agama'	 		=> $this->input->post('id_agama')
			);
			
			$this->crud->create($this->speg_biodata,$arr);
			redirect('/master/bio');
		} elseif($this->uri->segment(3) == "edit"){
			if(empty($this->uri->segment(4))){redirect('/master/bio');}
			
			$arr = array(
				'id_biodata' 		=> $this->uri->segment(4)
			);
			
			if($this->crud->read_cond_bool($this->speg_biodata,$arr) == FALSE){redirect('/master/bio');}
			
			$data['edit_bio']	= $this->crud->read_cond($this->speg_biodata,$arr);
			$data['agama'] 		= $this->crud->read($this->speg_agama);
			
			$this->template->display('master/bio_update',$data);
		} elseif($this->uri->segment(3) == "update"){
			if(empty($this->input->post('nama_biodata')) && empty($this->uri->segment(4))){redirect('/master/bio');}
			if(date_validation($this->input->post('tglahir_biodata'))==FALSE){$dob = "1901-01-01";}
			else{$dob = $this->input->post('tglahir_biodata');}
			$arr1 = array(
				'nama_biodata' 		=> $this->input->post('nama_biodata'),
				'jkelamin_biodata'  => $this->input->post('jkelamin_biodata'),
				'tmplahir_biodata'  => $this->input->post('tmplahir_biodata'),
				'tglahir_biodata' 	=> $dob,
				'alamat_biodata' 	=> $this->input->post('alamat_biodata'),
				'kontak_biodata' 	=> $this->input->post('kontak_biodata'),
				'surel_biodata' 	=> $this->input->post('surel_biodata'),
				'id_agama'	 		=> $this->input->post('id_agama')
			);
			$arr2 = array(
				'id_biodata'		=> $this->uri->segment(4)
			);
			
			$this->crud->update($this->speg_biodata,$arr1,$arr2,$this->uri->segment(4));
			redirect('/master/bio');
		} else {
			$data['agama'] 		= $this->crud->read($this->speg_agama);
			$data['biodata'] 	= $this->crud->read($this->speg_biodata);
			
			$this->template->display('master/bio',$data);
		}
	}

	public function user(){
		if($this->uri->segment(3) == "create"){
			$cond = $this->crud->read_cond_bool($this->speg_user,array('nama_user'=>$this->input->post('nama_user')));
			if(empty($this->input->post('nama_user')) || $cond == TRUE){
				redirect('/master/bio');
			} else {
				$arr = array(
					'nama_user' 	=> $this->input->post('nama_user'),
					'sandi_user'	=> md5($this->input->post('sandi_user')),
					'level_user' 	=> $this->input->post('level_user'),
					'phscr_user' 	=> '',
					'id_biodata' 	=> $this->input->post('id_biodata'),
					'status_user' 	=> 'N'
				);
				
				$this->crud->create($this->speg_user,$arr);
				redirect('/master/bio');
			}
		} else {
			redirect('/');
		}
	}

	public function gaji(){
		if($this->uri->segment(3) == "create"){
			if(empty($this->input->post('kode_golgaji'))){redirect('/master/gaji');}
			$arr = array(
				'kode_golgaji' 		=> $this->input->post('kode_golgaji'),
				'nama_golgaji'  	=> $this->input->post('nama_golgaji'),
				'nominal_golgaji'   => $this->input->post('nominal_golgaji'),
				'rev_golgaji'	 	=> 0
			);
			
			$this->crud->create($this->speg_data_golgaji,$arr);
			redirect('/master/gaji');
		} elseif($this->uri->segment(3) == "edit"){
			if(empty($this->uri->segment(4))){redirect('/master/gaji');}
			
			$arr = array(
				'id_golgaji' 		=> $this->uri->segment(4)
			);
			
			if($this->crud->read_cond_bool($this->speg_data_golgaji,$arr) == FALSE){redirect('/master/gaji');}
			
			$data['gaji']	= $this->crud->read_cond($this->speg_data_golgaji,$arr);
			
			$this->template->display('master/gaji_update',$data);
		} elseif($this->uri->segment(3) == "update"){
			if(empty($this->input->post('nama_biodata')) && empty($this->uri->segment(4))){redirect('/master/bio');}
			if(date_validation($this->input->post('tglahir_biodata'))==FALSE){$dob = "1901-01-01";}
			else{$dob = $this->input->post('tglahir_biodata');}
			$arr1 = array(
				'nama_biodata' 		=> $this->input->post('nama_biodata'),
				'jkelamin_biodata'  => $this->input->post('jkelamin_biodata'),
				'tmplahir_biodata'  => $this->input->post('tmplahir_biodata'),
				'tglahir_biodata' 	=> $dob,
				'alamat_biodata' 	=> $this->input->post('alamat_biodata'),
				'kontak_biodata' 	=> $this->input->post('kontak_biodata'),
				'surel_biodata' 	=> $this->input->post('surel_biodata'),
				'id_agama'	 		=> $this->input->post('id_agama')
			);
			$arr2 = array(
				'id_biodata'		=> $this->uri->segment(4)
			);
			
			$this->crud->update($this->speg_biodata,$arr1,$arr2,$this->uri->segment(4));
			redirect('/master/bio');
		} else {
			$data['gaji'] = $this->crud->read($this->speg_data_golgaji);
			$this->template->display('master/gaji',$data);
		}
	}

	public function test(){
		$q = $this->crud->read_fields('speg_user');
		print_r($q);
		$v = $q[0];
		echo $v;
	}
}
