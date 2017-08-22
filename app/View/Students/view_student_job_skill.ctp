<?php 
	$this->layout = 'student'; 
?>

			<?php echo $this->Session->flash(); ?>	

				<div class="table-responsive">
					  <table class="table table-condensed" style="color: white;" >
						<thead>
						<tr class="active">
							<th colspan="2" style="text-align: center;" >Detalles</th>
						</tr>
						</thead>
						<tbody>
							<tr><td>Categoría</td><td><?php echo $conocimiento['StudentJobSkill']['category_id']; ?></td></tr>
							<tr><td>Nombre</td><td><?php echo $conocimiento['StudentJobSkill']['name']; ?></td></tr>
							<tr><td>Empresa / Institución</td><td><?php echo $conocimiento['StudentJobSkill']['company']; ?></td></tr>
							<tr><td>Duración  (Horas)</td><td><?php echo $conocimiento['StudentJobSkill']['duration'].' '.'hrs.'; ?></td></tr>
							<tr><td>Fecha</td><td><?php echo $conocimiento['StudentJobSkill']['date']; ?></td></tr>
						</tbody>
					</table>
				</div>