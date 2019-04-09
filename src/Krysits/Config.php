<?php
namespace Krysits;

class Config {
	// config vars
	public $type =      'mysql';
	public $host =      '127.0.0.1';
	public $charset =   'UTF8';
	public $database =  'url_db';
	public $username =  'root';
	public $password =  '';

	public $salt = 'rndmsltvl';

	public static $allowedIPs = [
		'127.0.0.1',
		'::1',
		'94.100.3.154',
		'192.168.0.100',
		'192.168.0.101'
	];

	// methods
	public function getDSN() {
		return $this->type.":host=".$this->host.";charset=".$this->charset.";dbname=".$this->database;
	}
	public static function checkIP($ip) {
		if(filter_var($ip, FILTER_VALIDATE_IP)) return in_array($ip, self::$allowedIPs);
		return false;
	}
};
