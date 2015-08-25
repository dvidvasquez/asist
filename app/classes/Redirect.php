<?php
//session_start();

/**
* 
*/
class Redirect
{
	public function to($location)
	{
		header("Location: ".$location);
		exit();
	}

}