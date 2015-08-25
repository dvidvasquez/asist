<?php
/**
* 
*/
class Grupos extends Controller
{	
	public function index($name = "")
	{	
		$params = array(
			"title"=>"Mis Grupos - CTA ",
			"actualPage"=>"grupos"
			);

		$this->view('grupos.html',$params);
	}

	public function noajax($name = null)
	{	
		$params = array(
			"title"=>"Estudiantes - noajax ",
			"actualPage"=>"noajax",
			"estudiantes"=>$name
			);

		$this->view('noajax.html',$params);
	}


	public function ajaxSet($name="")
	{	
		if (isset($_REQUEST["nombre"]) and isset($_REQUEST["pass"]))
		{
			$nom = $_REQUEST["nombre"];
			$pass = $_REQUEST["pass"];	
			//validacion de token de seguridad		
			if (isset($_REQUEST["token"])) {			
				$token = $_REQUEST["token"];			
				if(Token::check($token))
				{
					//validacion de token de seguridad
					if($this->model('Test')->set($nom,$pass))
					{
						$theFields = array('id' , 'nombre' );
						$rpta =  $this->model('Test')->getSome($theFields);
						if (is_array($rpta->results())) {
							$ajaxToken = Token::generate();
							$arrResults = array("results" => $rpta->results(),"token"=>$ajaxToken);
							echo json_encode($arrResults);
							exit();
						}
						else
						{
							echo "is not array";
							exit();
						}				
					}
					//validacion de token de seguridad
				}	
				echo "non_authentic";
				exit();			
			}	
			//validacion de token de seguridad		
				$this->index();			
		}		
	}


	public function noajaxset($name="")
	{	
		if (isset($_REQUEST["nombre"]) and isset($_REQUEST["pass"]))
		{
			$nom = $_REQUEST["nombre"];
			$pass = $_REQUEST["pass"];	
			//validacion de token de seguridad		
			if (isset($_REQUEST["token"])) {			
				$token = $_REQUEST["token"];			
				if(Token::check($token))
				{
					//validacion de token de seguridad
					if($this->model('Test')->set($nom,$pass))
					{
						$theFields = array('id' , 'nombre' );
						$rpta =  $this->model('Test')->getSome($theFields);
						if (is_array($rpta->results())) {
							//echo json_encode($rpta->results());
							$this->noajax($rpta->results());
							exit();
						}
						else
						{
							$this->noajax();
						}			
					}
					//validacion de token de seguridad
				}			
			}	
			//validacion de token de seguridad		
				$this->noajax();			
		}		
	}
}