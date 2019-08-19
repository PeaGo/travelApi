<?php
class JBHelper{
	static function pingUrl($url=NULL)
	{
		if($url == NULL) return false;
		$ch = curl_init($url);
		$user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5)".
				" Gecko/20041107 Firefox/1.0";
		curl_setopt($ch, CURLOPT_USERAGENT, $user_agent );
		curl_setopt($ch, CURLOPT_TIMEOUT,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		// 	    curl_setopt($ch, CURLOPT_USERPWD, "12trip:12trip@T12");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		//	    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return $data;
	}
	
	static function get_data_from_url($url=NULL)
	{
		if($url == NULL) return false;
		$ch = curl_init($url);
		$user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5)".
				" Gecko/20041107 Firefox/1.0";
		curl_setopt($ch, CURLOPT_USERAGENT, $user_agent );
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		// 	    curl_setopt($ch, CURLOPT_USERPWD, "12trip:12trip@T12");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		//	    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return $data;
	}
	
	static function route($url,$default_secret=false){
		if(!strpos($url, '?')){
			$url .= '?';
		}else{
			$url .= '&';
		}
		if($default_secret){
			$url .= 'secret='.JFactory::getConfig()->get('secret');
		}else{
			$url .= 'secret='.JFactory::getApplication('site')->input->getString('secret');
		}
		return $url;
	}
}
