<?php 
	include('acceso.php');
 
	if(($_GET['escuela']=='') and ($_GET["level"]=='1')):
		$sql = "SELECT * FROM careers order by career ASC";
	else:
		if($_GET["level"]=='1'):
			$sql = "SELECT * FROM relacion_escuela_carreras as relacion, careers as carreras WHERE relacion.facultad_licenciatura_id=".$_GET['escuela']." and relacion.career_id=carreras.career_id ";
		else:
			if(($_GET['escuela']=='') and ($_GET["level"]>='2')):
				$sql = "SELECT * FROM  posgrado_programs order by posgrado_program ASC";
			else:
				$sql = "SELECT * FROM  relacion_facultad_programas as relacion, posgrado_programs as programas WHERE relacion.facultad_posgrado_id=".$_GET['escuela']." and relacion.posgrado_program_id=programas.posgrado_program_id";
			endif;
		endif;
	endif;

	mysqli_set_charset($conexion, "utf8"); 

	if(!$result = mysqli_query($conexion, $sql)) die();
	
	$clientes = array();
	
	while($row = mysqli_fetch_array($result)) 
	{ 
		if($_GET["level"]=='1'):
			$carrera=$row['career'];
			$id=$row['id'];
		else:
			$carrera=$row['posgrado_program'];
			$id=$row['id'];
		endif;

		$clientes [] = array ('id'=>$id,'carrera' => $carrera);
	}

	asort($clientes);

	$close = mysqli_close($conexion) or die("Ha sucedido un error inesperado en la desconexion de la base de datos");
	  
	//Creamos el JSON
	$json_string = json_encode($clientes);
	header("Content-type: application/json; charset=utf-8");
	echo $json_string;
    
?>