<?php defined('BASEPATH') OR exit('No direct script access allowed');
Class Mod extends CI_Model{
	var $count=0;
	var $order='id';
	var $asc='desc';
	function __construct(){
		parent::__construct();
		
	}
	function trimiteMail($to,$sub,$txt,$attach='',$cc='',$bcc=''){
		$this->load->library('email');

		$config['mailtype'] = 'html';
		$config['protocol'] = 'smtp';
		$config['charset'] = 'utf-8';
		$config['smtp_crypto'] = 'ssl';
		$config['smtp_host'] = $this->set['mail_host'];
		$config['smtp_user'] = $this->set['mail_user'];
		$config['smtp_pass'] = $this->set['mail_pass'];
		$config['smtp_port'] = $this->set['mail_port'];

		$this->email->initialize($config);
		$this->email->from($this->set['mail_from'],$this->set['mail_name']);
		$this->email->to($to);
		$this->email->subject($sub);
		$this->email->message($txt);

		if($attach!='' && file_exists($attach)){
			$this->email->attach($attach);
		}

		if($cc!=''){
			$this->email->cc($cc);
		}

		if($bcc!=''){
			$this->email->bcc($bcc);
		}

		return $this->email->send();
	}
	function apeleaza($nume,$param=array()){
		if(is_object($param)){
			$param=(array)$param;
		}
		$args=array();
		$refFunc = new ReflectionMethod('Mod',$nume);
		foreach($refFunc->getParameters() as $pr){
			if(!isset($param[$pr->getName()])){
				if(!$pr->isOptional()){
					echo $pr->getName().' este obligatoriu!'; exit;
				}
				$args[$pr->getName()]=$pr->getDefaultValue();
			}else{
				$args[$pr->getName()]=$param[$pr->getName()];
			}
			
		}
		if($refFunc->isClosure()){//Nu are return
			$refFunc->invokeArgs(new Mod(),$args);
		}else{
			return $refFunc->invokeArgs(new Mod(),$args);
		}
		
	}
	function getMod(){
		if($this->count){
			$this->count=0;
			return $this->db->count_all_results();
		}else{
			$this->db->order_by($this->order,$this->asc);
			return $this->db->get();
		}
	}
	function getUserLogat($cookie){
		$user= new stdClass();
		$user->id=0;
		$user->admin=0;
		
		$this->db->select('*');
		$this->db->from('user_cookie');
		$this->db->where('cookie',$cookie);
		$this->db->where('del','0');
		$userId=$this->db->get();
		
		if($userId->num_rows()==1){
			$userRow=$this->getUser($userId->row('id_user'));
			$user=$userRow->row();
		}
		
		return $user;
	}
	function autentifica($user,$parola){
		if($user!='' && $parola!=''){
			$this->db->select('*');
			$this->db->from('useri');
			$this->db->group_start();
			$this->db->where('tel',$user);
			$this->db->or_where('mail',$user);
			$this->db->group_end();
			$this->db->where('pass',$parola);
			$us=$this->db->get();
			if($us->num_rows()==1){
				$this->db->from('user_cookie');
				$this->db->set('cookie',$this->cookie);
				$this->db->set('id_user',$us->row('id'));
				$this->db->insert();
				return true;
			}
		}
		return FALSE;
	}
	function getUser($id=-1,$user=''){
		$this->db->select('*');
		$this->db->from('useri');
		$this->db->wherea('id',-1,$id);
		if($user != ''){
			$this->db->group_start();
			$this->db->where('mail',$user);
			$this->db->or_where('tel',$user);
			$this->db->group_end();
		}
		
		$this->db->where('del','0');
		return $this->getMod();
	}
	function getUseri($id=-1,$mail=''){
		$this->db->select('*');
		$this->db->from('useri');
		$this->db->wherea('id',-1,$id);
		$this->db->wherea('mail','',$mail);
		$this->db->where('del','0');
		$this->db->order_by('id','ASC');
		return $this->getMod();
	}
	function getSet($id=-1,$arr=1){
		$res=array();
		$this->db->select('*');
		$this->db->from('setari');
		$this->db->wherea('id',-1,$id);
		$this->db->where('del','0');
		if($arr==1){
			$set=$this->db->get();
			foreach ($set->result_array() as $row) {
				$res[$row['set']]=$row['val'];
			}
			return $res;
		}else{
			return $this->getMod();
		}
		
	}
	function updateSet($set){
		$this->db->select('*');
		$this->db->from('setari');
		$this->db->where('set',$set);
		$old=$this->db->get();
		$old=$old->row();

		$this->db->from('setari');
		$this->db->where('set',$set);
		$this->db->set('val',($old->val+1));
		$this->db->update();
		return $old->val+1;
	}
	function getCategorii($id=-1,$tip='',$tip_key=''){
		$res=array();
		$this->db->select('*');
		$this->db->from('categorii');
		$this->db->wherea('id',-1,$id);
		$this->db->wherea('tip','',$tip);
		$this->db->wherea('tip_key','',$tip_key);
		$this->db->where('del','0');
		return $this->getMod();
	}
}
?>