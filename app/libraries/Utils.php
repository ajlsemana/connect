<?php
class Utils {

    public function __construct(){
    
    }
    
    public static function generateCode($length = 8, $symbols = TRUE) {
	    $alphabets_lowercase = range('a', 'z');
	    $alphabets_uppercase = range('A', 'Z');
	    $numbers = range('0', '9');

	    $additional_characters = array();
	    if ($symbols) {
	    	$additional_characters = array('!','@','#','$','%','^','&','*','.');
	    }

	    $final_array = array_merge($alphabets_lowercase, $alphabets_uppercase, $numbers, $additional_characters);
	         
	    $code = '';
	  
	    while($length--) {
	      $key = array_rand($final_array);
	      $code .= $final_array[$key];
	    }
	  
	    return $code;
	}

    public static function URLExist($url){
	    $ch = curl_init($url);    
	    curl_setopt($ch, CURLOPT_NOBODY, true);
	    $curl_response = curl_exec($ch);
	    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	    if($code == 200){
	       $status = true;
	    }else{
	      $status = false;
	    }
	    curl_close($ch);
	    
	   	return $status;
	}
}
