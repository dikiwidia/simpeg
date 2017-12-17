<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dospeg extends CI_Controller {

	/*
	* DOSPEG CLASS
	* AUTHOR  : MOCH DIKI WIDIANTO
	* NOTES   : 
    */

	private $speg_agama, $speg_biodata, $speg_user, $speg_data_golgaji, $speg_data_tunjangan, $speg_data_potongan, $speg_data_unit, $speg_data_jabatan, $speg_jabatan_karyawan;

	public function __construct() {
	parent::__construct();
		hak_akses(1);
		$this->speg_agama 			= 'speg_agama';
		$this->speg_biodata 		= 'speg_biodata';
		$this->speg_user 			= 'speg_user';
		$this->speg_data_golgaji 	= 'speg_data_golgaji';
		$this->speg_data_tunjangan 	= 'speg_data_tunjangan';
		$this->speg_data_potongan 	= 'speg_data_potongan';
		$this->speg_data_unit	 	= 'speg_data_unit';
        $this->speg_data_jabatan 	= 'speg_data_jabatan';
        $this->speg_jabatan_karyawan= 'speg_jabatan_karyawan';
    }
    
	public function index(){
		
    }
    
    public function jabstruk(){
		if($this->uri->segment(3) == "new"){
            $data['edit_bio']	= $this->crud->read_cond($this->speg_biodata,$arr);
			$data['agama'] 		= $this->crud->read($this->speg_agama);
			
			$this->template->display('dospeg/bio_update',$data);
			//redirect('/dospeg/jabstruk');
		}elseif($this->uri->segment(3) == "create"){
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
		}  else {
			$data['get'] = $this->crud->read($this->speg_jabatan_karyawan);
			
			$this->template->display('dospeg/jabstruk',$data);
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
			$r = $this->crud->read_numrows($this->speg_data_golgaji,array('kode_golgaji'=>$this->input->post('kode_golgaji')));
			if($r >= 1){redirect('/master/gaji');}
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
			
			$data['edit']	= $this->crud->read_cond($this->speg_data_golgaji,$arr);
			
			$this->template->display('master/gaji_update',$data);
		} elseif($this->uri->segment(3) == "update"){
			if($this->input->post('kode_golgaji') && empty($this->uri->segment(4))){redirect('/master/gaji');}
			$arr = array(
				'kode_golgaji' 		=> $this->input->post('kode_golgaji'),
				'nama_golgaji'  	=> $this->input->post('nama_golgaji'),
				'nominal_golgaji'   => $this->input->post('nominal_golgaji'),
				'rev_golgaji'	 	=> $this->input->post('rev_golgaji')+1
			);
			
			$this->crud->create($this->speg_data_golgaji,$arr);
			redirect('/master/gaji');
		} else {
			$q = 'SELECT a.* FROM ( SELECT nama_golgaji, MAX(rev_golgaji) AS rev FROM speg_data_golgaji GROUP BY nama_golgaji ) AS b INNER JOIN speg_data_golgaji AS a ON a.nama_golgaji = b.nama_golgaji AND a.rev_golgaji = b.rev';
			$data['gaji'] = $this->crud->read_query($q);
			$this->template->display('master/gaji',$data);
		}
	}

	public function tunjangan(){
		if($this->uri->segment(3) == "create"){
			if(empty($this->input->post('nama_tunjangan'))){redirect('/master/tunjangan');}
			$arr = array(
				'nama_tunjangan' 	=> $this->input->post('nama_tunjangan'),
				'ket_tunjangan'		=> $this->input->post('ket_tunjangan')
			);
			
			$this->crud->create($this->speg_data_tunjangan,$arr);
			redirect('/master/tunjangan');
		} elseif($this->uri->segment(3) == "edit"){
			if(empty($this->uri->segment(4))){redirect('/master/tunjangan');}
			
			$arr = array(
				'id_tunjangan' 		=> $this->uri->segment(4)
			);
			
			if($this->crud->read_cond_bool($this->speg_data_tunjangan,$arr) == FALSE){redirect('/master/tunjangan');}
			$data['edit']	= $this->crud->read_cond($this->speg_data_tunjangan,$arr);
			
			$this->template->display('master/tunjangan_update',$data);
		} elseif($this->uri->segment(3) == "update"){
			if(empty($this->input->post('nama_tunjangan')) && empty($this->uri->segment(4))){redirect('/master/tunjangan');}
			$arr1 = array(
				'nama_tunjangan' 	=> $this->input->post('nama_tunjangan'),
				'ket_tunjangan'		=> $this->input->post('ket_tunjangan')
			);
			$arr2 = array(
				'id_tunjangan'		=> $this->uri->segment(4)
			);
			
			$this->crud->update($this->speg_data_tunjangan,$arr1,$arr2,$this->uri->segment(4));
			redirect('/master/tunjangan');
		} else {
			$data['get'] 	= $this->crud->read($this->speg_data_tunjangan);
			
			$this->template->display('master/tunjangan',$data);
		}
	}

	public function potongan(){
		if($this->uri->segment(3) == "create"){
			if(empty($this->input->post('nama_potongan'))){redirect('/master/potongan');}
			$arr = array(
				'nama_potongan' 	=> $this->input->post('nama_potongan'),
				'ket_potongan'		=> $this->input->post('ket_potongan')
			);
			
			$this->crud->create($this->speg_data_potongan,$arr);
			redirect('/master/potongan');
		} elseif($this->uri->segment(3) == "edit"){
			if(empty($this->uri->segment(4))){redirect('/master/potongan');}
			
			$arr = array(
				'id_potongan' 		=> $this->uri->segment(4)
			);
			
			if($this->crud->read_cond_bool($this->speg_data_potongan,$arr) == FALSE){redirect('/master/potongan');}
			$data['edit']	= $this->crud->read_cond($this->speg_data_potongan,$arr);
			
			$this->template->display('master/potongan_update',$data);
		} elseif($this->uri->segment(3) == "update"){
			if(empty($this->input->post('nama_potongan')) && empty($this->uri->segment(4))){redirect('/master/potongan');}
			$arr1 = array(
				'nama_potongan' 	=> $this->input->post('nama_potongan'),
				'ket_potongan'		=> $this->input->post('ket_potongan')
			);
			$arr2 = array(
				'id_potongan'		=> $this->uri->segment(4)
			);
			
			$this->crud->update($this->speg_data_potongan,$arr1,$arr2,$this->uri->segment(4));
			redirect('/master/potongan');
		} else {
			$data['get'] 	= $this->crud->read($this->speg_data_potongan);
			
			$this->template->display('master/potongan',$data);
		}
	}

	public function jabstruk(){
		if($this->uri->segment(3) == "create"){
			if(empty($this->input->post('nama_jabatan'))){redirect('/master/jabstruk');}
			$arr = array(
				'nama_jabatan' 	=> $this->input->post('nama_jabatan'),
				'level_jabatan'	=> $this->input->post('level_jabatan'),
				'ket_jabatan'	=> $this->input->post('ket_jabatan')
			);
			
			$this->crud->create($this->speg_data_jabatan,$arr);
			redirect('/master/jabstruk');
		} elseif($this->uri->segment(3) == "edit"){
			if(empty($this->uri->segment(4))){redirect('/master/jabstruk');}
			
			$arr = array(
				'id_jabatan'	=> $this->uri->segment(4)
			);
			
			if($this->crud->read_cond_bool($this->speg_data_jabatan,$arr) == FALSE){redirect('/master/jabstruk');}
			$data['edit']	= $this->crud->read_cond($this->speg_data_jabatan,$arr);
			
			$this->template->display('master/jabstruk_update',$data);
		} elseif($this->uri->segment(3) == "update"){
			if(empty($this->input->post('nama_jabatan')) && empty($this->uri->segment(4))){redirect('/master/unit');}
			$arr1 = array(
				'nama_jabatan' 	=> $this->input->post('nama_jabatan'),
				'level_jabatan'	=> $this->input->post('level_jabatan'),
				'ket_jabatan'	=> $this->input->post('ket_jabatan')
			);
			$arr2 = array(
				'id_jabatan'	=> $this->uri->segment(4)
			);
			
			$this->crud->update($this->speg_data_jabatan,$arr1,$arr2,$this->uri->segment(4));
			redirect('/master/jabstruk');
		} else {
			$data['get'] 	= $this->crud->read($this->speg_data_jabatan);
			
			$this->template->display('master/jabstruk',$data);
		}
	}

	public function unit(){
		if($this->uri->segment(3) == "create"){
			if(empty($this->input->post('nama_unit'))){redirect('/master/unit');}
			$arr = array(
				'nama_unit' 	=> $this->input->post('nama_unit'),
				'ket_unit'		=> $this->input->post('ket_unit')
			);
			
			$this->crud->create($this->speg_data_unit,$arr);
			redirect('/master/unit');
		} elseif($this->uri->segment(3) == "edit"){
			if(empty($this->uri->segment(4))){redirect('/master/unit');}
			
			$arr = array(
				'id_unit' 		=> $this->uri->segment(4)
			);
			
			if($this->crud->read_cond_bool($this->speg_data_unit,$arr) == FALSE){redirect('/master/unit');}
			$data['edit']	= $this->crud->read_cond($this->speg_data_unit,$arr);
			
			$this->template->display('master/unit_update',$data);
		} elseif($this->uri->segment(3) == "update"){
			if(empty($this->input->post('nama_unit')) && empty($this->uri->segment(4))){redirect('/master/unit');}
			$arr1 = array(
				'nama_unit' 	=> $this->input->post('nama_unit'),
				'ket_unit'		=> $this->input->post('ket_unit')
			);
			$arr2 = array(
				'id_unit'		=> $this->uri->segment(4)
			);
			
			$this->crud->update($this->speg_data_unit,$arr1,$arr2,$this->uri->segment(4));
			redirect('/master/unit');
		} else {
			$data['get'] 	= $this->crud->read($this->speg_data_unit);
			
			$this->template->display('master/unit',$data);
		}
	}

	public function test(){
		$q = $this->crud->read_fields('speg_user');
		print_r($q);
		$v = $q[0];
		echo $v;
	}
}
