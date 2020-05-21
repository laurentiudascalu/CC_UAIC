<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MicrosoftAuth {
	private $MICROSOFT_CLIENT_ID='4bd179de-1fb0-4b49-80aa-0a0f361bf5c0';
	private $MICROSOFT_CLIENT_SECRET='0_TcM9p9D48JPEiwzo11_WqS90Ukp_dh_-';
	private $MICROSOFT_CLIENT_REDIRECT_URL='https://cc.maria-laur.com/callbackmicrosoft';
	function getAuthUrl(){
		return 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize?client_id=' . urlencode($this->MICROSOFT_CLIENT_ID). '&redirect_uri=' . urlencode($this->MICROSOFT_CLIENT_REDIRECT_URL).'&response_type=code&scope=User.Read';
	}
	function checkAnswer($key){
		$return[0]=false;
		$return[1]='';
		 $url = 'https://login.microsoftonline.com/common/oauth2/v2.0/token';            

        $curlPost = 'client_id=' . urlencode($this->MICROSOFT_CLIENT_ID) . '&redirect_uri=' . urlencode($this->MICROSOFT_CLIENT_REDIRECT_URL) . '&client_secret=' . urlencode($this->MICROSOFT_CLIENT_SECRET) . '&code='. urlencode( $key) . '&grant_type=authorization_code';
        $ch = curl_init();      
        curl_setopt($ch, CURLOPT_URL, $url);        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
        curl_setopt($ch, CURLOPT_POST, 1);      
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);    
        $res1 = json_decode(curl_exec($ch), true);
        if(!@$res1['error']){
        	$access_token=$res1['access_token'];

	        $url = 'https://graph.microsoft.com/v1.0/me';  
	    
	        $ch = curl_init();      
	        curl_setopt($ch, CURLOPT_URL, $url);        
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));
	        $user_info = json_decode(curl_exec($ch), true);
	        if($user_info['email'] || $user_info['userPrincipalName']){
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