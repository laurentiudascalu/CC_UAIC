<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index(){
		$this->load->library('GoogleAuth');
		$this->load->library('MicrosoftAuth');
		$data['user']=$this->session->flashdata('user');
		$this->load->view('login/login.php',$data);
	}
	function callbackgoogle(){
		$this->load->library('GoogleAuth');
       	$rasp=$this->googleauth->checkAnswer($_GET['code']);
       	if($rasp[0]==TRUE){
        	$this->session->set_flashdata('mesajNU', $rasp[1]);
	        redirect('login');
	    } else {
	        if($rasp[1]['email']){
	            $usr=$this->mod->getUseri(-1, $rasp[1]['email']);
	            if($usr->num_rows()==1){
	                $usr=$usr->row();
	                $this->mod->autentifica($usr->mail,$usr->pass);
	            } else {
	                $passs=random_string('nozero',5);
	                $this->db->from('useri');
					$this->db->set('tel','-');
					$this->db->set('mail',$rasp[1]['email']);
					$this->db->set('nume',$rasp[1]['name']);
					$this->db->set('pass',$passs);
					$this->db->insert();

					$this->db->from('user_cookie');
					$this->db->set('cookie',$this->cookie);
					$this->db->set('id_user',$this->db->insert_id());
					$this->db->insert();
	            }
	        }
	        $this->session->set_flashdata('mesajDA','Contul a fost creat si auentificarea s-a facut cu succes!');
	        redirect('');
	    }
    }
	function callbackmicrosoft(){
		$this->load->library('MicrosoftAuth');
       	$rasp=$this->microsoftauth->checkAnswer($_GET['code']);
       	if($rasp[0]==TRUE){
        	$this->session->set_flashdata('mesajNU', $rasp[1]);
	        redirect('login');
	    } else {
	    	$email=@$rasp[1]['mail'];
	    	if($email=='' || $email==NULL){
	    		$email=$rasp[1]['userPrincipalName'];
	    	}
	        if($email){
	            $usr=$this->mod->getUseri(-1, $email);
	            if($usr->num_rows()==1){
	                $usr=$usr->row();
	                $this->mod->autentifica($usr->mail,$usr->pass);
	            } else {
	                $passs=random_string('nozero',5);
	                $this->db->from('useri');
					$this->db->set('tel','-');
					$this->db->set('mail',$email);
					$this->db->set('nume',$rasp[1]['displayName']);
					$this->db->set('pass',$passs);
					$this->db->insert();

					$this->db->from('user_cookie');
					$this->db->set('cookie',$this->cookie);
					$this->db->set('id_user',$this->db->insert_id());
					$this->db->insert();
	            }
	        }
	        $this->session->set_flashdata('mesajDA','Contul a fost creat si auentificarea s-a facut cu succes!');
	        redirect('');
	    }
    }
	public function contNou(){
		$data['nume']=$this->session->flashdata('nume');
		$data['mail']=$this->session->flashdata('mail');
		$data['tel']=$this->session->flashdata('tel');
		$this->load->view('login/contNou.php',$data);
	}
	public function recuperareParola(){
		$this->load->view('login/recuperareParola.php');
	}
	public function delogare(){
		$this->db->from('user_cookie');
		$this->db->where('cookie',$this->cookie);
		$this->db->set('del',$this->user->id);
		$this->db->update();
		delete_cookie('login');
		redirect('login');
	}
	public function p(){
		if($this->input->post('recuperare')){
			$this->session->set_flashdata('user',$this->input->post('user'));
			$ck=$this->mod->getUser(-1,$this->input->post('user'));
			if($ck->num_rows()>0){
				$user=$ck->row();
				$sub='Recuperare parola '.base_url();
				$txt='Ati solicitat trimiterea parole pe mail pe site-ul <a href="'.base_url().'">'.base_url().'</a> Parola dumneavoastra este '.$user->pass.' Pentru a intra in cont folositi link-ul <a href="'.site_url('login').'">'.site_url('login').'</a>';
				$this->mod->trimiteMail($user->mail,$sub,$txt);
				$this->session->set_flashdata('mesajNU','Un mail cu parola a fost trimis pe adresa de email a contului dumneavoastra.');
				redirect('login');
			}
			$this->session->set_flashdata('mesajNU','Nu exista nici un cont activ cu aceste date.');
			redirect('recuperare-parola');
		}
		if($this->input->post('login')){
			$this->session->set_flashdata('user',$this->input->post('user'));
			if($this->input->post('user')!='-'){
				if($this->mod->autentifica($this->input->post('user'),$this->input->post('parola'))){
					$this->session->set_flashdata('mesajDA','Te-ai autentificat cu succes!');
					redirect('');
				}else{
					$this->session->set_flashdata('mesajNU','Date de autentificare gresite.');
				}
			}else{
				$this->session->set_flashdata('mesajNU','Date de autentificare gresite.');
			}
			redirect('login');
		}
		if($this->input->post('inregistrare')){
			$this->session->set_flashdata('nume',$this->input->post('nume'));
			$this->session->set_flashdata('mail',$this->input->post('mail'));
			$this->session->set_flashdata('tel',$this->input->post('tel'));
			if($this->input->post('nume')!='' && $this->input->post('mail')!='' && $this->input->post('tel')!='' && $this->input->post('parola')!='' && $this->input->post('reParola')!=''){
				if(valid_email($this->input->post('mail')) && strlen($this->input->post('tel'))>9 && strlen($this->input->post('nume'))>2 && strlen($this->input->post('parola'))>5){
					if($this->input->post('parola')==$this->input->post('reParola')){
						$this->db->select('*');
						$this->db->from('useri');
						$this->db->group_start();
						$this->db->where('tel',$this->input->post('tel'));
						$this->db->or_where('mail',$this->input->post('mail'));
						$this->db->group_end();
						$this->db->where('del','0');
						$us=$this->db->get();
						if($us->num_rows()==0){
							$this->db->from('useri');
							$this->db->set('tel',$this->input->post('tel'));
							$this->db->set('mail',$this->input->post('mail'));
							$this->db->set('nume',$this->input->post('nume'));
							$this->db->set('pass',$this->input->post('parola'));
							$this->db->insert();
							
							$this->db->from('user_cookie');
							$this->db->set('cookie',$this->cookie);
							$this->db->set('id_user',$this->db->insert_id());
							$this->db->insert();
							
							$this->session->set_flashdata('mesajDA','Contul a fost creat si auentificarea s-a facut cu succes!');
							
							redirect('');
						}else{
							$this->session->set_flashdata('mesajNU','Adresa de mail si/sau numarul de telefon exista deja in baza de date.');
						}
					}else{
						$this->session->set_flashdata('mesajNU','Parolele nu se potrivesc.');
					}
				}else{
					$this->session->set_flashdata('mesajNU','Datele introduse nu sunt corecte.');
				}		
			}else{
				$this->session->set_flashdata('mesajNU','Toate campurile sunt obligatorii.');
			}
			redirect('cont-nou');
		}
		redirect('');
	}
}
