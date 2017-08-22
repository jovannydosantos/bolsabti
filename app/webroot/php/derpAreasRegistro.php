<?php 
	include('acceso.php');
	
	$sql = "SELECT distinct id_areas, experience_area FROM  rel_giro_area_subarea as relacion, experience_areas as areas, rotations as giro WHERE areas.id=relacion.id_areas and relacion.id_rotations=giro.id and relacion.id_rotations=".$_GET['giro']." order by experience_area";
	
	if(!$result = mysqli_query($conexion, $sql)) die();

	$clientes = array();
	while($row = mysqli_fetch_array($result)) 
	{ 
		$id = $row['id_areas'];
		$area = $row['experience_area'];
		$clientes [] = array ('id'=>$id, 'area' => $area );
	}

	asort($clientes);

	$close = mysqli_close($conexion) or die("Ha sucedido un error inexperado en la desconexion de la base de datos");

	$json_string = json_encode($clientes);
	header("Content-type: application/json; charset=utf-8");
	echo $json_string;
?>