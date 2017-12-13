<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/*
	* LOGIN CLASS
	* AUTHOR  : MOCH DIKI WIDIANTO
	* NOTES   : A2
	*/
	
	public $table;

	public function __construct() {
		parent::__construct();
		$this->table = 'speg_user';
	}

	public function index(){
		if($this->session->has_userdata('user')){
			redirect('/');
		}
		$this->load->view('halaman_masuk');
	}

	public function attempt(){
		$pass 	 	= $this->input->post('password');
		$md5pass 	= md5($pass); // MD4
		$username 	= $this->input->post('username');
		$data = array(
			'nama_user' 	=> $username,
			'sandi_user' 	=> $md5pass,
			'status_user'   => 'Y'
			);
			
		$result = $this->crud->read_cond_bool($this->table,$data);
		if($result == TRUE){
			$d = $this->crud->read_cond($this->table,$data);
			$session_data = array(
				'id_user' 		=> $d[0]['id_user'],
				'nama_user' 	=> $d[0]['nama_user'],
				'level_user'	=> $d[0]['level_user'],
				'tmasuk_user'	=> date("Y-m-d H:i:s"),
				'phscr_user'	=> $d[0]['phscr_user'],
				'id_biodata'	=> $d[0]['id_biodata'],
				'status_user'	=> $d[0]['status_user']
			);
			
			$this->crud->update($this->table,array('tmasuk_user' => date("Y-m-d H:i:s")),array('id_user' => $d[0]['id_user']),$d[0]['id_user']);

			// Add user data in session
			$this->session->set_userdata('user', $session_data);
			redirect('/');
		} else {
			redirect('/');
		}
	}
}
