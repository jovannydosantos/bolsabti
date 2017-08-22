<?php 
	include('acceso.php');

	$sql = "SELECT Municipio FROM zips Where Estado= '" . $_GET["edo"] ."' Group By Municipio";

	mysqli_set_charset($conexion, "utf8"); 

	if(!$result = mysqli_query($conexion, $sql)) die();
	 
	$clientes = array(); //creamos un array
	 
	while($row = mysqli_fetch_array($result))  
	{ 
		$mun=$row['Municipio'];
		$clientes [] = array ('mun' => $mun);
	}
	asort($clientes);
	$close = mysqli_close($conexion) or die("Ha sucedido un error inesperado en la desconexion de la base de datos");
	  
	$json_string = json_encode($clientes);
	header("Content-type: application/json; charset=utf-8");
	echo $json_string;
?>
