<?php 
	$this->layout = 'student'; 
?>

				<div class="table-responsive">
					  <table class="table table-condensed" style="color: white;" >
						<thead>
						<tr class="active">
							<th colspan="2" style="text-align: center; color: #000" >Detalles</th>
						</tr>
						</thead>
						<tbody>
							<tr><td>Idioma</td><td><?php echo $idioma['StudentLenguage']['language_id']; ?></td></tr>
							<tr><td>Nivel de lectura</td><td>
							<?php 
								$nivelLectura = $idioma['StudentLenguage']['reading_level']; 
								if($nivelLectura == '1'):
									echo 'BAJO';
								else:
									if($nivelLectura == '2'):
										echo 'MEDIO';
									else:
										if($nivelLectura == '3'):
											echo 'ALTO';
										else:
											echo 'NO ESPECIFICADO';
										endif;
									endif;
								endif;							
							?></td></tr>
							<tr><td>Nivel de escritura</td><td>
							<?php 
								$nivelEscritura = $idioma['StudentLenguage']['writing_level'];
								if($nivelEscritura == '1'):
									echo 'BAJO';
								else:
									if($nivelEscritura == '2'):
										echo 'MEDIO';
									else:
										if($nivelEscritura == '3'):
											echo 'ALTO';
										else:
											echo 'NO ESPECIFICADO';
										endif;
									endif;
								endif;
							?></td></tr>
							<tr><td>Nivel de conversation</td><td>
							<?php 
								$nivelConversacion = $idioma['StudentLenguage']['conversation_level'];							
								if($nivelConversacion == '1'):
									echo 'BAJO';
								else:
									if($nivelConversacion == '2'):
										echo 'MEDIO';
									else:
										if($nivelConversacion == '3'):
											echo 'ALTO';
										else:
											echo 'NO ESPECIFICADO';
										endif;
									endif;
								endif;
							?></td></tr>
							<tr><td>Certificación</td><td><?php echo $idioma['StudentLenguage']['certification']; ?></td></tr>
							<tr><td>Año de certificación</td><td><?php echo $idioma['StudentLenguage']['certification_year']; ?></td></tr>
							<tr><td>Puntaje</td><td><?php echo $idioma['StudentLenguage']['score'].' '.'pts.'; ?></td></tr>
						</tbody>
					</table>
				</div>
