<?php

class Devkey
{
	public $id;
	public $key;

	public function get()
	{	
		$query = "SELECT * FROM googledeveloperkey";
		return $this->query($query);	
	}

	private function query($query)
	{
		$result = DB::getInstance()->query($query);	

		if ($result->error()) {
			return "error";
		}
		else
		{
			return !$result->count() ? '0': toArray($result->first());
		}
	}
}

