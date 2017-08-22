<?php 
	$this->layout = 'student'; 
?>
	
			<?php echo $this->Session->flash(); ?>	

				<div class="table-responsive">
					    <table class="table table-condensed" style="color: white;" >
						<thead>
						<tr class="active">
							<th colspan="2" style="text-align: center; " >Detalles de formación académica</th>
						</tr>
						</thead>
						<tbody>
							<tr><td>Institución UNAM</td><td>
							<?php 
								$estudianteUnam = $StudentProfessionalProfile['StudentProfessionalProfile']['unam_student'];
								if($estudianteUnam == 's'):
									echo 'SI';
								else:
									echo 'NO';
								endif; ?>
							</td></tr>
							
							<tr><td>Facultad</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['undergraduate_institution']; ?></td></tr>
							 
							<?php if($estudianteUnam == 'n'): ?>	 
								<tr><td>Institución</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['another_undergraduate_institution']; ?></td></tr>
							<?php endif; ?>
							 
							<tr><td>
								<?php 
									if($StudentProfessionalProfile['StudentProfessionalProfile']['academic_formation_type'] == '1'):
										echo "Carrera relacionada";
									else:
										echo "Área relacionada";
									endif;
								?>
								</td><td><?php echo $StudentProfessionalProfile['Career']['description']; ?></td></tr>
							
							<?php if($estudianteUnam == 'n'): ?>	 
								<tr><td>
								<?php 
									if($StudentProfessionalProfile['StudentProfessionalProfile']['academic_formation_type'] == '1'):
										echo "Carrera";
									else:
										echo "Área";
									endif;
								?>
								</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['another_career']; ?></td></tr>
							<?php endif; ?>
							 
							<tr><td>Estatus académico</td><td>
							<?php 
								if($StudentProfessionalProfile['StudentProfessionalProfile']['academic_status'] == '1'):
									echo 'ESTUDIANTE';
								else:
									if($StudentProfessionalProfile['StudentProfessionalProfile']['academic_status'] == '2'):
										echo 'EGRESADO';
									else:
										if($StudentProfessionalProfile['StudentProfessionalProfile']['academic_status'] == '3'):
											echo 'TITULADO';
										else:
											echo 'NO ESPECIFICADO';
										endif;
									endif;
								endif; ?>
							</td></tr>
							
							<?php if($StudentProfessionalProfile['StudentProfessionalProfile']['academic_status'] == '1'): ?>	 
								<tr><td>Semestre</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['semester']; ?></td></tr>
							<?php endif; ?>
							 
							<tr><td>Año de ingreso</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['entrance_year_degree']; ?></td></tr>
							 
							<?php if($StudentProfessionalProfile['StudentProfessionalProfile']['academic_status'] <> '1'): ?>	 
								<tr><td>Año de egreso</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['egress_year_degree']; ?></td></tr>
							<?php endif; ?>
							  
							<tr><td>Promedio</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['average_degree']; ?></td></tr>
							 
							<tr><td>Movilidad estudiantil</td><td>
							<?php 
								if($StudentProfessionalProfile['StudentProfessionalProfile']['student_mobility'] == 's'):
									echo 'SI';
								else:
									echo 'NO';
								endif; ?>
							</td></tr>
							
							<?php if($StudentProfessionalProfile['StudentProfessionalProfile']['student_mobility'] == 's'): ?>	 
								<tr><td>Institución</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['student_mobility_institution']; ?></td></tr>
								<tr><td>Nombre del programa / proyecto</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['student_mobility_program']; ?></td></tr>
								<tr><td>Duración</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['student_mobility_duration']; ?></td></tr>
								<tr><td>País</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['student_mobility_city']; ?></td></tr>
								<tr><td>Estado</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['student_mobility_state']; ?></td></tr>
							<?php endif; ?>
							
							<tr><td>Becado</td><td>
							<?php 
								if($StudentProfessionalProfile['StudentProfessionalProfile']['scholarship'] == 's'):
									echo 'SI';
								else:
									echo 'NO';
								endif; ?>
							</td></tr>
							
							<?php if($StudentProfessionalProfile['StudentProfessionalProfile']['scholarship'] == 's'): ?>	 
								<tr><td>Programa</td><td><?php echo $StudentProfessionalProfile['StudentProfessionalProfile']['scholarship_program']; ?></td></tr>
							<?php endif; ?>
						
						</tbody>
					</table>
				</div>
