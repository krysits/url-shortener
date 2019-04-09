<?php

namespace Krysits\Models;

use Krysits\Model;
use Krysits\CountryCode;

class Url extends Model
{
	// variables
	public $id;
	public $url;
	public $code;
	public $alias;
	public $ip;
	public $country;
	public $created_at; //date('Y-m-d H:i:s');
	public $updated_at; //date('Y-m-d H:i:s');
	public $deleted_at; //date('Y-m-d H:i:s');

	// constructor
	public function __construct()
	{
		parent::__construct();
	}

	// methods
	public function setTable($table = '')
	{
		$this->_table = (empty($table)) ? strtolower($this->getTableNameByNamespace(get_class())) : $table;
	}

	public function generate_code($number) {
		$out   = "";
		$codes = "abcdefghjkmnpqrstuvwxyz23456789ABCDEFGHJKMNPQRSTUVWXYZ";
		while ($number > 53) {
			$key = $number % 54;
			$number = floor($number / 54) - 1;
			$out = $codes{$key}.$out;
		}
		return $codes{$number}.$out;
	}

	public function getNextCode($number = 0)
	{
		return $this->code = $this->generate_code($number);
	}

	public function getResultUrl($secured = true)
	{
		return 'http' . (($secured) ?'s':'') . '://' . str_replace('www.','',$_SERVER['SERVER_NAME']) . '/' . ((empty($this->alias)) ? $this->code : $this->alias);
	}

	public function addNew()
	{
		$this->setData($_REQUEST);
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->country = (new CountryCode($this->ip))->country_code;
		if(!filter_var($this->url, FILTER_VALIDATE_URL)) return -1;
		$saved = $this->save((array) $this);
		if($saved) {
			$this->getNextCode($saved);
			$savedMore = $this->save((array) $this, $this->id);
			if($savedMore) return $this->getResultUrl(true);
		}
		return 0;
	}
};
