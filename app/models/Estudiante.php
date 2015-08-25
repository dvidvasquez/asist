<?php

class Estudiante
{
	public $_db;

# id, idIe, consSede, nombre, tel, direccion, comuna
	public  function __construct()
	{
		$this->_db = DB::getInstance();
	}

	public function getBy_Sede($idSede)
	{			
		return $this->_db->get("estudiantes",array("sedeEducativa","=",$idSede))->results();	
	}

}

