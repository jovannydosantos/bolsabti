	<?php 
		$this->layout = 'company'; 
		echo $this->Session->flash();
		$meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	?>
	<script>
		$(document).ready(function() {
			<?php if($mesSeleccionado > 1 ): ?>
				document.getElementById('<?php echo $mesSeleccionado; ?>').scrollIntoView();
			<?php endif; ?>
		});
	</script>
	<div class="col-md-4 col-md-offset-4" style="margin-bottom: 10px;">
		<p style="font-size: 26px;"><strong>Resumen anual <?php echo date('Y'); ?> </strong></p>
	</div>
	
	<div class="col-md-12" style="max-height: 320px; overflow-y: auto; padding-right: 0px;">
		<?php 
			$indexMeses = 2;
			$totalVacantes = 0;
			$totalPublicaciones = 0;
			$totalReportes = 0;
			foreach($meses as $mes): 

				$Vacantes = 0;
				foreach($datosMeses[$indexMeses] as $numVacantes): 
					$Vacantes = $numVacantes['CompanyJobProfile']['vacancy_number'] + $Vacantes;
				endforeach;
				
				$Reportes = 0;
				foreach($datosMeses[$indexMeses] as $numReportes): 
					$Reportes = count($numReportes['Report']) + $Reportes;
				endforeach;
				
				if($indexMeses == $mesSeleccionado):
					$textColor = 'color: #FFB71F;';
				else:
					$textColor = '';
				endif;
		?>
				<div class="col-md-2 col-md-offset-1"  style="margin-top: 5px;">
					<p style="font-size: 18px; <?php echo $textColor; ?> " id="<?php echo $indexMeses; ?>"><b>
					<?php 
					echo $this->Html->link($mes, 
												array(
														'controller'=>'Companies',
														'action'=>'profile',
														'?' => array(
																	'mes' => $indexMeses,
																	),
													),
												array(
														'style' => 'font-size: 18px; text-decoration: underline;'.$textColor,
													)	
												); 
					?>							
					</b></p>
				</div>
				<div class="col-md-3"  style="margin-top: 5px;">
					<p style="font-size: 18px; <?php echo $textColor; ?> ">Ofertas publicadas: <?php echo count ($datosMeses[$indexMeses]); ?> </p>
				</div>
				<div class="col-md-2"  style="margin-top: 5px;">
					<p style="font-size: 18px; <?php echo $textColor; ?> ">Vacantes: <?php echo $Vacantes; ?> </p>
				</div>
				<div class="col-md-3"  style="margin-top: 5px;">
					<p style="font-size: 18px; <?php echo $textColor; ?> ">Contrataciones: <?php echo $Reportes; ?></p>
				</div>
		<?php 
			$totalVacantes = $Vacantes + $totalVacantes;
			$totalPublicaciones = count ($datosMeses[$indexMeses]) + $totalPublicaciones;
			$totalReportes = $Reportes + $totalReportes;
			$indexMeses++;
			endforeach; 
		?>
	</div>
	
	<div class="col-md-12" style="">
		<div class="col-md-12">
			<hr size="0.5" style="border-color: white; color: white; border-width: 4px 0 0; margin-top: 15px;  margin-bottom: 0px;">
		</div>
		<div class="col-md-2 col-md-offset-1"  style="margin-top: 10px;">
			<p style="font-size: 18px;"><b>Total</b></p>
		</div>
		<div class="col-md-3"  style="margin-top: 10px; padding-left: 10px;">
			<p style="font-size: 18px;">Ofertas publicadas: <?php echo $totalPublicaciones; ?></p>
		</div>
		<div class="col-md-2"  style="margin-top: 10px; padding-left: 10px;">
			<p style="font-size: 18px;">Vacantes: <?php echo $totalVacantes; ?></p>
		</div>
		<div class="col-md-3"  style="margin-top: 10px; padding-left: 10px;">
			<p style="font-size: 18px;">Contrataciones: <?php echo $totalReportes; ?></p>
		</div>
	</div>
	
	<?php
		if($mesSeleccionado > 1):
		$indexMes = $mesSeleccionado-2;
	?>
			<div class="col-md-12" style="margin-bottom: 15px;  margin-top: 30px; margin-bottom: 0px;">
				<center>
				<p style="font-size: 26px;"><strong>Ofertas publicadas </strong></p>
				<p style="font-size: 26px;"><strong><?php echo $meses[$indexMes] . ' ' . date('Y'); ?> </strong></p>
				</center>
			</div>
								<div class="col-md-12">
			<hr size="0.5" style="border-color: white; color: white; border-width: 4px 0 0; margin-top: 15px;  margin-bottom: 0px;">
		</div>
			
			
			<?php 
				if(empty($datosMeses[$mesSeleccionado])):
			?>
					<div class="col-md-12" style="margin-bottom: 15px;  margin-top: 30px;">
					<center>
					<p style="font-size: 18px;"><strong>Sin ofertas publicadas </strong></p>
					</center>
					</div>
			<?php
				else:
					$hoy = date('Y-m-d');
					$fechaMax = strtotime ( '+15 day' , strtotime ( $hoy ) ) ;
					$fechaMax = date ( 'Y-m-j' , $fechaMax );	
					
			?>
				<div class="col-md-12" style="">
					<div class="col-md-3 col-md-offset-1"  style="margin-top: 10px;">
						<p style="font-size: 20px;"><b>Puesto</b></p>
					</div>
					<div class="col-md-2"  style="margin-top: 10px; padding-left: 10px;">
						<center><p style="font-size: 20px;"><b>Vacantes</b></p></center>
					</div>
					<div class="col-md-2"  style="margin-top: 10px; padding-left: 10px;">
						<center><p style="font-size: 20px;"><b>Contrataciones</b></p></center>
					</div>
					<div class="col-md-2"  style="margin-top: 10px; padding-left: 10px;">
						<center><p style="font-size: 20px;"><b>Estatus</b></p></center>
					</div>
					<div class="col-md-2"  style="margin-top: 10px; padding-left: 10px;">
						<center><p style="font-size: 20px;"><b>Vigencia</b></p></center>
					</div>
				</div>
				
					<?php
						$indexReportes = 0;
						foreach($datosMeses[$mesSeleccionado] as $detalles): 
					?>
						<div class="col-md-12">
							<div class="col-md-3 col-md-offset-1"  style="margin-top: 10px;">
								<p style="font-size: 18px;"><?php echo $detalles['CompanyJobProfile']['job_name']; ?></p>
							</div>
							<div class="col-md-2"  style="margin-top: 10px; padding-left: 10px;">
								<center><p style="font-size: 18px;"><?php echo  $detalles['CompanyJobProfile']['vacancy_number']; ?></p></center>
							</div>
							<div class="col-md-2"  style="margin-top: 10px; padding-left: 10px;">
								<center><p style="font-size: 18px;"><?php echo count($detalles['Report']); ?></p></center>
							</div>
							<div class="col-md-2"  style="margin-top: 10px; padding-left: 10px;">
								<center>
								<?php if($detalles['CompanyJobContractType']['status'] == 1): ?>
									<p style="font-size: 18px; color: #01DF3A">Activa</p>
								<?php else: ?>
									<p style="font-size: 18px; color: red;">Inactiva</p>
								<?php endif; ?>
								</center>
							</div>
							<div class="col-md-2"  style="margin-top: 10px; padding-left: 10px;">
								<center>
								<?php if(($detalles['CompanyJobProfile']['expiration'] >= $hoy) AND ($detalles['CompanyJobProfile']['expiration'] <= $fechaMax)): ?>
										<p style="font-size: 18px; color: #FE9A2E">Por expirar</p>
								<?php else: ?>	
									<?php if($detalles['CompanyJobProfile']['expiration'] < $hoy): ?>
											<p style="font-size: 18px; color: red">Expirada</p>
											<?php else: ?>	
												<p style="font-size: 18px; color: #01DF3A">Vigente</p>
									<?php endif; ?>	
								<?php endif; ?>	
								</center>
							</div>
						</div>
			<?php 
						$indexReportes++;
					endforeach;
				endif;
			?>
	<?php
		endif;
	?>