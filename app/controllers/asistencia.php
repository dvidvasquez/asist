<?php
/**
* 
*/
class Asistencia extends Controller
{	
	public function __construct()
	{
		
	}

	public function index($name = "")
	{		
		$this->checkPost(array("asisteEvento","asisteSede","asisteSedeId",
"asisteProyecto"));

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

	public function confirmar($name = "")
	{	
		$this->checkPost(array("token","jsonConfirm","numEvento"));
		$jsonConfirm = json_decode($_POST["jsonConfirm"]);
		$numEvento = $_POST["numEvento"];
		$token = $_POST["token"];		
		if(Token::check($token))
		{
		#validacion de token de seguridad
			// if($this->model('Asistencia')->confirmar($jsonConfirm,$numEvento))
			// {
			// 	header("Location: ".$this->model('Path')->get()->sitio."busqueda");
			// 	exit();
			// 	// $this->index();
			// }	
		#validacion de token de seguridad
		}	
	}


}