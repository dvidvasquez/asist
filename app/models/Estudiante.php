<?php

class Estudiante
{
	public $_db;

# id, idIe, consSede, nombre, tel, direccion, comuna
	public  function __construct()
	{
		$this->_db = DB::getInstance();
	}

	public function get()
	{			
		return $this->_db->getAll("estudiantes")->results();	
	}

	public function getBy_Sede($idSede)
	{			
		return $this->_db->get("estudiantes",array("sedeEducativa","=",$idSede))->results();	
	}

	public function getBy_SedePendiente($idSede, $numEvento)
	{	$params = array($idSede, Session::get(Config::get("session/proyect_id")), $numEvento);
		return $this->_db->query("SELECT * FROM estudiantes WHERE sedeEducativa = ? AND id NOT IN (SELECT idEstudiante FROM asistencias WHERE idProyecto = ? AND numEvento = ?)",$params)->results();	
	}	
}

