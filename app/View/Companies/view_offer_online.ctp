<?php 
	$this->layout = 'company'; 
?>
		
	<style>
		.panel-default > .panel-heading {
			background: #002377 none repeat scroll 0 0;
			color: #fff;
		}
		.panel-heading {
			border-top-left-radius: 0px;
			border-top-right-radius: 0px;
		}
		.panel {
			border-radius: 0px;
		}
		.panel-body {
			background: #fff none repeat scroll 0 0;
			color: #000;
		}
		h3{
			font-weight: bold;
		}
		.panel {
			box-shadow:  0 0 0 rgba(0, 0, 0, 0.8);
		}
		.catorce{
			font-size: 14px;
			font-weight: bold;
		}
	</style>
	<script>
		$(document).ready(function() {

			 $('#CompanyJobProfileExpirationYear').prepend('<option value="" selected>AAAA</option>');
			 $('#CompanyJobProfileExpirationMonth').prepend('<option value="" selected>MM</option>');
			 $('#CompanyJobProfileExpirationDay').prepend('<option value="" selected>DD</option>');
			 
		});	
		
		function saveVigencia(idJobProfile,fecha, fechaCreacion){
			var fechaArr = fecha.split('-');
			var aho = fechaArr[0];
			var mes = fechaArr[1];
			var dia = fechaArr[2];
			
			$("#CompanyJobProfileExpirationYear option[value='"+aho+"']").prop('selected', true);
			$("#CompanyJobProfileExpirationMonth option[value='"+mes+"']").prop('selected', true);
			$("#CompanyJobProfileExpirationDay option[value='"+dia+"']").prop('selected', true);
			
			var fechaArr = fechaCreacion.split('-');
			var aho = fechaArr[0];
			var mes = fechaArr[1];
			var dia = fechaArr[2];
			
			$("#CompanyJobProfileCreatedYear option[value='"+aho+"']").prop('selected', true);
			$("#CompanyJobProfileCreatedMonth option[value='"+mes+"']").prop('selected', true);
			$("#CompanyJobProfileCreatedDay option[value='"+dia+"']").prop('selected', true);
		
			document.getElementById('CompanyJobProfileId').value = idJobProfile;
			$('#myModalVigencia').modal('show');
		}
		
		function validate_fechaMayorQue(fechaInicial,fechaFinal){
			valuesStart=fechaInicial.split("/");
            valuesEnd=fechaFinal.split("/");

            // Verificamos que la fecha no sea posterior a la actual

            var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
            var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);

            if(dateStart>dateEnd)
            {
                return 1;
            }
            return 0;
        }
		
		function validarFecha(fecha){
				 //Funcion validarFecha 
				 //valida fecha en formato aaaa-mm-dd
				 var fechaArr = fecha.split('/');
				 var aho = fechaArr[2];
				 var mes = fechaArr[1];
				 var dia = fechaArr[0];
				 
				 var plantilla = new Date(aho, mes - 1, dia);//mes empieza de cero Enero = 0

				 if(!plantilla || plantilla.getFullYear() == aho && plantilla.getMonth() == mes -1 && plantilla.getDate() == dia){
				 return true;
				 }else{
				 return false;
				 }
		}
		
		function fechaMax(fecha, fechaCreacion){
		<?php if(($this->Session->read('Auth.User.role')=='administrator') OR ($this->Session->read('Auth.User.role')=='subadministrator')): ?>
			var hoy = new Date();
			var dd = hoy.getDate();
			var mm = hoy.getMonth()+1; //hoy es 0!
			var yyyy = hoy.getFullYear();
			hoy = yyyy+'-'+mm+'-'+dd;
			var fechaCreacion = hoy;
		<?php else: ?>
			var fechaCreacion = fechaCreacion;
		<?php endif; ?>
				
				var fechaArrCreacion = fechaCreacion.split('-');
				var aho2 = fechaArrCreacion[0];
				var mes2 = fechaArrCreacion[1];
				var dia2 = fechaArrCreacion[2];
				var fechaCreacionOferta = new Date(aho2,mes2,dia2);

				var fechaArr = fecha.split('/');
				var aho = fechaArr[2];
				var mes = fechaArr[1];
				var dia = fechaArr[0];
				var fechaPropuesta = new Date(aho, mes-1, dia); 

				if(fechaPropuesta > fechaCreacionOferta){
					return false;
				} else{
					return true;
				}
		
	}
	
		function validateVigenciaForm(){

				var f = new Date();
				var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
				
				var fechaFinal = document.getElementById('CompanyJobProfileExpirationDay').value	+ "/" +
										document.getElementById('CompanyJobProfileExpirationMonth').value	+ "/" +
										document.getElementById('CompanyJobProfileExpirationYear').value;
				
				var fechaCreacion = document.getElementById('CompanyJobProfileCreatedYear').value	+ "-" +
										document.getElementById('CompanyJobProfileCreatedMonth').value	+ "-" +
										document.getElementById('CompanyJobProfileCreatedDay').value;
				
				
				selectedIndexDay = document.getElementById("CompanyJobProfileExpirationDay").selectedIndex;
				selectedIndexMonth = document.getElementById("CompanyJobProfileExpirationMonth").selectedIndex;
				selectedIndexYear = document.getElementById("CompanyJobProfileExpirationYear").selectedIndex;
				
				responseValidateDate = validarFecha(fechaFinal);
				fechaMaxima = fechaMax(fechaFinal,fechaCreacion);
				
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					jAlert('Seleccione la fecha completa para la vigencia', 'Mensaje');
					document.getElementById('CompanyJobProfileExpirationYear').focus();
					return false;
				}else 
				 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
					jAlert('La fecha no debe ser menor a la actual', 'Mensaje');
					document.getElementById('CompanyJobProfileExpirationYear').focus();
					return false;
				}else 
				if(fechaMaxima == false){
					<?php if(($this->Session->read('Auth.User.role')=='administrator') OR ($this->Session->read('Auth.User.role')=='subadministrator')): ?>
						jAlert('La fecha de vigencia es de máximo 1 mes respecto a la fecha actual', 'Mensaje');
					<?php else: ?>
						jAlert('La fecha de vigencia es de máximo 1 mes respecto a la fecha de creación de la oferta', 'Mensaje');
					<?php endif; ?>		
					document.getElementById('CompanyJobProfileExpirationDay').focus();
					return false;
				}else
				if(responseValidateDate == false){
					jAlert('La fecha de vigencia es incorrecta', 'Mensaje');
					document.getElementById('CompanyJobProfileExpirationDay').focus();
					return false;
				}else{
					return true;
				}
			}
		
		function deleteOffer(param){
				document.getElementById('focusOfferId'+param).scrollIntoView();
				jConfirm('¿Realmente desea eliminar la oferta?', 'Confirmación', function(r){
					if( r ){						
						$("#deleteOfferId"+param).click();
					}
				});
		}
			
	</script>
	<div>
		<?php echo $this->Session->flash(); ?>
		
		<!--Oferta-->
		<div class="col-md-12">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title" >Oferta</h3>
				<div class="col-xs-3" style=" float: right;  margin-top: -20px; width: 250px; padding-right: 0px; padding-left: 0px;">
					<div class="grises2">
						<?php 
									$var = 0;
									$vista = 0;
									foreach($company['CompanyViewedOffer']as $k => $viewed):
										if($viewed['company_job_profile_id'] == $oferta['CompanyJobProfile']['id']):
											$vista = 1;
											 break;
										endif;
									endforeach;
					
									if($vista == 0):
										echo $this->Html->image('student/visto.png',
											array(
												'title' => 'Oferta no vista',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:default;'
										)); 
										
									else:
									
										echo $this->Html->image('student/noVisto.png',
											array(
												'title' => 'Oferta vista',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:default;'
										)); 
									endif;
								
								?>
								
								<?php 
								 // Ver perfiles dentro de la oferta
									echo $this->Html->image('student/lista.png',
											array(
												'title' => 'Ver candidatos dentro de oferta',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'viewCandidateOffer',
																'?' => array(
																			'id' => $oferta['CompanyJobProfile']['id'],
																			'nuevaBusqueda' => 'nuevaBusqueda',
																		)
																),
											));
								?>
								
								<?php 
								 // Editar oferta
									echo $this->Html->image('student/lapiz.png',
											array(
												'title' => 'Editar oferta',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'companyJobOffer',
																'?' => array(
																			'id' => $oferta['CompanyJobProfile']['id'],
																			'editar' => 1,
																		)
																),
												));
								?>
								
								<?php 
									// Cambiar vigencia de la oferta
									echo $this->Html->image('student/visible.png',
											array(
												'title' => 'Cambiar vigencia de oferta',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'saveVigencia('.$oferta['CompanyJobProfile']['id'].',"'.$oferta['CompanyJobProfile']['expiration'].'","'.$oferta['CompanyJobProfile']['created'].'");',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
												)
											);
								?>
								
								<?php 
									 // Reportar contratación
									echo $this->Html->image('student/contratado.png',
											array(
												'title' => 'Reportar contratación ',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'studentReport', 
																'?' => array(
																			'companyJobProfileId' => $oferta['CompanyJobProfile']['id'],
																			'nuevaBusqueda' => 'nuevaBusqueda',
																			)
																),
												)
										);
								?>
								
								<?php 
								//Descargar Pdf
									echo $this->Html->link(
														$this->Html->image('student/descargado.png', array('escape' => false,'style' => 'width: 17px; height: 20px; margin-right: 6px; cursor: pointer; ')),
														array(
															'controller' => 'Companies', 
															'action' => 'viewOnlyOfferPdf',$oferta['CompanyJobProfile']['id'] 
															), 
														array('target' => '_blank','escape' => false,'title' => 'Descargar oferta en PDF',)
											);
								?>
								
								<?php 
								 // Descativar oferta
								 if(($this->Session->read('Auth.User.role')=='administrator') OR ($this->Session->read('Auth.User.role')=='subadministrator')): 
									// if($oferta['CompanyJobContractType']['status'] == 0):
									// 	echo $this->Html->image('student/noActiva.png',
									// 		array(
									// 			'title' => 'Oferta inactiva',
									// 			'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
									// 			'class' => 'class="img-responsive center-block"',
									// 			'url' => array(
									// 							'controller'=>'Companies',
									// 							'action'=>'enableDisableOffer',
									// 							'?' => array(
									// 										'id' => $oferta['CompanyJobContractType']['id'],
									// 										'estatus' => $oferta['CompanyJobContractType']['status'],
									// 									)
									// 							),
									// 			)
									// 	);
									// else:
									// 	echo $this->Html->image('student/activa.png',
									// 		array(
									// 			'title' => 'Oferta activa',
									// 			'class' => 'class="img-responsive center-block"',
									// 			'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
									// 			'url' => array(
									// 							'controller'=>'Companies',
									// 							'action'=>'enableDisableOffer',
									// 							'?' => array(
									// 										'id' => $oferta['CompanyJobContractType']['id'],
									// 										'estatus' => $oferta['CompanyJobContractType']['status'],
									// 									)
									// 							),
									// 		));
									// endif;
									
								 // Descativar/Actvar oferta
									if($oferta['CompanyJobContractType']['status'] == null):
										echo $this->Html->image('student/noActiva.png',
												array(
													'title' => 'Oferta incompleta',
													'class' => 'class="img-responsive center-block"',
													'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: help;',
													'onclick' => 'ofertaIncompleta();',
													)
												);	
									else:	
										if(strtotime($oferta['CompanyJobProfile']['expiration']) < strtotime(date('Y-m-d'))):
											echo $this->Html->image('student/noActiva.png',
													array(
														'title' => 'Oferta expirada',
														'class' => 'class="img-responsive center-block"',
														'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: help;',
														'onclick' => 'ofertaExpirada();',
														)
													);	
										else:		
											if($oferta['CompanyJobContractType']['status'] == 0):
												echo $this->Html->image('student/noActiva.png',
													array(
														'title' => 'Oferta inactiva',
														'class' => 'class="img-responsive center-block"',
														'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
														'url' => array(
																		'controller'=>'Administrators',
																		'action'=>'enableDisableOffer',
																		'?' => array(
																					'id' => $oferta['CompanyJobContractType']['id'],
																					'estatus' => $oferta['CompanyJobContractType']['status'],
																				)
																		),
														)
												);
											else:
												echo $this->Html->image('student/activa.png',
													array(
														'title' => 'Oferta activa',
														'class' => 'class="img-responsive center-block"',
														'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
														'url' => array(
																		'controller'=>'Administrators',
																		'action'=>'enableDisableOffer',
																		'?' => array(
																					'id' => $oferta['CompanyJobContractType']['id'],
																					'estatus' => $oferta['CompanyJobContractType']['status'],
																				)
																		),
													));
											endif;
										endif;
									endif;
								
								else:
									if($oferta['CompanyJobContractType']['status'] == 0):
										echo $this->Html->image('student/noActiva.png',
											array(
												'title' => 'Oferta inactiva',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'mensajeActivaDesactiva();',
												)
										);
									else:
										echo $this->Html->image('student/activa.png',
											array(
												'title' => 'Oferta activa',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
												'onclick' => 'mensajeActivaDesactiva();',
											));
									endif;
								endif;
								?>
								
								<?php 
								 // Eliminar oferta
								 echo $this->Html->image('student/eliminar.png',
											array(
												'title' => 'Eliminar oferta',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor: pointer;',
												'class' => 'class="img-responsive center-block"',
												'id' => 'focusOfferId'.$oferta['CompanyJobProfile']['id'],
												'onclick' => 'deleteOffer('.$oferta['CompanyJobProfile']['id'].');'
												)
										);
										
								 echo $this->Form->postLink(
														$this->Html->image('student/eliminar.png',
														array('alt' => 'Delete', 'title' =>'Eliminar oferta', 'style' => 'width: 20px; height: 20px; display: none','id'=>'deleteOfferId'.$oferta['CompanyJobProfile']['id'] )), 
														array('action' => 'deleteOffer',$oferta['CompanyJobProfile']['id']), 
														array('escape' => false) 
														);
								?>
					</div>
				</div>
			  </div>
			  <div class="panel-body" style="text-align: center">
					<?php 
						$caracteres = strlen($oferta['CompanyJobProfile']['id']);
						$faltantes = 5 - $caracteres;	
						if($faltantes > 0):
							$ceros = '';
							for($cont=0; $cont<=$faltantes;$cont++):
								$ceros .= '0';
							endfor;
							$folio = $ceros.$oferta['CompanyJobProfile']['id'];
						else:
							$folio = strlen($oferta['CompanyJobProfile']['id']);
						endif;
					?>
						<b style="font-size: 14px;">
									<?php 
										if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
											echo $oferta['CompanyJobOffer']['company_name']; 
										else:
											if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']=='')):
												echo 'Confidencial';
											else:
												if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
													echo $oferta['CompanyJobOffer']['company_name']; 
												else:
													if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($oferta['CompanyJobOffer']['company_name']=='')):
														echo $oferta['Company']['CompanyProfile']['company_name'];
													else:
														echo 'Sin nombre de empresa';
													endif;
												endif;
											endif;
										endif;
									?>
						</b><br>
					<?php
						echo '<b style="font-size: 14px;">Puesto:</b><span style="color:#000; font-size: 14px;"> ' . $oferta['CompanyJobProfile']['job_name'] . '</span><br>';
						echo '<b style="font-size: 14px;">Folio:</b><span style="color:#000; font-size: 14px;">  ' .$folio. '</span><br>';
						echo '<b style="font-size: 14px;">Vigencia:</b><span style="color:#000; font-size: 14px;">  ' . date("d/m/Y",strtotime($oferta['CompanyJobProfile']['expiration'])) . '</span>';
					?>
					<br>
			  </div>
			</div>
		</div>
		
		<!--Responsable de la oferta-->
		<?php  if($oferta['CompanyJobOffer']['show_details_responsible']=='s'): ?>
			<div class="col-md-12">
				<div class="panel panel-default" style="padding-left: 0px;">
				  <div class="panel-heading">
					<h3 class="panel-title" >Responsable de la oferta</h3>
				  </div>
				  <div class="panel-body" style="text-align: left">
				<div class="col-md-12">
				  <?php 
					if($oferta['CompanyJobOffer']['same_contact']=='n'):
						echo '<span class="catorce">Nombre: </span>' . $oferta['CompanyJobOffer']['responsible_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_last_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_second_last_name'].'<br>';
						echo '<span class="catorce">Puesto: </span>' . $oferta['CompanyJobOffer']['responsible_position'] . '<br>';
						echo '<span class="catorce">Tel.: </span> (' . $oferta['CompanyJobOffer']['responsible_long_distance_cod'] .') '. $oferta['CompanyJobOffer']['responsible_telephone'] . ' ';
						if($oferta['CompanyJobOffer']['responsible_phone_extension']<>''):
							echo '<span class="catorce"> - ext. </span> '.$oferta['CompanyJobOffer']['responsible_phone_extension'];
						endif;
						echo '<br>';
						if($oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']<>''):
							echo '<span class="catorce">Cel.: </span> ('.$oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']. ') ' .$oferta['CompanyJobOffer']['responsible_cell_phone'] .'<br>';
						endif;	
						if($oferta['CompanyJobOffer']['company_email']<>''):
							echo '<span class="catorce">Correo.: </span> '.$oferta['CompanyJobOffer']['company_email'].'<br>';
						endif;	
					else:
						echo '<span class="catorce">Nombre: </span>' . $oferta['Company']['CompanyContact']['name']. ' ' .  $oferta['Company']['CompanyContact']['last_name']. ' ' .  $oferta['Company']['CompanyContact']['second_last_name'].'<br>';
						echo '<span class="catorce">Puesto: </span>' . $oferta['Company']['CompanyContact']['job_title'] . '<br>';
						echo '<span class="catorce">Tel.: </span> (' . $oferta['Company']['CompanyContact']['long_distance_cod'] .') '. $oferta['Company']['CompanyContact']['telephone_number'] . ' ';
						if($oferta['Company']['CompanyContact']['phone_extension']<>''):
							echo ' <span class="catorce"> - ext. </span> '.$oferta['Company']['CompanyContact']['phone_extension'];
						endif;
						echo '<br>';
						if(($oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']<>'') and ($oferta['Company']['CompanyContact']['cell_phone']<>'')):
							echo '<span class="catorce">Cel.: </span> ('.$oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']. ') ' .$oferta['Company']['CompanyContact']['cell_phone'] .'<br>';
						endif;
						if($oferta['Company']['email']<>''):
							echo '<span class="catorce">Correo.: </span> '.$oferta['Company']['email'].'<br>';
						endif;	
					endif;
					// if($oferta['Company']['CompanyProfile']['state_sede']<>''):
					// 	echo '<span class="catorce">Sede: </span> ' . 
					// 	$oferta['Company']['CompanyProfile']['state_sede'] . ' - ' .
					// 	$oferta['Company']['CompanyProfile']['city_sede'] . ' - ' .
					// 	$oferta['Company']['CompanyProfile']['subdivision_sede'] . ' - ' .
					// 	$oferta['Company']['CompanyProfile']['street_sede'] . '<br>';
					// endif;
				  ?>
				  </div>
				  </div>
				</div>
			</div>
		<?php endif; ?>
		
		<!--Perfil de la oferta-->
		<div class="col-md-12">
			<div class="panel panel-default" style="padding-right: 0px; " >
				  <div class="panel-heading">
					<h3 class="panel-title" >Perfil de la oferta <span style="float: right;">Número de vacantes: <span style="color: #FFB71F;"><?php echo ' ' . $oferta['CompanyJobProfile']['vacancy_number']; ?> </span></span></h3>
				  </div>
				  <div class="panel-body" style="text-align: left; max-height: 200px; overflow-y: auto;">
					
					<?php 
						echo '<div class="col-md-12"><span class="catorce">Giro:</span> ' . $oferta['Rotation']['rotation'].'</div>';
						echo '<div class="col-md-6"><span class="catorce">Área de Interés:</span> ' . $oferta['ExperienceArea']['experience_area'] . '</div>';
						if($oferta['ExperienceTime']['experience_time']<>''):
							echo '<div class="col-md-6"><span class="catorce">Experiencia:</span> ' . $oferta['ExperienceTime']['experience_time'].'</div>';
						endif;
					?>
					
					<br><br><br>
					<div class="col-md-12">
						Actividades a desarrollar:
						<br><br>
						
						<?php 	
							echo $oferta['CompanyJobProfile']['activity'] . '<br>'; 
						?>
					</div>
					
					<?php 	
						if($oferta['CompanyJobProfile']['disability'] == 's'):
					?>
						<br><br><br><br><div class="col-md-12">
							<span class="catorce">Oferta Incluyente:</span><?php echo ' ' . $oferta['DisabilityType']['disability_type']; ?>
						</div><br><br>
					<?php 	
						endif;
					?>
					
					
				  </div>
			</div>
		</div>
		
		<!--Modalidad de contratación-->
		<div class="col-md-12">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title" >Modalidad de contratación</h3>
			  </div>
			  <div class="panel-body" style="text-align: left; max-height: 400px; overflow-y: auto;">
				<div class="col-md-12">
				<?php 
					if(isset($oferta['CompanyJobContractType']['confidential_salary'])):
						echo '<span class="catorce">Sueldo: </span>'; 
						if($oferta['CompanyJobContractType']['confidential_salary']=='s'):
							echo 'Confidencial';	
						else:
							echo $oferta['CompanyJobContractType']['Salary']['salary'];
						endif;
						echo '<br>';
					endif;
					
					
					if(!empty($oferta['CompanyJobContractType']['CompanyJobContractTypeBenefit'])):
						echo '<span class="catorce">Prestaciones: </span>';
						$cont = 0;
						foreach($oferta['CompanyJobContractType']['CompanyJobContractTypeBenefit'] as $beneficio):
							$cont++;
							echo $beneficio['Benefit']['benefit'];
							if(count($oferta['CompanyJobContractType']['CompanyJobContractTypeBenefit']) <> $cont):
								echo ' / ';
							else:
								echo '<br>';
							endif;
						endforeach;
					endif;
					
					if($oferta['CompanyJobContractType']['other_benefits']<>''):
						echo '<span class="catorce">Otras prestaciones: </span>'; 
						echo $oferta['CompanyJobContractType']['other_benefits'];
						echo '<br>';
					endif;
					echo '<br>';
				?>
				</div>
				<div class="col-md-8">
				<?php
					if(isset($oferta['CompanyJobContractType']['state'])):
						echo '<span class="catorce">Lugar de trabajo: </span>' . $oferta['CompanyJobContractType']['state'] . ' ' . $oferta['CompanyJobContractType']['subdivision'] . '<br>';
					endif;
					if(isset($oferta['CompanyJobContractType']['ContractType']['contract_type'] )):
						echo '<span class="catorce">Tipo de contrato: </span>' . $oferta['CompanyJobContractType']['ContractType']['contract_type'] . '<br>';
					endif;
					if(isset($oferta['CompanyJobContractType']['Workday']['workday'])):
						echo '<span class="catorce">Jornada laboral: </span>' . $oferta['CompanyJobContractType']['Workday']['workday'] . '<br>';
					endif;
					
					if(isset($oferta['CompanyJobContractType']['mobility'])):
							if($oferta['CompanyJobContractType']['mobility']=='s'):
								echo '<span class="catorce">Disponibilidad para viajar: </span>' ;
								if($oferta['CompanyJobContractType']['mobility_option']=='1'):
									echo 'Dentro del país - '. $oferta['CompanyJobContractType']['mobility_city'];
								else:
									echo 'Fuera del país  - '. $oferta['CompanyJobContractType']['mobility_city'];
								endif;
								echo  '<br>';
							else:
								echo '<span class="catorce">Disponibilidad para viajar:</span> No <br>';
							endif;
					endif;
					
					if(isset($oferta['CompanyJobContractType']['change_residence'])):
							if($oferta['CompanyJobContractType']['change_residence']=='s'):
								echo '<span class="catorce">Disponibilidad para cambiar de residencia: </span>' ;
								if($oferta['CompanyJobContractType']['change_residence_option']=='1'):
									echo 'Dentro del país - '. $oferta['CompanyJobContractType']['change_residence_state'];
								else:
									echo 'Fuera del país  - '. $oferta['CompanyJobContractType']['change_residence_state'];
								endif;
								echo  '<br>';
							else:
								echo '<span class="catorce">Disponibilidad para cambiar de residencia:</span> No <br>';
							endif;
					endif;
				?>
				</div>
				
				<div class="col-md-4">
					<?php 
						if(isset($oferta['CompanyJobContractType']['contract_length'])):
							echo '<span class="catorce">Duración del contrato: </span>' . $oferta['CompanyJobContractType']['contract_length'].'<br>';
						endif;
						
						if(isset($oferta['CompanyJobContractType']['schedule'])):
							echo '<span class="catorce">Horario: </span>' . $oferta['CompanyJobContractType']['schedule'].'<br>';
						endif;
					?>
				
				</div>
				
			  </div>
			</div>
		</div>
		
		<!--Perfil del candidato-->
		<div class="col-md-12">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title" >Perfil del candidato</h3>
			  </div>
			  <div class="panel-body" style="text-align: left">
				
				<?php if(!empty($oferta['CompanyCandidateProfile']) AND ($oferta['CompanyCandidateProfile']<>null)): ?>
				<div class="col-md-12">
					<span class="catorce">Nivel academico:</span>
					<br>
					<?php 
						foreach($oferta['CompanyCandidateProfile'] as $nivel):	
							echo $nivel['AcademicLevel']['academic_level'].' - '.$nivel['AcademicSituation']['academic_situation'];
							if($nivel['academic_situation_id']==1):
								echo ' ' . $nivel['semester'] . '° semestre';
							endif;
							echo ':<br>';
							$cont = 0;
							foreach($nivel['CompanyJobRelatedCareer'] as $k => $carrera):
								$cont++;
								echo  $CarrerasAreas[$carrera['career_id']];
								if(count($nivel['CompanyJobRelatedCareer']) <> $cont):
									echo ' / ';
								endif;
							endforeach;	
							echo '<br><br>';
						endforeach;
					?>
				</div>
				<?php endif; ?>
				
				<div class="col-md-12">
				<?php 
				if(!empty($computos)):
					echo '<span class="catorce">Cómputo: </span><br>';
					foreach($computos as $k => $computo):
						echo $Tecnologias[$computo['CompanyJobComputingSkill']['category_id']] . ': ';
						if($computo['CompanyJobComputingSkill']['name']<>''):
							echo $Programas[$computo['CompanyJobComputingSkill']['name']].'-';
							echo $NivelesSoftware[$computo['CompanyJobComputingSkill']['level']];
						else:
							echo $computo['CompanyJobComputingSkill']['other'];
						endif;
						echo '<br>';

					endforeach;
				endif;
				?>
				</div>
				
				<div class="col-md-7">
				<?php 
				if(!empty($idiomas)):
					echo '<span class="catorce">Idiomas: </span><br>';
					foreach($idiomas as $k => $idioma):
						echo $idioma['Lenguage']['lenguage'].': Lectura - '. $niveles[$idioma['CompanyJobLanguage']['reading_level']]
															.' / Escritura - '. $niveles[$idioma['CompanyJobLanguage']['writing_level']]
															.' / Conversación - '. $niveles[$idioma['CompanyJobLanguage']['conversation_level']].   '<br>';
					endforeach;
				endif;
				?>
				</div>
				
				<div class="col-md-5">
					<?php 	
							if($oferta['CompanyJobProfile']['professional_skill']<>''): 
					?>
								<span class="catorce">Conocimientos y habilidades profesionales: </span><br>
					<?php 
								echo $oferta['CompanyJobProfile']['professional_skill'] . '<br>'; 
							endif;
					?>
					
				</div>
				
					<?php 
					$contador = 1;
					if(!empty($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency'])):
					?>
						<div class="col-md-12" style="margin-bottom: 30px;">
					<?php 
							echo '<br><span class="catorce">Competencias: </span><br>';
							foreach($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency'] as $k => $competencia):
					?>
								<div class="col-md-4">
					<?php 
									echo $contador.'.- '.$tiposCompetencias[$competencia['competency_id']].'<br>';
									$contador++;
					?>
								</div>
					<?php
							endforeach;
					?>
						</div>
					<?php
					endif;
					?>
				
				</div>
			  </div>
			</div>

	</div>
		
	</div>	
	
				<?php 
					$addClass = 'col-md-2 col-md-offset-8';
					if($this->Session->check('CompanyJobProfile.id')):
						$addClass = 'col-md-2 col-md-offset-8';
					else:
						$addClass = 'col-md-2 col-md-offset-10';
					endif; 
				?>	
					
		<div class="col-md-12 "  style="margin-bottom: 50px;">
			<div class="<?php echo $addClass; ?>">
				<a class="btn btn-default btnBlue " style="margin-top: 5px; width: 150px;" onclick="goBack();"><i class="glyphicon glyphicon-arrow-left"></i> &nbsp; Regresar</a>
			</div>
			<?php if($this->Session->check('CompanyJobProfile')): ?>
				<?php 
					$var = $this->Session->read('CompanyJobProfile');
					if(!empty($var)): ?>
					<div class="col-md-2">
						<?php
							echo $this->Html->link('Finalizar', 
																array(
																	'controller'=>'Companies',
																	'action'=>'Profile',
																),
																array(
																	'class' => 'btn btn-default btnRed ',
																	'style' => 'margin-top: 5px; width: 145px;',
																)	
								);
						?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		
			<!--Form para cambiar vigencia de la oferta-->
		<div class="modal fade" id="myModalVigencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 600px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Seleccione la fecha de vigencia para la oferta</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 200px;">
									
					
								<?php 
									echo $this->Form->create('Company', array(
																		'class' => 'form-horizontal', 
																		'role' => 'form',
																		'inputDefaults' => array(
																				'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																												'div' => array('class' => 'form-group'),
																												'class' => 'form-control',
																												'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" >',
																												'between' => ' <div class="col-md-11" style="padding-right: 5px;">',
																												'after' => '</div></div>',
																												'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
																		),
																		'onsubmit' =>'return validateVigenciaForm();',
																		'action' => 'updateCompanyJobProfileExpiration',
									)); 
								?>	
						
										<div class="col-md-11 col-md-offset-1" style=" margin-top: 40px;  padding-right: 0px;">	
												<fieldset>
													<?php 	echo $this->Form->input('CompanyJobProfile.id', array('type'=>'hidden')); ?>
													<p style="margin-left: 15px;">Vigencia de la oferta</p>
							
														<?php echo $this->Form->input('CompanyJobProfile.expiration', array(
																						'before' => '<div class="col-xs-12 col-sm-12 col-md-12">',
																						'between' => '<div class="col-md-12 ">',
																						'label' => array(
																									'class' => 'col-md-0 col-md-offset-0 control-label',
																									'text' => '',),
																						'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px;',
																						'div' => array('class' => 'form-inline'),
																						'label' => array(
																							'class' => 'col-sm-0 col-md-0 control-label',
																							'text' => '',),
																						'dateFormat' => 'YMD',
																						'separator' => '',
																						'minYear' => date('Y') - -2,
																						'maxYear' => date('Y') - 0,
																						'placeholder' => 'Vigencia que aparecerá en la oferta',
																						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
														)); ?>
														<div style="display: none;">
														<?php echo $this->Form->input('CompanyJobProfile.created', array(
																						// 'type' => 'hidden',
																						'before' => '<div class="col-xs-12 col-sm-12 col-md-12">',
																						'between' => '<div class="col-md-12 ">',
																						'label' => array(
																									'class' => 'col-md-0 col-md-offset-0 control-label',
																									'text' => '',),
																						'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px;',
																						'div' => array('class' => 'form-inline'),
																						'label' => array(
																							'class' => 'col-sm-0 col-md-0 control-label',
																							'text' => '',),
																						'dateFormat' => 'YMD',
																						'separator' => '',
																						'minYear' => date('Y') - -15,
																						'maxYear' => date('Y') - 0,
																						'placeholder' => 'Vigencia que aparecerá en la oferta',
																						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
														)); ?>
														</div>
														<div class="col-md-12" style="top: -45px;">
															<span style="color:red; position: absolute; margin-top: 9px; left: 5px;">*</span>
														</div>
										</div>
				
				

								</div>
								<div class="modal-footer">
									<?php 	echo $this->Form->button('Enviar',array(
																			'type' => 'submit', 
																			'div' => 'form-group',
																			'escape' => false,
																			'class' => 'btn btnRed btn-default col-md-3 col-md-offset-8'
																));
											echo $this->Form->end(); 
									?>
								</div>
							</div>
						</div>
					</div>