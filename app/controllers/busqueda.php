<?php

/**
* 
*/
class Busqueda extends Controller
{	
	public function index($name = null)
	{			
		$listadoSedes = $this->model('Sedes')->getSedes_x_Ins();
		$params = array(
			"title" =>"Busqueda - CTA",
			"actualPage" =>"busqueda",
			"listaSedes" => $listadoSedes
			);

		$this->view('busqueda.html',$params);
	}


}