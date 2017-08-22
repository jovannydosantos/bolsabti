<?php 
	include('acceso.php');
 
	$sql = "SELECT Estado FROM zips Group By Estado";

	mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
 
	if(!$result = mysqli_query($conexion, $sql)) die();
 
		$clientes = array(); //creamos un array

		while($row = mysqli_fetch_array($result)){ 
			$estado=$row['Estado'];
			$clientes [] = array ('estado' => $estado);
		}
		
	asort($clientes);

	$close = mysqli_close($conexion) or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
	  
	$json_string = json_encode($clientes);
	header("Content-type: application/json; charset=utf-8");
	echo $json_string;
?>