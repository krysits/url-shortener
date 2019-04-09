<?php
namespace Krysits;

use PDO, stdClass;

abstract class Model {
	// vars
	public $id;
	// config
	public $_table;
	public $_showId = true;
	public $_db;
	protected $_out;
	// constructor
	public function __construct() {
		$this->_db = Database::getDb();	// getDB
		$this->setTable(); // derived method call
	}
	// methods
	public function setId($id) {
		return $this->id = intval($id);
	}
	abstract protected function setTable($table = '');
	public function getTableNameByNamespace($namespace = ''){
		if(empty($namespace)) return false;
		$result = $namespace;
		if(strrpos($namespace, "\\")){
			$result = @end(explode("\\", $namespace));
			return $result . 's';
		}
		return false;
	}
	public function genHash($length = 32) {
		try {
			$hash = md5(random_bytes($length));
		}
		catch (\Exception $e) {
			$hash = '';
		}
		return $hash;
	}
	public function getIdByAnotherId($bid = '', $key = 'id'){
		if(empty($bid)) return 0;
		if($id = $this->getRecords([$key => $bid], ['id'], 1)[0]->id) return $id;
		return 0;
	}
	public function getError($stmt) {
		echo "\nPDOStatement::errorInfo():\n";
		print_r($stmt->errorInfo());
	}
	public function setData($data = []){
		if(empty($data)) return false;
		$this->_out = new stdClass;
		foreach (get_object_vars($this) as $variable => $value) {
			if (isset($data[$variable]) && substr($variable, 0, 1) != '_') {
				if(!$this->_showId && $variable == 'id') {
					// does not expose id to output
					$this->$variable = $data[$variable];
				}
				else {
					$this->$variable = $this->_out->$variable = $data[$variable];
				}
			}
		}
		return $this->_out;
	}
	public function save($data = [], $id = 0) {
		if(empty($data)) return false;
		if($this->setId($id)) $isUpdate = true;
		else $isUpdate = false;
		$dbObj = $this->setData($data);
		if(!$isUpdate) $dbObj->created_at = $dbObj->updated_at = date('Y-m-d H:i:s');
		$fields = $values = [];
		foreach($dbObj as $variable => $value)
			if(isset($value)) {
				$fields[] = $variable . " =:" . $variable;
				$values[$variable] = $value;
			}
		$sql = ($isUpdate) ? "UPDATE " : "INSERT IGNORE INTO ";
		$sql .= $this->_table." SET ".implode(", ", $fields);
		$sql .= ($isUpdate) ? " WHERE id=".intval($this->id) : "";
		$stmt = $this->_db->prepare($sql);
		$result = $stmt->execute($values);
		if(!$result) $this->getError($stmt); // debug pdo
		if($isUpdate) return $result;
		return $this->setId($this->_db->lastInsertId());
	}
	public function getRecord($id, $key = 'id') {
		if(empty($id)) return false;
		if($key == 'id') $this->setId($id);
		elseif(substr($key,1,2) == 'id' && strlen($id)==32){}
		else $id = intval($id);
		$sql = "SELECT * FROM `".$this->_table."` WHERE `$key` =:myid";
		$stmt = $this->_db->prepare($sql);
		$stmt->execute(['myid' => $id]);
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		if($data) return $this->setData($data);
		return false;
	}
	public function getRecords($filters = [], $selection = [], $limit = 100, $skip = 0) {
		$sql = "SELECT ".((empty($selection))?"*":implode(", ",$selection))." FROM ".$this->_table;
		$limitSql = '';
		if($limit || $skip)	$limitSql = " LIMIT ".$skip.", ".$limit;
		if(!empty($filters)){
			$vars = get_object_vars($this);
			$whereSql = [];
			foreach ($filters as $key => $value){
				if(in_array($key, array_keys($vars))) $whereSql[] = $key." = :".$key." ";
			}
			$whereSql[] = " `deleted_at` IS NULL "; // soft deletes
			$sql .= " WHERE ".implode(" AND ", $whereSql);
			$sql .= $limitSql;
			$stmt = $this->_db->prepare($sql);
			$stmt->execute($filters);
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		$whereSql[] = " `deleted_at` IS NULL "; // soft deletes
		$sql .= " WHERE ".implode(" AND ", $whereSql);
		$sql .= $limitSql;
		$result = $this->_db->query($sql);
		if($result) return $result->fetchAll(PDO::FETCH_OBJ);
		return [];
	}
};