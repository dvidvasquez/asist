<?php

/**
* 
*/
class Home extends Controller
{	
	public function index($name = null)
	{			
		if ($name != "err") {
			$name = null;		
		}

		$params = array(
			"title"=>"Bienvenidos - CTA",
			"actualPage"=>"login",
			"err"=>$name
			);

		$this->view('login.html',$params);
	}

	public function recuperar($name = null)
	{	
		$params = array(
			"title"=>"Recuperar contraseña  - CTA",
			"actualPage"=>"recuperar"
			);

		$this->view('recuperar.html',$params);
	}

	public function logout($name = null)
	{	
		if($this->model('Usuario')->logout())
		{
			//$this->index();
			header("Location: ". $this->model('Path')->get()->sitio);
			exit();
		}	
	}

	public function login($name = null)
	{	
		if (isset($_POST["user"]) and isset($_POST["pass"]))
		{
			$doc = $_POST["user"];
			$pass = $_POST["pass"];				
			//validacion de token de seguridad		
			if (isset($_POST["token"])) {			
				$token = $_POST["token"];		
				if(Token::check($token))
				{
				//validacion de token de seguridad
					if($this->model('Usuario')->check($doc,$pass))
					{
						header("Location: ".$this->model('Path')->get()->sitio."busqueda");
						exit();
						// $this->index();
					}	
				//validacion de token de seguridad
				}				
			}	
			//validacion de token de seguridad	
		}	
	$this->index("err");		
	}

	public function recupe($name = null)
	{	
		if (isset($_REQUEST["user"]))
		{	
			$doc = $_REQUEST["user"];	
			echo $this->model('Recuperar')->check($doc) ? "ok": "err";
			exit();
					
		}			
	}

}