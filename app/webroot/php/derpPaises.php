<?php 
	include('acceso.php');
	 
	$sql = "SELECT country FROM countries Group By id";

	mysqli_set_charset($conexion, "utf8"); 

	if(!$result = mysqli_query($conexion, $sql)) die();
	 
	$clientes = array();
	 
	while($row = mysqli_fetch_array($result)) 
	{ 
		$pais = $row['country'];
		$clientes [] = array ('pais' => $pais);
	 
	}

	$close = mysqli_close($conexion) or die("Ha sucedido un error inesperado en la desconexion de la base de datos");
	  
	$json_string = json_encode($clientes);
	header("Content-type: application/json; charset=utf-8");
	echo $json_string;
?>