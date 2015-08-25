<?php
/**
* 
*/
class Usuario extends Controller
{	

	public function index($name = "")
	{	
		//preguntar si el usuario tiene los permisos para ver todos los usuarios
		
		$params = array(
			"title"=>"Usuarios - CTA",
			"actualPage"=>"usuarios"
			);
		$this->yo();
		//$this->view('usuarios.html',$params);
	}

	public function yo($name = "")
	{	
		//preguntar si el usuario tiene los permisos para ver todos los usuarios		
		$params = array(
			"title"=>"Mi usuario - CTA",
			"actualPage"=>"yo"
			);

		$this->view('admin-usuario.html',$params);
	}


}