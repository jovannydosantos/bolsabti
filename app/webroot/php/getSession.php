<?php
	session_name("CAKEPHP");
	session_start();
	if(isset($_SESSION['escuelaSeleccionada'])):
		$array[] = array('escuelaSeleccionada' => $_SESSION['escuelaSeleccionada']);
		$array[] = array('carreraSeleccionada' => $_SESSION['carreraSeleccionada']);
	else:
		$array[] = array('escuelaSeleccionada' => '');
		$array[] = array('carreraSeleccionada' => '');
	endif;
	echo json_encode($array);
?>