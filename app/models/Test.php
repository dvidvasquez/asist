<?php

class Test
{
	public $id;
	public $nombre;
	public $pass;
	public $salt;

	public function get()
	{	
		return DB::getInstance()->getAll("test");
	}

	public function getSome($fields = array())
	{	
		return DB::getInstance()->getSome("test", $fields);
	}

	public function set($nombre, $pass)
	{	
		$salt = Hash::salt(32);
		$params = array(
			"nombre"=> $nombre,
			"pass" => hash::make($pass,$salt),
			"salt" => $salt
			);

		return  DB::getInstance()->insert("test",$params);
	}
	
}
