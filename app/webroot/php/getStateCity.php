<?php
	session_name("CAKEPHP");
	session_start();
	
		if((isset($_SESSION['Auth'])) and (!empty($_SESSION['Auth'])) and (isset($_SESSION['Auth']['User']['StudentProfile']['state']))):
			$array[] = array('estadoSeleccionado' => $_SESSION['Auth']['User']['StudentProfile']['state']);
			$array[] = array('ciudadSeleccionada' => $_SESSION['Auth']['User']['StudentProfile']['city']);
		else:
			$array[] = array('estadoSeleccionado' => '');
			$array[] = array('ciudadSeleccionada' => '');
		endif;
	
	echo json_encode($array);

?>