<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller {

	/*
	* DASBOR CLASS
	* AUTHOR  : MOCH DIKI WIDIANTO
	* NOTES   : A1
	*/
	public function __construct() {
	parent::__construct();
		
	}
	public function index(){
		if($this->session->has_userdata('user')){
			$this->template->display('dasbor/administrator');
		} else {
			redirect('/login');
		}
	}
}
