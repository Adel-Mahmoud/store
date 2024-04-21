<?php

class Input {

  public function post($pram,$type=null){
  	if(isset($_POST[$pram])){
  	    $var = $_POST[$pram];
  	    if($type !== null){
  	        if($type=="length"){
  	            return strlen($var);
  	        }elseif($type=="number"){
  	            return filter_var($var,FILTER_SANTIZE_NUMBER_INT);
  	        }elseif($type== "email"){
  	            return filter_var($var,FILTER_SANTIZE_EMAIL);
  	        }elseif($type=="string"){
  	            return filter_var($var,FILTER_SANTIZE_STRING);	        
  	       }elseif($type=="html"){ 
  	            return htmlspecialchars($_POST[$pram]);
  	       }elseif($type=="slash"){
  	            return stripslashes($_POST[$pram]);
  	       }else{
  	            return strip_tags($var);
  	       }
  	    }else{
  	        return strip_tags($var);
  	    }
  	}else{
  	   return "";
  	}
  }
  
  public function get($pram,$type=null){
    if(isset($_GET[$pram])){
        $var = $_GET[$pram];
  		if($type !== null){
  			if($type=="length"){
  				return strlen($var);
  			}elseif($type=="number"){
  				return filter_var($var,FILTER_SANTIZE_NUMBER_INT);
  			}elseif($type== "email"){
  				return filter_var($var,FILTER_SANTIZE_EMAIL);
  			}elseif($type=="string"){
  				return filter_var($var,FILTER_SANTIZE_STRING);
  			}elseif($type=="html"){ 
  				return htmlspecialchars($_GET[$pram]);
  			}elseif($type=="slash"){
  				return stripslashes($_GET[$pram]);
  			}else{
  				return strip_tags($var);
  			}
  		}else{
  		    return strip_tags($var);
  		}
  	}else{
  		return "";
  	}
  }
  
  public function getUrl($index=0,$url="url"){
   $resulte = explode("/",get($url));
   return filter_var($resulte[$index],FILTER_SANITIZE_URL);
  }
  
  public function redirect($url,$time=null){
    if($time !== null){
       header("refresh:$time;url=$url");
    }else{
       header("Location:".$url);
    }
  }
  
  public function File($fname){
    return $_FILES[$fname];
  }
  
  public function upload($dir,$file){
     move_uploaded_file($file['tmp_name'],$dir.$file['name']);
  }
  
}
?>