<?php
//session_set_cookie_params(43200, "/","localhost:5050");
//session_start();

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' =>  'www.cieroccidente.edu.co',
		'username'=> 'wwwcier_cta',
		'password' => '6r=yA7ikDpe-',
		'db' => 'wwwcier_cta'
		),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
		),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token',
		'user_name' => 'name',
		'user_rol' => 'rol',
		'user_mail' => 'mail',
		"proyect_name" => 'proyect',
		"proyect_id" => 'idProyect',
		"proyect_events" => 'events'
		)
);

require_once 'core/App.php';
require_once 'core/Twig.php';
require_once 'core/Controller.php';
require_once 'functions/helpers.php';


spl_autoload_register(function($class){
	require_once 'classes/'.$class.'.php';
});