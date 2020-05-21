<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	public function index(){
		$str='';
		if($this->uri->segment(2)!=''){
			$str=$this->uri->segment(2);
		}

		echo 'da'; exit;
		
		$res=$this->mod->getCategorii(-1,'retete');
		foreach ($res->result_array() as $row) {
			$this->db->from('categorii');
			$this->db->where('id',$row['id']);
			$this->db->set('tip_key',$row['categorie']);
			$this->db->update();
		}

		echo 'da'; exit;
	}
}