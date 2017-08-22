<?php 
	include('acceso.php');

	$conexion = mysqli_connect($server, $user, $pass,$bd) or die("Ha sucedido un error inexperado en la conexion de la base de datos");
 
	if($_GET["level"]=='1'):
		$sql = "SELECT * FROM relacion_escuela_carreras as relacion, careers as carreras WHERE relacion.facultad_licenciatura_id=".$_GET['escuela']." and relacion.career_id=carreras.career_id";
	else:
		$sql = "SELECT * FROM  relacion_facultad_programas as relacion, posgrado_programs as programas WHERE relacion.facultad_posgrado_id=".$_GET['escuela']." and relacion.posgrado_program_id=programas.posgrado_program_id";
	endif;

	mysqli_set_charset($conexion, "utf8"); 

	if(!$result = mysqli_query($conexion, $sql)) die();
	
	$clientes = array();
	
	while($row = mysqli_fetch_array($result)) 
	{ 
		if($_GET["level"]=='1'):
			$carrera=$row['career'];
			$id=$row['career_id'];
		else:
			$carrera=$row['posgrado_program'];
			$id=$row['posgrado_program_id'];
		endif;

		$clientes [] = array ('id'=>$id,'carrera' => $carrera);
	}

	asort($clientes);

	$close = mysqli_close($conexion) or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
	  
	$json_string = json_encode($clientes);
	header("Content-type: application/json; charset=utf-8");
	echo $json_string;
?>