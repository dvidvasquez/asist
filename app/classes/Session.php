<?php 

/**
* }
*/
class Session
{
	public static function exists($name)
	{
		return (isset($_SESSION[$name])) ? true : false;
	}

	public static function put($name, $value)
	{
		return $_SESSION[$name] = $value;
	}

	public static function get($name)
	{
		return $_SESSION[$name];
	}

	public static function delete($name=null)
	{
		if (self::exists($name)) {
			unset($_SESSION[$name]);
		}
		//session_destroy();
	}

	public static function destroy()
	{
		session_destroy();
	}

	public static function flash($name, $string = "")
	{
		if (self::exists($name)) {
			$session = self::get($name);
			self::delete($name);
			return $session;
		}else{
			self::put($name, $string);
		}
	}
}
