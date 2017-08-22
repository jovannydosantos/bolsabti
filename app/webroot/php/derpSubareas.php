<?php 
	include('acceso.php');
	
	$sql = "SELECT distinct id_sub_areas, experience_subarea FROM rel_giro_area_subarea as relacion, experience_areas as areas, experience_subareas as subareas, rotations as giro WHERE subareas.id=relacion.id_sub_areas and relacion.id_rotations=giro.id and relacion.id_rotations=".$_GET['giro']." and relacion.id_areas=".$_GET['area']." order by experience_subarea";
	
	mysqli_set_charset($conexion, "utf8"); 

	if(!$result = mysqli_query($conexion, $sql)) die();

	$clientes = array();
	
	while($row = mysqli_fetch_array($result)) 
	{ 
		$id = $row['id_sub_areas'];
		$subarea = $row['experience_subarea'];
		$clientes [] = array ('id'=>$id, 'area' => $subarea );
	}

	asort($clientes);

	$close = mysqli_close($conexion) or die("Ha sucedido un error inesperado en la desconexion de la base de datos");
	  
	$json_string = json_encode($clientes);
	header("Content-type: application/json; charset=utf-8");
	echo $json_string;
?>