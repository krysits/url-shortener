<?php
namespace Shortener\Models;

use Krysits\Model;
use Shortener\CountryCode;

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
		$codes = "abcdefghjkmnpqrstuvwxyz0123456789ABCDEFGHJKMNPQRSTUVWXYZ";
		
		while ($number > 55) {
			$key = $number % 56;
			$number = floor($number / 56) - 1;
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
        
        if(!filter_var($this->url, FILTER_VALIDATE_URL)) {
            return -1;
        }
        
        if(parse_url($this->url,PHP_URL_HOST) === $_SERVER['SERVER_NAME']) {
            return -1;
        }
		
		$this->getNextCode($this->getMaxId());
		
		$updatedMore = $this->save((array) $this, $this->id);
		
		if($updatedMore) {
			return $this->getResultUrl(true);
		}
		
		return 0;
	}
	
	public function getMaxId()
	{
		$sql = "SELECT max(id) as number FROM ";
		$sql .= $this->_table;
		
		$result = $this->_db->query($sql);
		
		return $result->fetchColumn() ?: 0;
	}
};
