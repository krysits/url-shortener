<?php
namespace Shortener\Models;

use Krysits\Model;
use Shortener\CountryCode;

class Hit extends Model
{
	// variables
	public $id;
	public $uid;
	public $ip;
	public $country = 'XX';
	public $secure = '0';
	public $ref;
	
	public $created_at; //date('Y-m-d H:i:s');
	public $updated_at; //date('Y-m-d H:i:s');
	public $deleted_at; //date('Y-m-d H:i:s');

	// constructor
	public function __construct($url_id = 0)
	{
		parent::__construct();
		if($url_id) {
            $this->addHit($url_id);
        }
	}

	// methods
	public function setTable($table = '')
	{
		$this->_table = (empty($table)) ? strtolower($this->getTableNameByNamespace(__CLASS__)) : $table;
	}

	public function addHit($url_id = 0) {
		if(empty($url_id)) {
			return false;
		}
		
		$this->setData($_REQUEST);
		
		$this->uid = $url_id;
		$this->ip = $_SERVER['REMOTE_ADDR'];
        $this->ref = $_SERVER['HTTP_REFERER'];
		$republic = new CountryCode($this->ip);
		
		if(isset($republic->country_code)) {
			$this->country = $republic->country_code;
		}
		
		$this->secure = $_SERVER['REQUEST_SCHEME'] === 'https' ? 1 : 0;
		
		return $this->save((array) $this);
	}
}