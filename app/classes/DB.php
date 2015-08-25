<?php
//php data objet para deifinir cualquier base e datos c
class DB {
	private static $_instance = null;
	private $_pdo, 
			$_query, 
			$_error =  false, 
			$_results, 
			$_count = 0;

	private function __construct(){
		try {
			$this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),Config::get('mysql/username'),Config::get('mysql/password'));
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance(){
		if (!isset(self::$_instance)) {
			self::$_instance = new DB();			
		}
		return self::$_instance;
	}

	public function clean()
	{ 
		$this->_error =  false;
		$this->_results = NULL; 
		$this->_count = 0;
	}

	public function query($sql, $params =  array(),$control = null)
	{		
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)) {			
			$x = 1;
			if(count($params)){
				foreach ($params as $param) {
					$this->_query->bindValue($x,$param);
					$x++;
				}				
			}
			if ($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}
			else{
				$this->_error= true;
			}		
		}
		return $this;
	}


	public function insert($table, $cols = array())
	{
			end($cols);
			$last = key($cols);
			$positions = "";
				foreach ($cols as $key => $col) {
					$positions = $key==$last? $positions." ? " : $positions." ?, ";
				}	
			$columns = implode(",",array_keys($cols));
				$sql = "INSERT INTO {$table} ({$columns}) VALUES(".$positions.")";
				if (!$this->query($sql, array_values($cols), $table)->error()) {
					return $this;
				}
	}

	public function update($table, $id, $fields)
	{
			
	}

	public function action($action, $table, $where = array())
	{
		if (count($where) === 3) {
			$operators = array('=','>','<','>=','<=');
			
			$field = $where[0];
			$operator = $where[1];
			$value = $where[2];

			if (in_array($operator, $operators)) {
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";										
				if (!$this->query($sql, array($value),$table)->error()) {
					return $this;
				}
			}
		}
	}

	public function get($table, $where)
	{
		return $this->action("SELECT *",$table, $where);
	}

	public function getAll($table)
	{
		if (!$this->query("SELECT * FROM ". $table)->error()) {
					return $this;
				}
	}

	public function getSome($table, $fields = array())
	{
		if (!$this->query("SELECT ". implode(",",$fields) ." FROM ". $table)->error()) {
					return $this;
				}
	}

	public function set($table, $values)
	{
		return $this->insertion($table, $values);
	}

	public function delete($table, $where)
	{

	}

	public function results()
	{
		return $this->_results;
	}

	public function first()
	{
		return $this->results()[0];
	}

	public function error()
	{
		return $this->_error;
	}

	public function count(){
		return $this->_count;
	}

}