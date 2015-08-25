<?php

class Mix
{
	public $id;
	public $nombre;
	public $valor;

	public function get($value)
	{	
		return $this->query("mixes", array("nombre","=",$value));	
	}

	private function query($query, $params = array() )
	{
		if(count($params)> 0)
			$result = DB::getInstance()->get($query, $params);
		else
			$result = DB::getInstance()->query($query);	
		return !$result->count() ? '0': $result->first()->valor;
	}
}

