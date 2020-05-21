<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
	public function index($filtru = ''){
		$data=array();
		if($filtru != ''){
			$filtru = urldecode($filtru);
			$filtru = explode(SEP, $filtru);
			$data['cautat'] = $filtru[0];
			$data['tip'] = $filtru[1];
			$str = $data['cautat'];
			if($data['tip'] == 'carti'){
				$param=array(
					'q' => $str
				);
				$data['carti']=getPageContent('https://www.googleapis.com/books/v1/volumes?'.http_build_query($param));
				$data['carti']=json_decode($data['carti']);
				//print_r($data['carti']);
			}elseif($data['tip'] == 'imagini'){
				$param=array(
				'key' => '15388720-95ad479de116bb16dacdca76d',
				'q' => $str,
				'image_type' => 'photo',
				'per_page' => '4'
				//'category' => array('business','food'),
				);
				$data['imagini']=getPageContent('https://pixabay.com/api/?'.http_build_query($param));
				$data['imagini']=json_decode($data['imagini']);
				//print_r($data['imagini']);
			}elseif($data['tip'] == 'retete'){
				$param=array(
					'key' => '1',
					's' => $str
				);
				$data['retete']=getPageContent('https://www.themealdb.com/api/json/v1/1/search.php?'.http_build_query($param));
				$data['retete']=json_decode($data['retete']);
				//print_r($data['retete']);
			}elseif($data['tip'] == 'stiri'){
				$param=array(
					'apiKey' => '4cba649cd40341c381d6d1dc7e1b1852',
					'q' => $str
				);
				$data['stiri']=getPageContent('https://newsapi.org/v2/everything?'.http_build_query($param));
				$data['stiri']=json_decode($data['stiri']);
				//print_r($data['stiri']);
			}elseif($data['tip'] == 'video'){
				$param=array(
					'key' => 'AIzaSyABM4lAkIs9anQ4qQPEWhYssVtj2Tm9YoI',
					'q' => $str
				);	
				$data['video']=getPageContent('https://www.googleapis.com/youtube/v3/search?'.http_build_query($param));
				$data['video']=json_decode($data['video']);
				//print_r($data['video']);
			}elseif($data['tip'] == 'informatii'){
				$param=array(
					'key' => 'AIzaSyAwtOYtml2ls_i7VUdiFI_Qo2yyem6NE5k',
					'query' => $str
				);

				$data['informatii']=getPageContent('https://kgsearch.googleapis.com/v1/entities:search?'.http_build_query($param));
				$data['informatii']=json_decode($data['informatii']);
				//print_r($data['informatii']);
			}
		}
		
		$this->load->view('home', $data);
	}
	public function contulTau(){
		$res=$this->mod->getCategorii();
		foreach ($res->result_array() as $row) {
			$data[$row['tip'].'Cat'][$row['tip_key']]=$row['categorie'];
		}
		$data['cartiCat']['0']='NU';
		$data['cartiCat']['1']='DA';
		$this->load->view('contul-tau',$data);
	}
	public function categorii(){
		$data['categorii'] = $this->mod->getCategorii(-1);
		$this->load->view('categorii', $data);
	}
	public function categorie($id){
		$data['title'] = 'Adauga categorie';
 		if ($id > 0){
 			$data['title'] = 'Modifica categorie';
			$data['categorie'] = $this->mod->getCategorii($id);
			$data['categorie'] = $data['categorie']->row();
		}
		$this->load->view('categorie', $data);
	}
	public function notificari(){
		$data['notificari'] = $this->mod->getNotificari(-1, $this->user->id);
		$this->load->view('notificari', $data);
	}
	public function p(){
		if($this->input->post('cauta')){
			$cautat = $this->input->post('cautat');
			$tip = $this->input->post('tip');
			$link = base_url().'cauta/'.urlencode($cautat.SEP.$tip);
			redirect($link);
		}
	}
}
