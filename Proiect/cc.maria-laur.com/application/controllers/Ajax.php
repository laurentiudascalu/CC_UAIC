<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	public function index($id=0){
		if($this->uri->segment(2)!=''){
			$op=$this->uri->segment(2);
		}
		if($this->input->post('op')){
			$op=$this->input->post('op');
		}

		/*start helper*/
		if($op=='del'){
			$this->db->from($this->input->post('tb'));
			$this->db->where($this->input->post('ce'),$this->input->post('id'));
			$this->db->set('del',$this->user->id);
			$this->db->update();

			if($this->input->post('tb') == 'galerie_poze'){
				$this->db->from($this->input->post('tb'));
				$this->db->where('id',$this->input->post('id'));
				$poza=$this->db->get();
				$poza=$poza->row();

				@unlink(FCPATH.'galerii/'.$poza->nume);
				@unlink(FCPATH.'galerii/'.$poza->nume_thumb);
			}
		}

		/*end helper*/
		
		if($op=='getArticole'){
			$res=array();
			$this->db->from('produse');
			$this->db->like('denumire',trim($this->input->post('val')));
			$this->db->where('del','0');
			$art=$this->db->get();
			if($art->num_rows()>0){
				$i=0;
				foreach ($art->result_array() as $row) {
					$res[$i]['text']=$row['denumire'];
					$res[$i]['id']=$row['id'];
					$res[$i]['pret']=$row['pret_vz'];
					$res[$i]['um']=$row['um'];
					$i++;
				}
			}else{
				$res[0]['text']=$this->input->post('val');
				$res[0]['id']=0;
				$res[0]['pret']='0.00';
				$res[0]['um']='BUC';
			}
			
			print_r(json_encode($res));
		}
		if($op=='arr'){
			if($this->uri->segment(3)=='producatori'){
				$result=array(
					'1'=>'Adidas',
					'2'=>'Nike',
					'3'=>'Puma'
				);
				if($this->uri->segment(4)!=''){
					$result['selected']=$this->uri->segment(4);
				}
			}
			echo json_encode($result);	
		}
		if($op=='update'){
			$this->db->from($this->input->post('tabel'));
			$this->db->where('id',$this->input->post('id'));
			$this->db->set($this->input->post('camp'),$this->input->post('val'));
			$this->db->update();
		}
		if($op=='jedit'){
			$dt=dec($this->input->post('ce'));
			$val=$this->input->post('value');
			$id='id';
			if(isset($dt[3])){
				$id=$dt[3];
			}
			$this->db->from($dt[0]);
			$this->db->where($id,$dt[1]);
			$this->db->set($dt[2],$val);
			$this->db->update();
			if($this->input->post('extra')){
				$ex=json_decode($this->input->post('extra'), true);
				echo $ex[$val];
			}else{
				echo $val;
			}
		}
		if($op=='adaugaLinieAviz'){
			$data=array();
			$data=$this->input->post();
			$data['denumire']=trim($data['denumire']);
			$this->db->from('produse');
			$this->db->like('denumire',$data['denumire']);
			$this->db->where('del','0');
			$art=$this->db->get();
			if(($art->num_rows()==0 || $data['id']>0) && $data['denumire']!=''){
				$this->db->from('produse');
				$this->db->set('denumire',$data['denumire']);
				$this->db->set('pret_vz',$data['pret']);
				$this->db->set('um',$data['um']);
				if($data['id']>0){
					$this->db->where('id',$data['id']);
					$this->db->update();
				}else{
					$this->db->set('cod',$this->set['cod_produs']);
					$this->db->insert();
					$data['id']=$this->db->insert_id();
					$this->set['cod_produs']=$this->mod->updateSet('cod_produs');
				}
			}
			$this->db->from('avize_produse');
			$this->db->set('nume',$data['denumire']);
			$this->db->set('um',$data['um']);
			$this->db->set('qty',$data['qty']);
			$this->db->set('pret',$data['pret']);
			$this->db->set('id_produs',$data['id']);
			$this->db->set('id_aviz','0');
			$this->db->insert();
			$data['id_aviz_pr']=$this->db->insert_id();
			$this->load->view('ajax/adaugaLinieAviz',$data);
		}

		if($op=='cautaProdusAviz'){
			$result='';
			if($this->input->post('care')!=''){
				$cautat=$this->mod->getProduse(-1,$this->input->post('care'));
				if($cautat->num_rows()>0){ $i=0;
					foreach ($cautat->result_array() as $row) { $i++;
						$result.='<tr id="articol'.$i.'"><td><input type="hidden" name="artCautat" class="artCautat" value="'.$row['id'].'"/>';
						$result.='</td><td>'.form_input('numeCautat',$row['denumire'],'class="form-control numeCautat" placeholder="Specificatia"');
						$result.='</td><td>'.form_input('umCautat',$row['um'],'class="form-control umCautat" placeholder="UM"');
						$result.='</td><td>'.form_input('qtyCautat','1.00','class="form-control qtyCautat" placeholder="Cantitate"');
						$result.='</td><td>'.form_input('pretCautat',$row['pret_vz'],'class="form-control pretCautat" placeholder="Pret / buc"');
						$result.='</td><td>'.form_input('valCautat',$row['pret_vz'],'class="form-control valCautat" disabled placeholder="Pret total"');
						$result.='</td><td class="tc"><span class="text-success submitLinieForm" onclick="adaugaArticolAviz(\'#articol'.$i.'\');"><i class="fas fa-plus-circle"></i></span></td></tr>';
					}
				}
			}
			$result.='<tr id="articol0"><td><input type="hidden" name="artCautat" class="artCautat" value=""/>';
			$result.='</td><td>'.form_input('numeCautat','','class="form-control numeCautat" placeholder="Specificatia"');
			$result.='</td><td>'.form_input('umCautat','BUC','class="form-control umCautat" placeholder="UM"');
			$result.='</td><td>'.form_input('qtyCautat','1.00','class="form-control qtyCautat" placeholder="Cantitate"');
			$result.='</td><td>'.form_input('pretCautat','','class="form-control pretCautat" placeholder="Pret"');
			$result.='</td><td>'.form_input('valCautat','','class="form-control valCautat" disabled placeholder="Pret total"');
			$result.='</td><td class="tc"><span class="text-success submitLinieForm" onclick="adaugaArticolAviz(\'#articol0\');"><i class="fas fa-plus-circle"></i></span></td></tr>';
			echo $result;
		}
	}
}
