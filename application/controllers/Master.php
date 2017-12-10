<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	/*
	* MASTER CLASS
	* AUTHOR  : MOCH DIKI WIDIANTO
	* NOTES   : A2
    */
	public function __construct() {
	parent::__construct();
		hak_akses(1);
    }
    
	public function index(){
		
    }
    
    public function bio(){
		
    }
}
