<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	/*
	* DOSPEG CLASS
	* AUTHOR  : MOCH DIKI WIDIANTO
	* NOTES   : 
    */

	private $speg_agama, $speg_biodata, $speg_user, $speg_data_golgaji, $speg_data_tunjangan, $speg_data_potongan, $speg_data_unit, $speg_data_jabatan, $speg_data_karyawan, $speg_jabatan_karyawan, $speg_supervisi, $speg_golgaji_karyawan;

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
        $this->speg_data_karyawan 	= 'speg_data_karyawan';
        $this->speg_jabatan_karyawan= 'speg_jabatan_karyawan';
        $this->speg_golgaji_karyawan= 'speg_golgaji_karyawan';
        $this->speg_supervisi		= 'speg_supervisi';
    }
    
	public function index(){
		
    }
	
	public function angkat(){
		if($this->uri->segment(3) == "new"){
			$data['biodata'] = $this->crud->read_query("SELECT t1.* FROM speg_biodata t1 LEFT JOIN speg_data_karyawan t2 ON t2.id_biodata = t1.id_biodata WHERE t2.id_biodata IS NULL");
			$this->template->display('karyawan/angkat_new',$data);
		}elseif($this->uri->segment(3) == "create"){
			if(empty($this->input->post('id_biodata'))){redirect('karyawan/angkat');}
			$arr = array(
				'id_biodata' 		=> $this->input->post('id_biodata'),
				'nosk_karyawan'		=> $this->input->post('nosk_karyawan'),
				't_m_karyawan' 		=> $this->input->post('t_m_karyawan'),
				't_p_karyawan'		=> $this->input->post('t_p_karyawan'),
				'status_karyawan'	=> $this->input->post('status_karyawan')
			);
			
			$this->crud->create($this->speg_data_karyawan,$arr);
			redirect('karyawan/angkat');
		}elseif($this->uri->segment(3) == "update"){
			if(empty($this->input->post('status_karyawan'))){redirect('karyawan/angkat');}
			$arr1 = array(
				'nosk_karyawan'		=> $this->input->post('nosk_karyawan'),
				't_m_karyawan' 		=> $this->input->post('t_m_karyawan'),
				't_p_karyawan'		=> $this->input->post('t_p_karyawan'),
				'status_karyawan'	=> $this->input->post('status_karyawan')
			);
			$arr2 = array(
				'id_karyawan'		=> $this->uri->segment(4)
			);
			
			$this->crud->update($this->speg_data_karyawan,$arr1,$arr2,$this->uri->segment(4));
			redirect('karyawan/angkat');
		}elseif($this->uri->segment(3) == "delete"){
			if(empty($this->uri->segment(4))){redirect('karyawan/angkat');}
			$arr = array(
				'id_karyawan' 		=> $this->uri->segment(4),
			);
			$rd = $this->crud->read_cond_bool($this->speg_data_karyawan,$arr);
			if($rd == FALSE){redirect('karyawan/angkat');}
			
			$this->crud->delete($this->speg_data_karyawan,$arr,$this->uri->segment(4));
			redirect('karyawan/angkat');
		}elseif($this->uri->segment(3) == "edit"){
			if(empty($this->uri->segment(4))){redirect('karyawan/angkat');}

			$arr = array(
				'id_karyawan' 		=> $this->uri->segment(4),
			);
			$rd = $this->crud->read_cond_bool($this->speg_data_karyawan,$arr);
			if($rd == FALSE){redirect('karyawan/angkat');}
			
			$data['edit'] = $this->crud->read_cond($this->speg_data_karyawan,$arr);
			$this->template->display('karyawan/angkat_edit',$data);
		}elseif($this->uri->segment(3) == "sort"){
			if($this->uri->segment(4)=="a"){
				$a = "a";
				$data['title'] = "Data Karyawan Aktif";
			}elseif($this->uri->segment(4)=="p"){
				$a = "p";
				$data['title'] = "Data Karyawan Pensiun";
			}elseif($this->uri->segment(4)=="k"){
				$a = "k";
				$data['title'] = "Data Karyawan Keluar";
			}else{
				redirect('karyawan/angkat');
			}
			$arr = array(
				'status_karyawan' => $a
			);
			$data['get'] = $this->crud->read_cond($this->speg_data_karyawan,$arr);
			
			$this->template->display('karyawan/angkat',$data);
		}else{
			$data['get'] = $this->crud->read($this->speg_data_karyawan);
			$data['title'] = "Semua";

			$this->template->display('karyawan/angkat',$data);
		}
	}

    public function jabstruk(){
		$data['unit'] 		= $this->crud->read($this->speg_data_unit);
		//$data['karyawan'] 	= $this->crud->read($this->speg_data_karyawan);
		$data['jab'] 		= $this->crud->read($this->speg_data_jabatan);
		
		if($this->uri->segment(3) == "new"){
			$data['karyawan'] = $this->crud->read_cond($this->speg_data_karyawan,array('status_karyawan'=>'A'));

			$this->template->display('karyawan/jabstruk_new',$data);
		}elseif($this->uri->segment(3) == "edit"){
			if(empty($this->uri->segment(4))){redirect('karyawan/jabstruk');}
			$arr = array(
				'id_jabatan_karyawan' => $this->uri->segment(4)
			);
			if($this->crud->read_cond_bool($this->speg_jabatan_karyawan,$arr) == FALSE){redirect('karyawan/jabstruk');}
			$data['edit']	= $this->crud->read_cond($this->speg_jabatan_karyawan,$arr);
			
			$this->template->display('karyawan/jabstruk_edit',$data);
		}elseif($this->uri->segment(3) == "sort"){
			$arr = array(
				'kode_unit' => $this->uri->segment(4)
			);
			$rd = $this->crud->read_cond_bool($this->speg_data_unit,$arr);
			if($rd == FALSE){redirect('karyawan/jabstruk');}
			
			$rs = $this->crud->read_cond($this->speg_data_unit,$arr);

			$arr1 = array(
				'id_unit'   => $rs[0]['id_unit']
			);
			$data['get'] = $this->crud->read_cond($this->speg_jabatan_karyawan,$arr1);
			$data['title'] = $this->uri->segment(4);

			$this->template->display('karyawan/jabstruk',$data);
		}elseif($this->uri->segment(3) == "create"){
			if(empty($this->input->post('id_karyawan'))){redirect('karyawan/jabstruk');}
			$arr = array(
				'id_karyawan' => $this->input->post('id_karyawan')
			);
			if($this->crud->read_numrows($this->speg_data_karyawan,$arr) == 0){redirect('karyawan/jabstruk');}
			$arr = array(
				'id_karyawan' 				=> $this->input->post('id_karyawan'),
				'id_unit'					=> $this->input->post('id_unit'),
				'id_jabatan'				=> $this->input->post('id_jabatan'),
				'nosk_jabatan_karyawan'		=> $this->input->post('nosk_jabatan_karyawan'),
				'tgl_m_jabatan_karyawan'	=> $this->input->post('tgl_m_jabatan_karyawan'),
				'tgl_s_jabatan_karyawan'	=> $this->input->post('tgl_s_jabatan_karyawan'),
				'status_jabatan_karyawan'	=> $this->input->post('status_jabatan_karyawan')
			);
			
			$this->crud->create($this->speg_jabatan_karyawan,$arr);
			redirect('karyawan/jabstruk');
		}elseif($this->uri->segment(3) == "update"){
			if(empty($this->uri->segment(4))){redirect('karyawan/jabstruk');}
			$arr = array(
				'id_jabatan_karyawan' => $this->uri->segment(4)
			);
			if($this->crud->read_numrows($this->speg_jabatan_karyawan,$arr) == 0){redirect('karyawan/jabstruk');}
			$arr1 = array(
				'id_unit'					=> $this->input->post('id_unit'),
				'id_jabatan'				=> $this->input->post('id_jabatan'),
				'nosk_jabatan_karyawan'		=> $this->input->post('nosk_jabatan_karyawan'),
				'tgl_m_jabatan_karyawan'	=> $this->input->post('tgl_m_jabatan_karyawan'),
				'tgl_s_jabatan_karyawan'	=> $this->input->post('tgl_s_jabatan_karyawan'),
				'status_jabatan_karyawan'	=> $this->input->post('status_jabatan_karyawan')
			);
			$arr2 = array(
				'id_jabatan_karyawan'		=> $this->uri->segment(4)
			);

			$this->crud->update($this->speg_jabatan_karyawan,$arr1,$arr2,$this->uri->segment(4));
			redirect('karyawan/jabstruk');
		}elseif($this->uri->segment(3) == "delete"){
			if(empty($this->uri->segment(4))){redirect('karyawan/jabstruk');}
			$arr = array(
				'id_jabatan_karyawan' 		=> $this->uri->segment(4),
			);
			$rd = $this->crud->read_cond_bool($this->speg_jabatan_karyawan,$arr);
			if($rd == FALSE){redirect('karyawan/jabstruk');}
			
			$this->crud->delete($this->speg_jabatan_karyawan,$arr,$this->uri->segment(4));
			redirect('karyawan/jabstruk');
		}else {
			$data['get'] = $this->crud->read($this->speg_jabatan_karyawan);
			$data['title'] = 'Semua';

			$this->template->display('karyawan/jabstruk',$data);
		}
	}
	
	public function tugas(){
		if($this->uri->segment(3) == "delete"){
			if(empty($this->uri->segment(4))){redirect('karyawan/tugas');}
			$arr = array(
				'id_supervisi' 		=> $this->uri->segment(4),
			);
			$rd = $this->crud->read_cond_bool($this->speg_supervisi,$arr);
			if($rd == FALSE){redirect('karyawan/tugas');}
			
			$this->crud->delete($this->speg_supervisi,$arr,$this->uri->segment(4));
			redirect('karyawan/tugas');
		}else {
			$data['get'] = $this->crud->read($this->speg_supervisi);
			$data['title'] = 'Semua';

			$this->template->display('karyawan/tugas',$data);
		}
	}

	public function golgaji(){
		if($this->uri->segment(3) == "delete"){
			if(empty($this->uri->segment(4))){redirect('karyawan/tugas');}
			$arr = array(
				'id_supervisi' 		=> $this->uri->segment(4),
			);
			$rd = $this->crud->read_cond_bool($this->speg_supervisi,$arr);
			if($rd == FALSE){redirect('karyawan/tugas');}
			
			$this->crud->delete($this->speg_supervisi,$arr,$this->uri->segment(4));
			redirect('karyawan/tugas');
		}else {
			$data['get'] = $this->crud->read($this->speg_golgaji_karyawan);
			$data['title'] = 'Semua';

			$this->template->display('karyawan/golgaji',$data);
		}
	}

	public function test(){
		$q = $this->crud->read_fields('speg_user');
		print_r($q);
		$v = $q[0];
		echo $v;
	}
}
