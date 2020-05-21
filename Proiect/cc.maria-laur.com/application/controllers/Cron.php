<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
	public function index(){
		$us=$this->mod->getUseri();
		foreach ($us->result_array() as $row) {
			$ok=0;
			$Mimagini='';
			$Mretete='';
			$Mstiri='';
			$Mvideo='';
			$Minformatii='';
			$preferinte=(array)json_decode($row['imagini']);
			if(!empty($preferinte)){
				$param=array(
					'key' => '15388720-95ad479de116bb16dacdca76d',
					'image_type' => 'photo',
					'per_page' => '3',
					'category' => $preferinte[array_rand($preferinte)]
				);
				$imagini=getPageContent('https://pixabay.com/api/?'.http_build_query($param));
				$imagini=json_decode($imagini);
				if(!empty($imagini)){
					$ok=1;
					$Mimagini='';
				}
			}
			
			$preferinte=(array)json_decode($row['retete']);
			if(!empty($preferinte)){
				$param=array(
					'c' => $preferinte[array_rand($preferinte)]
				);
				$retete=getPageContent('https://www.themealdb.com/api/json/v1/1/filter.php?'.http_build_query($param));
				$retete=json_decode($retete);
				if(!empty($retete)){
					$ok=1;
					$Mretete='';
				}
			}
			
			$preferinte=(array)json_decode($row['stiri']);
			if(!empty($preferinte)){
				$param=array(
					'apiKey' => '4cba649cd40341c381d6d1dc7e1b1852',
					'category' => $preferinte[array_rand($preferinte)]
				);
				$stiri=getPageContent('https://newsapi.org/v2/top-headlines?'.http_build_query($param));
				$stiri=json_decode($stiri);
				if(!empty($stiri)){
					$ok=1;
					$Mstiri='';
				}
			}
			
			$preferinte=(array)json_decode($row['video']);
			if(!empty($preferinte)){
				$param=array(
					'key' => 'AIzaSyABM4lAkIs9anQ4qQPEWhYssVtj2Tm9YoI',
					'part' => 'snippet',
					'chart' => 'mostPopular',
					'videoCategoryId' => $preferinte[array_rand($preferinte)]
				);	
				$video=getPageContent('https://www.googleapis.com/youtube/v3/videos?regionCode=ro&'.http_build_query($param));
				$video=json_decode($video);
				if(!empty($video)){
					$ok=1;
					$Mvideo='';
				}
			}

			$preferinte=(array)json_decode($row['informatii']);
			if(!empty($preferinte)){
				$param=array(
					'key' => 'AIzaSyAwtOYtml2ls_i7VUdiFI_Qo2yyem6NE5k',
					'query' => 'new',
					'types' => $preferinte[array_rand($preferinte)]
				);

				$informatii=getPageContent('https://kgsearch.googleapis.com/v1/entities:search?'.http_build_query($param));
				$informatii=json_decode($informatii);
				if(!empty($informatii)){
					$ok=1;
					$Minformatii='';
				}
			}

			if($ok){
				$sub='YourStuff - Noutatile saptamanale';
				$mesaj='Acestea sunt noutatile tale saptamanele din platforma YourStuff:<br/><br/>';
				$mesaj.=$Mimagini.$Mretete.$Mstiri.$Mvideo.$Minformatii;
				$mesaj.='Cu stima,<br/>';
				$mesaj.='Echipa YourStuff';

				$this->db->from('notificari');
				$this->db->set('id_user',$row['id']);
				$this->db->set('mail',$row['mail']);
				$this->db->set('subiect',$sub);
				$this->db->set('mesaj',$mesaj);
				$this->db->insert();

				$this->mod->trimiteMail($row['mail'],$sub,$mesaj);
			}

			/*if($row['carti']){
				$param=array(
					'q' => $str
				);
				$carti=getPageContent('https://www.googleapis.com/books/v1/volumes?'.http_build_query($param));
				$carti=json_decode($carti);
			}*/
			
		}
		
		echo 'da'; exit;
	}
}