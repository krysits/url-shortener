<?php
namespace Shortener;

class CountryCode
{
	public $ip = '';
	public $country_code = 'XX';
	private $_ip_url = "http://ipinfo.io/";

	public function __construct($ip = Null)
	{
		$this->getCCbyIP($ip);
	}

	public function getCCbyIP($ip = Null)
	{
		if(!empty($ip)) {
			$this->ip = $ip;
			$this->country_code = $this->_geo_loc_code($ip);
		}
		
		return $this->country_code;
	}

	private function _geo_loc_code($ip){
		$url = $this->_ip_url . $ip . '/json';
		$data = file_get_contents($url);
		$json_data = json_decode($data, false);
		
		if(!empty($json_data->country)) {
			return $json_data->country;
		}
		
		return $this->country_code;    // old value
	}
}