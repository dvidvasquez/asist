<?php

class Log{

	public static function in($user = array())
	{		
		//$this->_data = $user;
		Session::put(Config::get("session/session_name"),$user->id);
		//Session::put("rol",$user->rol);
	}

	public static function out()
	{
		Session::delete();		
	}

	

}
