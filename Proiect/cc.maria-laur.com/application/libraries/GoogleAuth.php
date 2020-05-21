<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class GoogleAuth {
	private $GOOGLE_CLIENT_ID='926080693319-hgtlvphm19ap6c0mu25fg9b7no5domcl.apps.googleusercontent.com';
	private $GOOGLE_CLIENT_SECRET='ipr-7L3nFyjZXgdP-ne9h3Np';
	private $GOOGLE_CLIENT_REDIRECT_URL='http://cc.maria-laur.com/callbackgoogle';
	function getAuthUrl(){
		return 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode($this->GOOGLE_CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . urlencode($this->GOOGLE_CLIENT_ID) . '&access_type=online';
	}
	function checkAnswer($key){
		$return[0]=false;
		$return[1]='';
		 $url = 'https://www.googleapis.com/oauth2/v4/token';            

        $curlPost = 'client_id=' . urlencode($this->GOOGLE_CLIENT_ID) . '&redirect_uri=' . urlencode($this->GOOGLE_CLIENT_REDIRECT_URL) . '&client_secret=' . urlencode($this->GOOGLE_CLIENT_SECRET) . '&code='. urlencode( $key) . '&grant_type=authorization_code';
        $ch = curl_init();      
        curl_setopt($ch, CURLOPT_URL, $url);        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
        curl_setopt($ch, CURLOPT_POST, 1);      
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);    
        $res1 = json_decode(curl_exec($ch), true);
        if(!@$res1['error']){
        	$access_token=$res1['access_token'];

	        $url = 'https://www.googleapis.com/oauth2/v2/userinfo?fields=*';  
	    
	        $ch = curl_init();      
	        curl_setopt($ch, CURLOPT_URL, $url);        
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));
	        $user_info = json_decode(curl_exec($ch), true);
	        if($user_info['email']){
	        	$return[0]=FALSE;
	        	$return[1]=$user_info;
	        } else {
	        	$return[0]=TRUE;
        		$return['1']='Nu avem acces la o adresa de e-mail. Nu putem crea contul dvs.';
	        }
        } else {
        	$return[0]=TRUE;
        	$return['1']='A aparut o problema la autentificare';
        }
        return $return;
	}
}