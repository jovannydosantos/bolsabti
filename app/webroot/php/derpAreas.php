<?php 
	include('acceso.php');
	
	$sql = "SELECT distinct id_areas, experience_area FROM  rel_giro_area_subarea as relacion, experience_areas as areas, rotations as giro WHERE areas.id=relacion.id_areas and relacion.id_rotations=giro.id and relacion.id_rotations=".$_GET['giro']." order by experience_area";
	
	mysqli_set_charset($conexion, "utf-8"); 

	if(!$result = mysqli_query($conexion, $sql)) die();

	$clientes = array();

	while($row = mysqli_fetch_array($result) ) 
	{ 
		$id = $row['id_areas'];
		$area = $row['experience_area'];
		$clientes [] = array ('id'=>$id, 'area' => utf8_encode($area) );
	}

	asort($clientes);

	$close = mysqli_close($conexion) or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
	  
	//Creamos el JSON
	$json_string = json_encode($clientes);
	header("Content-type: application/json; charset=utf-8");
	echo $json_string;
?>