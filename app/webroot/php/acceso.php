<?php
	$server = "localhost";
	$user = "root";
	$pass = "";
	$bd = "unam";

	header('Content-Type: text/html; charset=utf8');
	header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET,POST,OPTIONS,DELETE,PUT");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    $conexion = mysqli_connect($server, $user, $pass,$bd) or die("Ha sucedido un error inesperado en la conexión a la base de datos");
?>