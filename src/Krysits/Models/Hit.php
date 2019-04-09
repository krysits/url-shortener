<?php

namespace Krysits\Models;

use Krysits\Model;
use Krysits\CountryCode;

class Hit extends Model
{
	// variables
	public $id;
	public $uid;
	public $ip;
	public $country = 'XX';
	public $secure = '0';
	public $created_at; //date('Y-m-d H:i:s');
	public $updated_at; //date('Y-m-d H:i:s');
	public $deleted_at; //date('Y-m-d H:i:s');

	// constructor
	public function __construct($url_id = 0)
	{
		parent::__construct();
		if($url_id) $this->addHit($url_id);
	}

	// methods
	public function setTable($table = '')
	{
		$this->_table = (empty($table)) ? strtolower($this->getTableNameByNamespace(get_class())) : $table;
	}

	public function addHit($url_id = 0) {
		if(empty($url_id)) return false;
		$this->setData($_REQUEST);
		$this->uid = $url_id;
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$republic = new CountryCode($this->ip);
		if(isset($republic->country_code)) $this->country = $republic->country_code;
		$this->secure = intval($_SERVER['REMOTE_PORT']==443);
		$saved = $this->save((array) $this);
		if($saved) return $saved;
		return 0;
	}
};