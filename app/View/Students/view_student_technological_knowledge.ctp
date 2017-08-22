<?php 
	$this->layout = 'student'; 
?>
   			
			<?php echo $this->Session->flash(); ?>	

				
				<div class="table-responsive">
					   <table class="table table-condensed" style="color: white;" >
						<thead>
						<tr class="active">
							<th colspan="2" style="text-align: center;  color: #000" >Detalles</th>
						</tr>
						</thead>
						<tbody>
							<tr><td>Categoría</td><td><?php echo $tecnologia['StudentTechnologicalKnowledge']['category_id']; ?></td></tr>
							<tr><td>Nombre</td><td><?php echo $tecnologia['StudentTechnologicalKnowledge']['name']; ?></td></tr>
							<tr><td>Otro</td><td><?php echo $tecnologia['StudentTechnologicalKnowledge']['other']; ?></td></tr>
							<tr><td>Nivel</td><td>
								<?php 
								$nivelComputacion = $tecnologia['StudentTechnologicalKnowledge']['level']; 							
								if($nivelComputacion == '1'):
									echo 'BAJO';
								else:
									if($nivelComputacion == '2'):
										echo 'MEDIO';
									else:
										if($nivelComputacion == '3'):
											echo 'ALTO';
										else:
											echo 'NO ESPECIFICADO';
										endif;
									endif;
								endif;
								?></td></tr>
							<tr><td>Certificación / Institución que lo acredita</td><td><?php echo $tecnologia['StudentTechnologicalKnowledge']['institution']; ?></td></tr>
						</tbody>
					</table>
				</div>
