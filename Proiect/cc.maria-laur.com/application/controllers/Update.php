<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {
	public function index(){
		$coloane=$this->db->list_fields($this->input->post('tabel'));

		if($this->input->post('exceptie')){
			if($this->input->post('exceptie')=='categoriiUser'){

			}
			$this->db->from($this->input->post('tabel'));
			foreach ($coloane as $row) {
				if($this->input->post($row) && $row!='id'){
					if($row=='carti'){
						$this->db->set($row,$this->input->post($row));
					}else{
						$this->db->set($row,json_encode($this->input->post($row)));
					}
				}
			}

			$this->db->where('id',$this->input->post('id'));
			$this->db->update();
			$id=$this->input->post('id');

			$this->session->set_flashdata('mesajDA','Modificarile au fost realizate cu succes.');
		}else{
			$this->db->from($this->input->post('tabel'));
			if((in_array('pass', $coloane) && $this->input->post('pass')==$this->input->post('repass')) || (!(in_array('pass', $coloane)))){
				foreach ($coloane as $row) {
					if($this->input->post($row) && $row!='id'){
						$this->db->set($row,$this->input->post($row));	
					}
				}
			}
			
			if($this->input->post('id')){
				$this->db->where('id',$this->input->post('id'));
				$this->db->update();
				$id=$this->input->post('id');
			}else{
				$this->db->insert();
				$id=$this->db->insert_id();
			}

			$this->session->set_flashdata('mesajDA','Modificarile au fost realizate cu succes.');
		}	
		
		if(in_array($this->input->post('link'),array('categorie'))){//exceptii
			redirect($this->input->post('link').'/'.$id);
		}else{
			redirect($this->input->post('link'));
		}	
	}
}
