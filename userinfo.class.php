<?php

/**
*
*/
class UserInfo
{


	function __construct($ip = '')
	{
		if(!empty($ip)){
		$this->ip_address = $ip;
		}else{
		$this->ip_address = $_SERVER['REMOTE_ADDR'];
		}
	}

	// Calls the IPINFODB api to get location data about the ip address

	public function getUserLocation($format = '') {

	$ch = curl_init();

	$api_key = "9ae6d91d94aa2ffd932e35d5a3929189999515e8e7fb39d4c660bb459bda5021";

	$url = "http://api.ipinfodb.com/v3/ip-city/?key=" . $api_key . "&ip=" . $this->ip_address . "&format=json";

	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$contents = curl_exec($ch);

	curl_close($ch);

	if($format == 'json'){

		return $contents;

		} else {
		return json_decode($contents);
		}

	}

	public function getUserState(){
		if(isset($_COOKIE["userState"]) && $_COOKIE['userState'] != '-'){
		return $_COOKIE["userState"];
		}else{
		$location = $this->getUserLocation();
		setcookie("userState", ucfirst(strtolower($location->regionName)), time()+3600*24*1000);
		return ucfirst(strtolower($location->regionName));
		}
	}


}