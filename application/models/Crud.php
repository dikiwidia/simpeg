<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Model {

    public function create($table,$arr) {
		/*--------------------------------
		Keterangan :
		- $table 	= tabel tujuan
		- $arr		= data bentuk array
		---------------------------------*/
		$this->db->insert($table,$arr);
    }
    
	public function delete($table,$arr) {
		/*--------------------------------
		Keterangan :
		- $table 	= tabel tujuan
		- $arr		= data bentuk array
		---------------------------------*/
		$this->db->delete($table,$arr);
    }
    
	public function update($table,$arr1,$arr2) {
		/*--------------------------------
		Keterangan :
		- $table 	= tabel tujuan
		- $arr1		= 'data' bentuk array
		- $arr2		= 'where' bentuk array
		---------------------------------*/
		$this->db->update($table,$arr1,$arr2);
    }
    
	public function read($table) {
		/*--------------------------------
		Keterangan :
		- $table 	= tabel tujuan
		---------------------------------*/
		$this->db->select('*');
		$q = $this->db->get($table);
		$r = $q->result_array();
		return $r;
    }
    
	public function read_cond($table,$arr) {
		/*--------------------------------
		Keterangan :
		- $table 	= tabel tujuan
		- $arr		= 'data' bentuk array
		---------------------------------*/
		$this->db->select('*');
		$this->db->where($arr);
		$q = $this->db->get($table);
		$r = $q->result_array();
		return $r;
    }
    
	public function read_max($table,$field) {
		/*--------------------------------
		Keterangan :
		- $table 	= tabel tujuan
		- $field	= field yang dipilih
		---------------------------------*/
		$this->db->select_max($field);
		$q = $this->db->get($table);
		$r = $q->result_array();
		return $r;
    }
    
	public function read_min($table,$field) {
		/*--------------------------------
		Keterangan :
		- $table 	= tabel tujuan
		- $field	= field yang dipilih
		---------------------------------*/
		$this->db->select_min($field);
		$q = $this->db->get($table);
		$r = $q->result_array();
		return $r;
    }
    
	public function read_join($table1,$field1,$table2,$field2) {
		/*--------------------------------
		Keterangan :
		- $table1 	= tabel tujuan #1
		- $field1	= field yang dipilih #1
		- $table2 	= tabel tujuan #2
		- $field2	= field yang dipilih #2
		---------------------------------*/
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, ''.$table2.'.'.$field2.'='.$table1.'.'.$field1.'');
		$q = $this->db->get();
		$r = $q->result_array();
		return $r;
    }
    
	public function read_bool($table) {
		/*--------------------------------
		Keterangan :
		- $table 	= tabel tujuan
		---------------------------------*/
		$this->db->select('*');
		$this->db->from($table);
		$q = $this->db->get();
		$r = $q->num_rows();
		if($r > 0){
			return TRUE;
		} else {
			return FALSE;
		}
    }
    
	public function read_cond_bool($table,$arr){
		/*--------------------------------
		Keterangan :
		- $table 	= tabel tujuan
		- $arr		= data yang dipilih
		---------------------------------*/
		$q = $this->db->get_where($table,$arr);
		$r = $q->num_rows();
		if($r == 1){
			return TRUE;
		} else {
			return FALSE;
		}
    }
    
    public function read_custom($query){
        $q = $this->db->query($query);
        $r = $q->result_array();
        return $r;
    }
}
