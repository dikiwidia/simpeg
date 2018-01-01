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
			
			$this->crud->create($this->speg_transaksi_k,$arr);
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
			
			$this->crud->update($this->speg_transaksi_k,$arr1,$arr2,$exp[0]);
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

			$this->crud->delete($this->speg_transaksi_k,$arr,$exp[0]);
			redirect('trans/bgkar');
		}elseif($this->uri->segment(3) == "transaction"){
			foreach($_POST['a'] as $d){
				$this->crud->create($this->speg_gaji_karyawan,$d);
			}
			foreach($_POST['b'] as $d){
				$this->crud->create($this->speg_tunjangan_karyawan,$d);
			}
			foreach($_POST['c'] as $d){
				$this->crud->create($this->speg_potongan_karyawan,$d);
			}
			redirect('trans/bgkar/payroll/'.$_POST['uri']);
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
			$data['get'] = $this->crud->read_cond($this->speg_data_karyawan,$arr);
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
				if(empty($arg1)){redirect('trans/bgkar');}
				
				$data['id_k'] = $arg1;
				$data['id_t'] = $exp[0];
				$data['dt_t'] = date('Y-m-d H:i:s');

				$arr_e = $this->crud->read_cond($this->speg_golgaji_karyawan,array('id_karyawan' => $arg1));
				
				$idg = $this->crud->read_query('SELECT a.* FROM ( SELECT kode_golgaji, MAX(rev_golgaji) AS rev FROM speg_data_golgaji GROUP BY kode_golgaji ) AS b INNER JOIN speg_data_golgaji AS a ON a.kode_golgaji = b.kode_golgaji AND a.rev_golgaji = b.rev WHERE a.kode_golgaji = "'.$arr_e[0]['kode_golgaji'].'"');
				
				$data['a'] = $idg;
				$data['b'] = $this->crud->read($this->speg_data_tunjangan);
				$data['c'] = $this->crud->read($this->speg_data_potongan);
				$data['d'] = $this->uri->segment(4);
				$this->template->display('trans/bgkar_pay',$data);
			} else {
				
				$this->template->display('trans/bgkar_payroll',$data);
			}
		}else{
			$data['get'] = $this->crud->read($this->speg_transaksi_k);
			$data['title'] = "Semua";

			$this->template->display('trans/bgkar',$data);
		}
	}

	//ABAIKAN
	public function test(){
		$z = $this->speg_data_tunjangan;
		$a = $this->crud->read($z);
		$n = 0;
		echo form_open('karyawan/test2', 'class="form-horizontal form-label-left input_mask" autocomplete="off"');
		foreach($a as $a){
			echo "<input type='text' name='data[".$n."][id_tunjangan]' value='".$a['id_tunjangan']."' /> <input type='text' name='data[".$n."][id_karyawan]'/> <input type='text' name='data[".$n."][nominal_tunjangan_karyawan]'/> <input type='text' name='data[".$n."][tgl_trans_tunjangan_karyawan]' value='".date('Y-m-d H:i:s')."' /><br>";
			$n++;
		}
		echo "<br /><button type='submit'>SUBMIT</button>";
		echo form_close();
		echo "<pre>";
		print_r($a);
		echo "</pre>";
	}

	public function test2(){
		foreach($_POST['data'] as $d){
			$this->crud->create($this->speg_tunjangan_karyawan,$d);
		}
	}
}
