<?php
/**
* 
*/
class Asistencia extends Controller
{	
	public function __construct()
	{
		$this->checkPost(array("asisteEvento","asisteSede","asisteSedeId",
"asisteProyecto"));
	}

	public function index($name = "")
	{	

		$numEvento = $_POST["asisteEvento"];
		$sedeEdu = $_POST["asisteSede"];
		$sedeEduId = $_POST["asisteSedeId"];		
		$idProyecto = $_POST["asisteProyecto"];

		$listadoEstudiantes = $this->model("Estudiante")->getBy_Sede($sedeEduId);

		// var_dump($listadoEstudiantes);
		// exit();
		$params = array(
			"title"=>"Asistencia - sede ".$sedeEdu,
			"actualPage"=>"asistencia",
			"sedeEdu"=>$sedeEdu,
			"numEvento"=>$numEvento,
			"idProyecto"=>$idProyecto,
			"listadoEstudiantes" => toArray($listadoEstudiantes)
			);

		$this->view('asistencia.html',$params);
	}


}