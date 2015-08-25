<?php

class Sedes
{
	public $_db;

# id, idIe, consSede, nombre, tel, direccion, comuna
	public  function __construct()
	{
		$this->_db = DB::getInstance();
	}

	public function getSedes_x_Ins()
	{			
		$query = 	"SELECT
					ie.id as 'idIe',
					ie.codDane as 'codIe',
					ie.nombre as 'nomIe',
					se.id as 'idSede',
					se.nombre as 'nomSede',
					se.consSede as 'codSede',
					se.tel as 'telSede',
					se.direccion as 'dirSede',
					se.comuna as 'comunaSede'
					from institucionesedu ie inner join sedes_x_institucion se 
					on ie.id = se.idIe;";
		#->get("usuarios", array('documento','=',$username))
		return $this->_db->query($query)->results();	
	}

}

