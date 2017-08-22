<?php 
	$this->layout = 'usuario'; 
?>
    <div id="page-wrapper" >
        <div id="page-inner">
			
			<?php echo $this->Session->flash(); ?>	

				<?php echo $this->Html->link(
						'<span class="fa fa-chevron-left active"></span>&nbsp; Volver', 
							array(
								'controller'=>'Students',
								'action'=>'studentAcademicProject', $this->Session->read('Auth.User.id')),
							array(
								'class' => 'btn btn-default',
								'escape' => false)	
						); 				
				?>
				<?php echo $this->Html->link(
						'<span class="fa fa-home active"></span>&nbsp; Home', 
							array(
								'controller'=>'Students',
								'action'=>'usuarios'),
							array(
								'class' => 'btn btn-default',
								'escape' => false)	
						); 				
				?>
				<hr>
				<div class="table-responsive">
				
					<?php 
						$cont = 1;
						foreach($proyectos as $k => $proyecto):
					?>
					
					  <table class="table table-striped table-bordered table-hover table-condensed" >
						<thead>
						<tr class="active">
							<th colspan="2" style="text-align: center" >Detalles del proyecto <?php echo  $proyecto['StudentAcademicProject']['name']; ?></th>
						</tr>
						</thead>
						<tbody>
							<tr><th>Nivel de estudios:</th><td><?php
									$nivelEstudios = $proyecto['StudentAcademicProject']['education_level'];
									if($nivelEstudios == '1'):
										echo "Media básica";
									else:
										if($nivelEstudios == '2'):
											echo "Media Superior";
										else:
											if($nivelEstudios == '3'):
												echo "Superior";
											else:
												echo "No especificado";
											endif;
										endif;
									endif;
							?></td></td></tr>
							<tr><th>Tipo:</th><td><?php echo $proyecto['StudentAcademicProject']['type'];?></td></tr>
							<tr><th>País:</th><td><?php echo $proyecto['StudentAcademicProject']['country']; ?></td></tr>
							<tr><th>Estado:</th><td><?php echo $proyecto['StudentAcademicProject']['state']; ?></td></tr>
							<tr><th>Empresa / Institución:</th><td><?php echo $proyecto['StudentAcademicProject']['company']; ?></td></tr>
							<tr><th>Giro:</th><td><?php
									$giro = $proyecto['StudentAcademicProject']['company_rotation'];
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
							
								<tr><th  colspan="2" style="text-align: center" class="active">Responsabilidades en el puesto</th></tr>
								
								<?php 
									$cont = 1;
									foreach($proyecto['StudentAcademicProjectResponsability'] as $k => $responsabilidad):
								?>
							
									<tr class="success"><td colspan="2"><?php  echo $cont . '.- '  . $responsabilidad['responsability']; ?></td></tr>
								
								<?php 
									$cont++;
									endforeach; 
								?>
								
								
								<tr><th style="text-align: center" colspan="2" class="active">Logros  del puesto</th></tr>
								
								<?php 
									$cont2 = 1;
									foreach($proyecto['StudentAcademicProjectAchievement'] as $k => $logro):
								?>
							
									<tr class="success"><td colspan="2"><?php  echo $cont2 . '.- ' .  $logro['achievement']; ?></td></tr>
								
								<?php
									$cont2++;								
									endforeach; 
								?>

						</tbody>
					</table>
					
					<?php 
						endforeach; 
					?>
						
				</div>
				     
		</div>
	</div>