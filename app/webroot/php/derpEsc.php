<?php 
	include('acceso.php');

	if($_GET["level"]=='1'):
		$sql = "SELECT * FROM facultad_licenciaturas order by facultad_licenciatura";
	else:
		$sql = "SELECT * FROM  facultad_posgrados order by facultad_posgrado";
	endif;

	mysqli_set_charset($conexion, "utf8"); 

	if(!$result = mysqli_query($conexion, $sql)) die();

	$clientes = array(); 
	
	while($row = mysqli_fetch_array($result)) 
	{ 
		if($_GET["level"]=='1'):
			$escuela=$row['facultad_licenciatura'];
		else:
			$escuela=$row['facultad_posgrado'];
		endif;
		$id=$row['id'];
		$clientes [] = array ('id'=>$id,'escuela' => $escuela);
	}
	
	asort($clientes);

	$close = mysqli_close($conexion) or die("Ha sucedido un error inesperado en la desconexion de la base de datos");

	$json_string = json_encode($clientes);
	header("Content-type: application/json; charset=utf-8");
	echo $json_string;

?>