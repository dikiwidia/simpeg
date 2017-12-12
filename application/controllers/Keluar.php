<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluar extends CI_Controller {

	/*
	* KELUAR CLASS
	* AUTHOR  : MOCH DIKI WIDIANTO
	* NOTES   : A4
	*/

	public function __construct() {
		parent::__construct();
		
	}
	public function index(){
		$this->session->sess_destroy();
		redirect('/');
	}
}
