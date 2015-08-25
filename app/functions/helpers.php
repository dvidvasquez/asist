<?php

function escape($string) 
{
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function unWrapResult($array)
{
	$newValues= array();
	foreach ($array as $key => $value) {
		if (is_array($value))
		{			
			$newValues[$key] = unWrapResult($value);
		}
		else
		{
			$newValues[$key] = $value;
		}
	}
	return $newValues;
}

function toArray($obj, $fechas = array())
{
	#$fechas(hoy, fecha, nombreResultado)
		    if (is_object($obj)) $obj = (array)$obj;
		    if (is_array($obj)) {
		        $new = array();
		        foreach ($obj as $key => $val) {
		        	if(is_string($val))
		        	$val = utf8_encode($val);
		            $new[$key] = toArray($val);
		        }
		    } else {
		        $new = $obj;
		    }
	return $new;
}
