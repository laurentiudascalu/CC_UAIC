<?php defined('BASEPATH') OR exit('No direct script access allowed');
function checklogin(){
	//inceput logare
	$CI=& get_instance();
	$exceptii=array('login','cont-nou','recuperare-parola','callbackgoogle','callbackmicrosoft');
	$exceptiiCron=array('test','cron');
	$exceptiiAdmin=array('categorii','categorie');
	
	$log=get_cookie('login');
	if (!$log){
		$unic=random_string('unique'); 
		$cookie = array('name'   => 'login', 'value'  => $unic, 'expire' => 60*60*24*365*10);
		set_cookie($cookie);
		$log=$unic;
	}
	$CI->cookie=$log;
	$CI->user=$CI->mod->getUserLogat($log);
	//print_r($CI->user); exit;
	if(!in_array($CI->uri->segment(1),$exceptiiCron)){
		if($CI->user->id==0 && !in_array($CI->uri->segment(1),$exceptii)){
			$CI->session->set_flashdata('mesajNU','Nu sunteti autentificat!');
			redirect('login');
		}elseif($CI->user->id!=0 && in_array($CI->uri->segment(1),$exceptii)){
			$CI->session->set_flashdata('mesajNU','Deja sunteti autentificat!');
			redirect('');
		}elseif($CI->user->admin==0 && in_array($CI->uri->segment(1),$exceptiiAdmin)){
			$CI->session->set_flashdata('mesajNU','Nu aveti drepturi pentru a accesa aceasta zona!');
			redirect('');
		}
	}
	
	
	//sfarsit logare
	$CI->set=$CI->mod->getSet();
}
?>