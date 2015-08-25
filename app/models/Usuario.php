<?php
//session_start();
class Usuario
{
	public $_data,
			$_db;

	public function __construct()
	{
		$this->_db = DB::getInstance();
	}

	public function check($username = null, $password = null)
	{		
		//$user = DB::getInstance()->get("usuarios", array('documento','=',$username));
		$user = $this->_db->get("usuarios", array('documento','=',$username));

		if ($user->count()) {
			$this->_data = $user->first();
			$proyecto = $this->_db->query("SELECT * FROM proyectos WHERE id = (SELECT id FROM proyectoactual WHERE idUsuario = ? LIMIT 1)", array($this->_data->id), "proyecto")->first();
			
			if ($this->checkPass($password))
			{				
				// Log::in($this->_data);				
				return User::login($this->_data,$proyecto);
				//Session::put(Config::get("session/session_name"), $this->_data->id);
				//return Session::exists(Config::get("session/session_name"));
			}			
			$this->clean();			
		}
		return false;
	}

	public function logout()
	{
		return User::logout();
	}

	private function checkPass($password)
	{
		if ($this->_data->pass === Hash::make($password, $this->_data->salt))
			return true;
		return false;
	}

	private function clean()
	{
		$this->_data = null;
	}


}