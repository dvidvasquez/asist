<?php

class Controller extends Twig
{
	public function checkPost($values = array())
	{
		if(!Posts::check($values)){
			//$this->regresar();
			Redirect::to($this->model('Path')->get()->sitio."busqueda");
		}
	}

	public function regresar()
	{
		Redirect::to($this->model('Path')->get()->sitio."busqueda");
	}

	public function model($model)
	{
		require_once '../app/models/'.$model.'.php';
		return new $model();
	}

	public function view($view, $data = [])
	{	
		//GENERALES PARA LA MASTER
		$path  = $this->model('Path')->get();
		$menu  = $this->model('Menu')->get();
		$token = Token::generate();
		
		$masterParams = array(
			"path"=>$path,
			"menus"=> $menu,
			"token" => $token
			);

		if (!Session::exists(Config::get("session/session_name"))) {
			if ($view != "login.html") {
				$logInParams = array(
				"title"=>"Bienvenidos - CTA",
				"actualPage"=>"login",
				"err"=> "err"
				);
				echo Twig::getInstance()->render("login.html", array_merge($logInParams, $masterParams));
			}
			else
			{
				echo Twig::getInstance()->render($view, array_merge($data, $masterParams));
			}
			
		}
		else {			
			if ($view != "login.html")
			{
				echo Twig::getInstance()->render($view, array_merge($data, array_merge($masterParams, User::info())));
			}
			else
			{
				$this->regresar();
			}
		}
	}
	
}