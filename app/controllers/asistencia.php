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
		$this->checkPost(array("asisteEvento","asisteSede","asisteSedeId"));

		$numEvento = $_POST["asisteEvento"];
		$sedeEdu = $_POST["asisteSede"];
		$sedeEduId = $_POST["asisteSedeId"];		
		$idProyecto = Session::get(Config::get("session/proyect_id"));

		$listadoEstudiantes = $this->model("Estudiante")->getBy_SedePendiente($sedeEduId, $numEvento);

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
			if($this->model('Asisten')->confirmar($jsonConfirm,$numEvento))
			{
				header("Location: ".$this->model('Path')->get()->sitio."busqueda");
				exit();
				// $this->index();
			}	
		#validacion de token de seguridad
		}	
	}


}