<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	/*
	* DOSPEG CLASS
	* AUTHOR  : MOCH DIKI WIDIANTO
	* NOTES   : 
    */

	private $speg_agama, $speg_biodata, $speg_user, $speg_data_golgaji, $speg_data_tunjangan, $speg_data_potongan, $speg_data_unit, $speg_data_jabatan, $speg_data_karyawan, $speg_jabatan_karyawan;

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
			$data['title'] = "Data Semua";

			$this->template->display('karyawan/angkat',$data);
		}
	}

    public function jabstruk(){
		$data['unit'] 		= $this->crud->read($this->speg_data_unit);
		if($this->uri->segment(3) == "new"){
			$data['karyawan'] 	= $this->crud->read($this->speg_data_karyawan);
			$data['jab'] 		= $this->crud->read($this->speg_data_jabatan);

			$this->template->display('karyawan/jabstruk_new',$data);
		}elseif($this->uri->segment(3) == "sort"){
			$arr = array(
				'kode_unit' => $this->uri->segment(4)
			);
			$rd = $this->crud->read_cond_bool($this->speg_data_unit,$arr);
			if($rd == FALSE){redirect('karyawan/angkat');}
			
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
		}else {
			$data['get'] = $this->crud->read($this->speg_jabatan_karyawan);
			$data['title'] = 'Data Semua';

			$this->template->display('karyawan/jabstruk',$data);
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

	
	public function test(){
		$q = $this->crud->read_fields('speg_user');
		print_r($q);
		$v = $q[0];
		echo $v;
	}
}
