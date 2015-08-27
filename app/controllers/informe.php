<?php
/**
* 
*/
class Informe extends Controller
{	
	public $_db;

# id, idIe, consSede, nombre, tel, direccion, comuna
	public  function __construct()
	{
		$this->_db = DB::getInstance();
	}

	public function index()
	{			
		// $where = array("nombre"=>"id", "valor"=>"83");
		// $fields = array(
		// 	"nombre"=>"El cejon barela",
		// 	"test1"=>"arrivedercci",
		// 	"test3"=>"hay hay hay"
		// 	);

		// $this->_db = DB::getInstance()->update("test", $where, $fields );		
		// //este se envia al correo
		// $nuevoPass = utf8_decode(Hash::salt(8));
		// //estos dos se envian a base
		// $salt = Hash::salt(32);
		// $encriptPass = Hash::make($nuevoPass, $salt);

		// var_dump($encriptPass);

		//exit();

		$queryString = "SELECT 
		e.id AS 'idEstudiante',
		si.consSede AS 'CONS_SEDE',
		si.nombre AS 'NOMBRE_SEDE',
		si.comuna AS 'COMUNA',
		(SELECT nombre from tiposdocumentos where id = e.tipoDoc LIMIT 1 ) AS 'TIPO_DOCUMENTO',
		e.documento AS 'NRO_DOCUMENTO',
		e.primerNombre AS 'PRIMER_NOMBRE',
		e.segundoNombre AS 'SEGUNDO_NOMBRE',
		e.primerApellido 'PRIMER_APELLIDO',
		e.segundoApellido AS 'SEGUNDO_APELLIDO',
		e.tel AS 'TELÉFONO',
		e.grado AS 'GRADO'
		FROM estudiantes e INNER JOIN sedes_x_institucion si ON e.sedeEducativa = si.id";

		$queryString_eA = "SELECT idEstudiante, numEvento, fecha FROM asistencias WHERE idProyecto = 1;";

		$estudiantes = DB::getInstance()->query($queryString)->results();
		$eventosAsistente = DB::getInstance()->query($queryString_eA)->results();
		$eventos = DB::getInstance()->query("SELECT numEventos FROM proyectos WHERE id = 1 LIMIT 1")->first();
		//$estudiantes = $this->model('Estudiante')->get();
		$now = (string)microtime();
		$now = explode(' ', $now);
		$mm = explode('.', $now[0]);
		$mm = $mm[1];
		$dt = new DateTime("now", new DateTimeZone('America/Bogota'));
		$nombreArchivo = $dt->format('dmY_His').substr($mm, 0, 3);	
		$nombreArchivo ='uploads/Estudiantes_'.$nombreArchivo.'.csv';
		$file = new SplFileObject($nombreArchivo, 'w');

		$counter = 0;
		$estudiantesArray = toArray($estudiantes, false);
		foreach ($estudiantesArray as $keyFields => $fields) {
			if ($counter==0)
			{
			$file->fputcsv(array_merge(array(
				'CONS_SEDE',
				'NOMBRE_SEDE',
				'COMUNA',
				'TIPO_DOCUMENTO',
				'NRO_DOCUMENTO',
				'PRIMER_NOMBRE',
				'SEGUNDO_NOMBRE',
				'PRIMER_APELLIDO',
				'SEGUNDO_APELLIDO',
				utf8_decode('TELÉFONO'),
				'GRADO'), $this->crearCamposEventos("Taller",$eventos)),';');
		}else{
			$sinId = $fields;
			unset($sinId["idEstudiante"]);
			$file->fputcsv(array_merge($sinId, $this->construirAsistencia($fields["idEstudiante"], $eventosAsistente, $eventos)),';');
		}
		$counter++;
		}

		header("Content-disposition: attachment; filename=\"" . basename($nombreArchivo) . "\""); 
		readfile($nombreArchivo);
		exit;
	}

	function construirAsistencia($idEstudiante, $asistEstudiantes, $numEventos){
		//$asistEstudiantes = idEstudiante, numEvento, fecha
		$totalAsistencias = array();			
			$checker = false;
		   	for ($i = 1; $i <= $numEventos->numEventos; $i++) {
		   		//$eventosAsistente[]
			   // if($asistEstudiantes->numEvento==$i and $asistEstudiantes->idEstudiante==$idEstudiante){
			   // 	$totalAsistencias[] = $asistEstudiantes->fecha;
			   // }else{
			   	//$totalAsistencias[] = $idEstudiante;
			   // };
		   		foreach ($asistEstudiantes as $key => $value) {
		   			if ($value->idEstudiante == $idEstudiante) {
		   				if ($value->numEvento == $i) {
		   					$totalAsistencias[] = $value->fecha;
		   					$checker = true;
		   				}
		   			}
		   		}
		   		if (!$checker)
		   		 	$totalAsistencias[] = "";
		   		$checker = false;
			}
		return $totalAsistencias;
	}

	function crearCamposEventos($nombre, $eventos){
		$totalEventos = array();		
		for ($i = 1; $i <= $eventos->numEventos; $i++) {
		    $totalEventos[] = $nombre." ".$i;
		}
		return $totalEventos;
	}

}