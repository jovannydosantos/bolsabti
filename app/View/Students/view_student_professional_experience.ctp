<?php 
	$this->layout = 'student'; 
?>
	<style>
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
		 border-top: 0 none;
	}
	</style>
			<?php echo $this->Session->flash(); ?>	

			<div class="table-responsive">

					<?php 
						$cont = 1;
						foreach($experiencias as $k => $experiencia):
					?>
					
					  <table class="table table-condensed" style="color: white; " >
						<thead>
						<tr class="active">
							<th colspan="2" style="text-align: center" >Detalles de experiencia profesional en  <?php echo  $experiencia['StudentProfessionalExperience']['company_name']; ?></th>
						</tr>
						</thead>
						<tbody>
							<tr><th>Trabajas actualmente:</th><td><?php
									$trabajando = $experiencia['StudentProfessionalExperience']['working'];
									if($trabajando == 's'):
										echo "Si";
									else:
										if($trabajando == 'n'):
											echo "No";
										else:
											echo "No especificado";
										endif;
									endif;
							?></td></td></tr>
							<tr><th>Tipo de contrato:</th><td><?php 
									$contrato = $experiencia['StudentProfessionalExperience']['contract_type'];
											if($contrato == '1'):
												echo "Indefinido";
											else:
												if($contrato == '2'):
													echo "Temporal";
												else:
													if($contrato == '3'):
														echo "Para la formación y el aprendizaje";
													else:
														if($contrato == '4'):
															echo "Prácticas";
														else:
															echo "No especificado";
														endif;
													endif;
												endif;
											endif;
							?></td></tr>
							<tr><th>País:</th><td><?php echo $experiencia['StudentProfessionalExperience']['country']; ?></td></tr>
							<tr><th>Estado:</th><td><?php echo $experiencia['StudentProfessionalExperience']['state']; ?></td></tr>
							<tr><th>Empresa / Institución:</th><td><?php echo $experiencia['StudentProfessionalExperience']['company_name']; ?></td></tr>
							<tr><th>Giro:</th><td><?php
									$giro = $experiencia['StudentProfessionalExperience']['company_rotation'];
										if($giro == '1'):
												echo "Industria";
											else:
												if($giro == '2'):
													echo "Extractiva";
												else:
													if($giro == '3'):
														echo "Manufacturera";
													else:
														if($giro == '4'):
															echo "De consumo final";
														else:
															if($giro == '5'):
																echo "De producción";
															else:
																if($giro == '6'):
																	echo "comercial";
																else:
																	if($giro == '7'):
																		echo "Servicio";
																	else:
																		echo "No especificado";
																	endif;
																endif;
															endif;
														endif;
													endif;
												endif;
											endif;
							?></th></td></tr>
							
							<?php 
							$c = 1;
							foreach($experiencia['StudentWorkArea'] as $k => $puesto):
							?>
								<tr><th colspan="2" style="text-align: center">Puesto <?php echo $c; ?></th></tr>
								<tr><th>Puesto:</td><td><?php echo $puesto['job_name']; ?></td></tr>
								<tr><th>Puesto equivalente en el mercado:</th><td><?php echo $puesto['equivalent_job']; ?></td></tr>
								<tr><th>Área de experiencia:</th><td><?php echo $puesto['experience_area']; ?></td></tr>
								<tr><th>Subárea de experiencia:</th><td><?php echo $puesto['experience_subarea']; ?></td></tr>
								<tr><th>Fecha inicio.</th><td><?php echo $puesto['start_date']; ?></td></tr>
								<tr><th>Fecha término / Actual:</th><td><?php echo $puesto['end_date']; ?></td></tr>
								
								<tr><th  colspan="2" style="text-align: center" class="active">Responsabilidades en el puesto</th></tr>
								
								<?php 
									$cont = 1;
									foreach($puesto['StudentResponsability'] as $k => $responsabilidad):
								?>
							
									<tr><td colspan="2"><?php  echo $cont . '.- '  . $responsabilidad['responsability']; ?></td></tr>
								
								<?php 
									$cont++;
									endforeach; 
								?>
								
								
								<tr><th style="text-align: center" colspan="2">Logros en el puesto</th></tr>
								
								<?php 
									$cont2 = 1;
									foreach($puesto['StudentAchievement'] as $k => $logro):
								?>
							
									<tr><td colspan="2"><?php  echo $cont2 . '.- ' .  $logro['achievement']; ?></td></tr>
								
								<?php
									$cont2++;								
									endforeach; 
								?>
								
							<?php 
							$c++;
							endforeach; 
							?>
							
						</tbody>
					</table>
					
					<?php 
						endforeach; 
					?>
						
				</div>