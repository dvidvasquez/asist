<?php

class Path
{
	public $id;
	public $sitio;
	public $absoluta;

	public function get()
	{	
		return $this->query("SELECT * from absolutas");	
	}

	private function query($query, $params = array() )
	{
		if(count($params)> 0)
			$result = DB::getInstance()->get($query, $params);
		else
			$result = DB::getInstance()->query($query);	
		return !$result->count() ? '0': $result->first();
	}
}
