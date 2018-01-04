<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans extends CI_Controller {

	/*
	* DOSPEG CLASS
	* AUTHOR  : MOCH DIKI WIDIANTO
	* NOTES   : 
    */

	private $speg_agama, $speg_biodata, $speg_user, $speg_data_golgaji, $speg_data_tunjangan, $speg_data_potongan, $speg_data_unit, $speg_data_jabatan, $speg_data_karyawan, $speg_jabatan_karyawan, $speg_supervisi, $speg_golgaji_karyawan, $speg_tunjangan_karyawan, $speg_hgolgaji_karyawan, $speg_potongan_karyawan, $speg_gaji_karyawan, $speg_transaksi_k;

	public function __construct() {
	parent::__construct();
		hak_akses(1);
		$this->speg_agama 				= 'speg_agama';
		$this->speg_biodata 			= 'speg_biodata';
		$this->speg_user 				= 'speg_user';
		$this->speg_data_golgaji 		= 'speg_data_golgaji';
		$this->speg_data_tunjangan 		= 'speg_data_tunjangan';
		$this->speg_data_potongan 		= 'speg_data_potongan';
		$this->speg_data_unit	 		= 'speg_data_unit';
        $this->speg_data_jabatan 		= 'speg_data_jabatan';
        $this->speg_data_karyawan 		= 'speg_data_karyawan';
        $this->speg_jabatan_karyawan	= 'speg_jabatan_karyawan';
        $this->speg_golgaji_karyawan	= 'speg_golgaji_karyawan';
		$this->speg_hgolgaji_karyawan   = 'speg_hgolgaji_karyawan';
		$this->speg_supervisi			= 'speg_supervisi';
		$this->speg_tunjangan_karyawan 	= 'speg_tunjangan_karyawan';
		$this->speg_potongan_karyawan	= 'speg_potongan_karyawan';
		$this->speg_gaji_karyawan		= 'speg_gaji_karyawan';
		$this->speg_transaksi_k			= 'speg_transaksi_k';
    }
    
	public function index(){
		
    }
	
	public function bgkar(){
		if($this->uri->segment(3) == "new"){
			$this->template->display('trans/bgkar_new');
		}elseif($this->uri->segment(3) == "create"){
			$kt = clean($this->input->post('kode_transaksi_k'));
			if(empty($kt)){redirect('trans/bgkar');}
			$r = $this->crud->read_numrows($this->speg_transaksi_k,array('kode_transaksi_k'=>$kt));
			if($r >= 1){redirect('trans/bgkar');}

			$hr = (is_numeric($this->input->post('hrkj_transaksi_k')) ? $this->input->post('hrkj_transaksi_k') : 0);

			$arr = array(
				'kode_transaksi_k'	=> $kt,
				'nama_transaksi_k'  => $this->input->post('nama_transaksi_k'),
				'hrkj_transaksi_k'	=> $hr,
			);
			
			$this->crud->nat_create($this->speg_transaksi_k,$arr);
			redirect('trans/bgkar');
		}elseif($this->uri->segment(3) == "update"){
			if(empty($this->uri->segment(4))){redirect('trans/bgkar');}
			$exp 	= explode('=',$this->uri->segment(4));
			$arg0 	= $this->crud->read_cond_bool($this->speg_transaksi_k,array('id_transaksi_k' => $exp[0],'kode_transaksi_k' => $exp[1]));
			if($arg0 == FALSE){redirect('trans/bgkar');}
			$hr = (is_numeric($this->input->post('hrkj_transaksi_k')) ? $this->input->post('hrkj_transaksi_k') : 0);
			$arr1	= array(
				'nama_transaksi_k'  => $this->input->post('nama_transaksi_k'),
				'hrkj_transaksi_k'	=> $hr,
			);
			$arr2	= array(
				'id_transaksi_k' => $exp[0],
				'kode_transaksi_k' => $exp[1]
			);
			
			$this->crud->nat_update($this->speg_transaksi_k,$arr1,$arr2);
			redirect('trans/bgkar');
		}elseif($this->uri->segment(3) == "delete"){
			if(empty($this->uri->segment(4))){redirect('trans/bgkar');}
			$exp 	= explode('=',$this->uri->segment(4));
			$arg0 	= $this->crud->read_cond_bool($this->speg_transaksi_k,array('id_transaksi_k' => $exp[0],'kode_transaksi_k' => $exp[1]));
			if($arg0 == FALSE){redirect('trans/bgkar');}
			$arr	= array(
				'id_transaksi_k' => $exp[0],
				'kode_transaksi_k' => $exp[1]
			);

			$this->crud->nat_delete($this->speg_gaji_karyawan,array('id_transaksi_k'=>$exp[0]));
			$this->crud->nat_delete($this->speg_tunjangan_karyawan,array('id_transaksi_k'=>$exp[0]));
			$this->crud->nat_delete($this->speg_potongan_karyawan,array('id_transaksi_k'=>$exp[0]));
			$this->crud->nat_delete($this->speg_transaksi_k,$arr);
			redirect('trans/bgkar');
		}elseif($this->uri->segment(3) == "transaction"){
			foreach($_POST['a'] as $d){
				$this->crud->nat_create($this->speg_gaji_karyawan,$d);
			}
			foreach($_POST['b'] as $d){
				$this->crud->nat_create($this->speg_tunjangan_karyawan,$d);
			}
			foreach($_POST['c'] as $d){
				$this->crud->nat_create($this->speg_potongan_karyawan,$d);
			}
			redirect('trans/bgkar/payroll/'.$_POST['uri']);
		}elseif($this->uri->segment(3) == "transaction_edit"){
			$a = $this->input->post('vtype');
			$b = $this->input->post('vidk');
			$c = $this->input->post('vtype_id');
			$d = $this->input->post('vseg4');
			$e = $this->input->post('nominal');

			if(empty($a) || empty($b) || empty($c) || empty($d)){redirect('trans/bgkar');}
			
			$arr1 = array(
				'nominal' => $e
			);

			if($a == "tunj"){
				$arr2 = array(
					'id_tunjangan_karyawan' => $c
				);
				$this->crud->nat_update($this->speg_tunjangan_karyawan,$arr1,$arr2);
			}elseif($a == "ptng"){
				$arr2 = array(
					'id_potongan_karyawan' => $c
				);
				$this->crud->nat_update($this->speg_potongan_karyawan,$arr1,$arr2);
			}else{
				redirect('trans/bgkar');
			}
			redirect('trans/bgkar/payroll/'.$d.'/edit/'.$b);
		}elseif($this->uri->segment(3) == "edit"){
			if(empty($this->uri->segment(4))){redirect('trans/bgkar');}
			$exp 	= explode('=',$this->uri->segment(4));
			$arg0 	= $this->crud->read_cond_bool($this->speg_transaksi_k,array('id_transaksi_k' => $exp[0],'kode_transaksi_k' => $exp[1]));
			if($arg0 == FALSE){redirect('trans/bgkar');}
			
			$arr	= array(
				'id_transaksi_k' => $exp[0],
				'kode_transaksi_k' => $exp[1]
			);

			$data['edit'] = $this->crud->read_cond($this->speg_transaksi_k,$arr);
			$this->template->display('trans/bgkar_edit',$data);
		}elseif($this->uri->segment(3) == "payroll"){
			if(empty($this->uri->segment(4))){redirect('trans/bgkar');}
			$exp 	= explode('=',$this->uri->segment(4));
			$arg0 	= $this->crud->read_cond_bool($this->speg_transaksi_k,array('id_transaksi_k' => $exp[0],'kode_transaksi_k' => $exp[1]));
			if($arg0 == FALSE){redirect('trans/bgkar');}

			$arr	= array(
				'status_karyawan' => 'A'
			);
			
			$ts = $this->crud->read_cond($this->speg_transaksi_k,array('id_transaksi_k'=>$exp[0]));
			$data['title'] = $ts[0]['nama_transaksi_k'];
			$data['get'] = $this->crud->read_query('SELECT t1.* FROM speg_data_karyawan AS t1 INNER JOIN speg_golgaji_karyawan AS t2 ON t1.id_karyawan = t2.id_karyawan AND t1.status_karyawan = "A"');
			$data['id_trans'] = $exp[0];

			if($this->uri->segment(5) == "reset"){
				$arg1 = $this->uri->segment(6);
				if(empty($arg1)){redirect('trans/bgkar');}
				$arr3 = array(
					'id_karyawan'    => $arg1,
					'id_transaksi_k' => $exp[0]
 				);
				$this->crud->nat_delete($this->speg_tunjangan_karyawan,$arr3);
				$this->crud->nat_delete($this->speg_potongan_karyawan,$arr3);
				$this->crud->nat_delete($this->speg_gaji_karyawan,$arr3);

				redirect('trans/bgkar/payroll/'.$this->uri->segment(4));
			} elseif ($this->uri->segment(5) == "pay"){
				$arg1 = $this->uri->segment(6);
				$arrpre  = array(
					'id_transaksi_k' => $exp[0],
					'id_karyawan'   => $arg1,
				); 
				$preload1 = $this->crud->read_numrows($this->speg_gaji_karyawan,$arrpre);
				$preload2 = $this->crud->read_numrows($this->speg_tunjangan_karyawan,$arrpre);
				$preload3 = $this->crud->read_numrows($this->speg_potongan_karyawan,$arrpre);
				if($preload1 > 0 || $preload2 > 0 || $preload3 > 0){redirect('trans/bgkar');}

				$arg2 = $this->crud->read_cond_bool($this->speg_golgaji_karyawan,array('id_karyawan'=>$arg1));
				if(empty($arg1) || $arg2 == FALSE){redirect('trans/bgkar');}
				
				$data['id_k'] = $arg1;
				$data['id_t'] = $exp[0];
				$data['dt_t'] = date('Y-m-d H:i:s');

				$arr_e = $this->crud->read_cond($this->speg_golgaji_karyawan,array('id_karyawan' => $arg1));
				
				$cg = $this->crud->read_numrows($this->speg_data_golgaji,array('kode_golgaji'=>$arr_e[0]['kode_golgaji']));
				if($cg == 0){
					$idg = array(
						0 => array(
							'kode_golgaji' 		=> '-',
							'nama_golgaji'		=> 'Belum didaftarkan Gaji Golongannya',
							'nominal_golgaji' 	=> 0,
							'rev_golgaji' 		=> 0
						)
					);
				} else {
					$idg = $this->crud->read_query('SELECT a.* FROM ( SELECT kode_golgaji, MAX(rev_golgaji) AS rev FROM speg_data_golgaji GROUP BY kode_golgaji ) AS b INNER JOIN speg_data_golgaji AS a ON a.kode_golgaji = b.kode_golgaji AND a.rev_golgaji = b.rev WHERE a.kode_golgaji = "'.$arr_e[0]['kode_golgaji'].'"');
				}
				
				$data['a'] = $idg;
				$data['b'] = $this->crud->read($this->speg_data_tunjangan);
				$data['c'] = $this->crud->read($this->speg_data_potongan);
				$data['d'] = $this->uri->segment(4);
				
				$this->template->display('trans/bgkar_pay',$data);
			} elseif ($this->uri->segment(5) == "edit"){
				$arg1 = $this->uri->segment(6);
				$arrpre  = array(
					'id_transaksi_k' => $exp[0],
					'id_karyawan'   => $arg1,
				); 
				$preload1 = $this->crud->read_numrows($this->speg_gaji_karyawan,$arrpre);
				$preload2 = $this->crud->read_numrows($this->speg_tunjangan_karyawan,$arrpre);
				$preload3 = $this->crud->read_numrows($this->speg_potongan_karyawan,$arrpre);
				if($preload1 == 0 || $preload2 == 0 || $preload3 == 0){redirect('trans/bgkar');}

				$arg2 = $this->crud->read_cond_bool($this->speg_golgaji_karyawan,array('id_karyawan'=>$arg1));
				if(empty($arg1) || $arg2 == FALSE){redirect('trans/bgkar');}
				
				$arr = array(
					'id_karyawan' 	 => $arg1,
					'id_transaksi_k' => $exp[0],
				);
				
				$data['id_k'] = $arg1;
				$data['id_t'] = $exp[0];
				$data['a'] = $this->crud->read_cond($this->speg_gaji_karyawan,$arr);
				$data['b'] = $this->crud->read_cond($this->speg_tunjangan_karyawan,$arr);
				$data['c'] = $this->crud->read_cond($this->speg_potongan_karyawan,$arr);
				$data['d'] = $this->uri->segment(4);

				$this->template->display('trans/bgkar_pay_edit',$data);
			} else {
				
				$this->template->display('trans/bgkar_payroll',$data);
			}
		}else{
			$data['get'] = $this->crud->read($this->speg_transaksi_k);
			$data['title'] = "Semua";

			$this->template->display('trans/bgkar',$data);
		}
	}
}
