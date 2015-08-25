<?php

class Proyecto
{
	public $_db;

	public  function __construct()
	{
		$this->_db = DB::getInstance();
	}

	public function getActual($idUser)
	{	
		return $this->_db->get("proyectoactual", array('idUsuario','=',$idUser))->first();
	}
}

