<?php

class Asisten
{

	public function confirmar($ids = array(), $evento = null)
	{		
		$_db = $this->_db = DB::getInstance();
		$params = array();
		$idProtecto = Session::get(Config::get("session/proyect_id"));
		$idUsuario = Session::get(Config::get("session/session_name"));

		foreach ($ids as $k => $v) {
			$newArray = array(
				"idEstudiante" => $v->idEstudiante, 
				"idProyecto" => $idProtecto, 
				"numEvento" => $evento, 
				"usuarioCrea" => $idUsuario,
				"fecha"=> date("Y-m-d")
				);
			array_push($params, $newArray );
		}

		return $_db->multiInsert("asistencias",$params);

	}
}