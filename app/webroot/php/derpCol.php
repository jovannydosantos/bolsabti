<?php 
 	include('acceso.php');
	 
	$sql = "SELECT Colonia FROM zips Where Municipio= '" . $_GET["mun"] ."' Group By Colonia";
	mysqli_set_charset($conexion, "utf8"); 

	if(!$result = mysqli_query($conexion, $sql)) die();
	 
	$clientes = array(); //creamos un array
	 
	while($row = mysqli_fetch_array($result))  
	{ 
		$mun=$row['Colonia'];
		$pieces = explode(";", $mun);
		foreach ($pieces as $value) {
			$datos [] = $value;
		}
	}
	asort($datos);
	foreach ($datos as $value) {
			$clientes [] = array ('col' => $value);
		}

	//desconectamos la base de datos
	$close = mysqli_close($conexion) or die("Ha sucedido un error inesperado en la desconexion de la base de datos");
	  
	//Creamos el JSON
	$json_string = json_encode($clientes);
	header("Content-type: application/json; charset=utf-8");
	echo $json_string;
?>