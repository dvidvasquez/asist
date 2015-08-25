<?php

class Twig 
{
	public static $instance;

	public static function getInstance()
	{		
		if (!isset(self::$instance)) {
				self::$instance = new Twig();
		}
		return self::$instance;		
	}

	public function __construct()
	{
		require_once '../vendor/autoload.php';
		Twig_Autoloader::register();
		
	}

	public function render($template,$datos = [])
	{
		$loader = new Twig_Loader_Filesystem('../app/views');
		$twig = new Twig_Environment($loader, array(
		    'debug' => true,
			));
		$twig->addExtension(new Twig_Extension_Debug());
		/*$twig = new Twig_Environment($loader, array(
		    'cache' => '../app/views/cache',
			));*/
		return $twig->render($template, $datos);
	}
}