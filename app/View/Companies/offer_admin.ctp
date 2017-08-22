<?php 
	$this->layout = 'company'; 
?>

	<script>
		$(document).ready(function() {
			var helpText = [
							"Guarda y nombra las consultas de ofertas en carpetas para una mejor organización. Las carpetas creadas se ordenarán alfabéticamente.",					
							];
			 
			$('.form-group').each(function(index, element) {
				$(this).find(".cambia").attr("id", index);
				$(this).find('#'+index).attr("data-original-title", helpText[index]);
			});
			
			 $('#CompanyJobProfileExpirationYear').prepend('<option value="" selected>AAAA</option>');
			 $('#CompanyJobProfileExpirationMonth').prepend('<option value="" selected>MM</option>');
			 $('#CompanyJobProfileExpirationDay').prepend('<option value="" selected>DD</option>');
			 
			typeSearch();
		});	
		
		function validateEmpty(){
			selectedIndex = document.getElementById("CompanyCriterio").selectedIndex;
			var palabraBuscar = document.getElementById('CompanyBuscar').value ;
			var sueldo = document.getElementById("CompanyBuscarSalary").selectedIndex;

			if(selectedIndex == 0){
				jAlert('Seleccione el criterio de búsqueda', 'Mensaje');
				document.getElementById('CompanyCriterio').focus();
				return false;
			}else 
			if((palabraBuscar == '') && (sueldo == '')){
				
				if(selectedIndex == 1){
					jAlert('Ingrese el puesto', 'Mensaje');
					document.getElementById('CompanyBuscar').focus();
				} else
				if(selectedIndex == 2){
					jAlert('Seleccione el rango de sueldo', 'Mensaje');
					document.getElementById('CompanyBuscarSalary').focus();
				}else{
						jAlert('Ingrese el folio', 'Mensaje');
						document.getElementById('CompanyBuscar').focus();
				}
				
				return false;
			}else {
				return true;
			}
		}
		
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
				if(responseValidateDate == false){
					jAlert('La fecha de vigencia es incorrecta', 'Mensaje');
					document.getElementById('CompanyJobProfileExpirationDay').focus();
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
				}else{
					return true;
				}
		}
			
		function typeSearch(){
			selectedIndexTypeSearch = document.getElementById("CompanyCriterio").selectedIndex;

			if(selectedIndexTypeSearch==2){
				$("#idDivBuscar").hide();
				$("#idDivBuscarSelect").show();
				$('#CompanyBuscar').val('');
				
			} else {
				$("#idDivBuscar").show();
				$("#idDivBuscarSelect").hide();
				
				document.getElementById('CompanyBuscarSalary').options[0].selected = 'selected';
			}
			
			if(selectedIndexTypeSearch==1){
				$("#CompanyBuscar").attr("placeholder", "Ingrese el puesto");
			}
			else
				if(selectedIndexTypeSearch==3){
						$("#CompanyBuscar").attr("placeholder", "Ingrese el folio");
				}
			
		}
		
		function sendLimit(){
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById('CompanyLimite').value = document.getElementById('limit').value;
				document.getElementById("CompanyOfferAdminForm").submit();
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
	
	
	<div class="col-md-12">
		<?php 
			echo $this->Session->flash();
			$paginator = $this->Paginator;
		?>
		
		<div class="col-md-12" style="left: -28px;">

			<div class="col-md-12" style="left: -13px;">
				<div class="col-md-12" >
					<p>Buscar ofertas:</p>
				</div>
				
				<div class="col-md-9"  style="padding-left: 0px;">
				<?php 
					echo $this->Form->create('Company', array(
									'class' => 'form-horizontal', 
									'role' => 'form',
									'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'before' => '<div class="col-md-12"><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => ' <div class="col-md-12">',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
									),
									'action' => 'offerAdmin',
									'onsubmit' =>'return validateEmpty();'
					)); ?>
					
					<fieldset>
					<div class="col-md-7" style="padding-right: 0px;" id="idDivBuscar">
					<?php echo $this->Form->input('Buscar', array(
															'before' => '<div class="col-md-12" style="padding-left: 0px;">',
															'label' =>'',
															'value'	=> $this->Session->read('palabraBuscada'), 
															'placeholder' => 'Puesto / Sueldo / Folio ',
															
					));	?>
					</div>
					<div class="col-md-7" style="padding-right: 0px;" id="idDivBuscarSelect">
					<?php echo $this->Form->input('buscarSalary', array(
															'before' => '<div class="col-md-12" style="padding-left: 0px;">',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'type' => 'select',
															'value'	=> $this->Session->read('palabraBuscada'), 
															// 'selected' => $this->Session->read('palabraBuscada'),
															'label' =>'',
															'options' => $Salarios, 'default'=>'0', 'empty' => 'Sueldo (Neto)'
															
					));	?>
					</div>
					<div  class="col-md-4" style="padding-left: 0px; padding-right: 0px;">
					<?php 	$options = array('1' => 'Puesto', '2' => 'Sueldo', '3' => 'Folio');
							echo $this->Form->input('criterio', array(
													'type'=>'select',
													'value' => $this->Session->read('tipoBusqueda'),
													'before' => '<div class="col-md-12" style="padding-left: 0px;">',
													'class' => 'selectpicker show-tick form-control show-menu-arrow',
													'label' =>'',
													'onchange' => 'typeSearch()',	
													'options' => $options,'default'=>'0', 'empty' => 'Criterio de búsqueda'
							)); ?>
					</div>
					<?php echo $this->Form->input('limite', array('type'=>'hidden')); ?>
					<div class="col-md-1" style="padding-left: 0px; padding-right: 0px;">
					
					<?php 
					echo $this->Form->button(
											'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
											array(
												'type' => 'submit',
												'div' => 'form-group',
												'class' => 'btn btnBlue btn-default',
												'style' => 'width: 130px;',
												'escape' => false,
											)
					);
					echo $this->Form->end(); 
					?>
					<img data-toggle="tooltip" id="" data-placement="top" 
title="El sistema realiza búsquedas escribiendo alguna(s) palabra(s) clave(s) en el campo abierto. 
Ejemplos: 
Analista en Mercadotecnia
MySQL" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: -120%; margin-left: 240%;">
			  		</div>
					</fieldset>
				</div>
			
			</div>
			
			<div class="col-xs-10" >
				<p>Filtrar todas las ofertas por: </p>
					<?php
						if($this->Session->read('tipoBusqueda')==4):
							$seleccionado10 = 'background-color: #e6e6e6; color: #333;';
							$seleccionado20 ='';
							$seleccionado30 = '';
							$seleccionado40 = '';
						else:
							if($this->Session->read('tipoBusqueda')==5):
								$seleccionado10 = '';
								$seleccionado20 = 'background-color: #e6e6e6; color: #333;';
								$seleccionado30 = '';
								$seleccionado40 = '';
							else:
								if($this->Session->read('tipoBusqueda')==6):
									$seleccionado10 = '';
									$seleccionado20 = '';
									$seleccionado30 = 'background-color: #e6e6e6; color: #333;';
									$seleccionado40 = '';
								else:
									if($this->Session->read('tipoBusqueda')==7):
										$seleccionado10 = '';
										$seleccionado20 = '';
										$seleccionado30 = '';
										$seleccionado40 = 'background-color: #e6e6e6; color: #333;';
									else:
										$seleccionado10 = '';
										$seleccionado20 = '';
										$seleccionado30 = '';
										$seleccionado40 = '';
									endif;
								endif;
							endif;
						endif;
					?>	
					<div class="btn-group" style="margin-left: 0px;">
					<?php 
							echo $this->Html->link(
													'Activas', 
														array(
															'controller'=>'Companies',
															'action'=>'offerAdmin',
															'?' => array(
																	  'tipoBusqueda' => 4,
															),
														),
														array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'margin-top: 5px; width: 150px;'. $seleccionado10 ,
															)	
						); 	?> 
					</div>
					<div class="btn-group" style="margin-left: 20px;">
						<?php 
							echo $this->Html->link(
													'Por expirar', 
														array(
															'controller'=>'Companies',
															'action'=>'offerAdmin',
															'?' => array(
																	  'tipoBusqueda' => 5,
															),
														),
														array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'margin-top: 5px; width: 170px;'. $seleccionado20 ,
															)	
						); 	?> 
					</div>

					<div class="btn-group" style="margin-left: 20px;">
						<?php 
							echo $this->Html->link(
													'Expiradas', 
														array(
															'controller'=>'Companies',
															'action'=>'offerAdmin',
															'?' => array(
																	  'tipoBusqueda' => 6,
															),
														),
														array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'margin-top: 5px; width: 170px;'. $seleccionado30 ,
															)	
						); 	?> 
					</div>
					<div class="btn-group" style="margin-left: 20px;">
					<?php 
							echo $this->Html->link(
													'Inactivas', 
														array(
															'controller'=>'Companies',
															'action'=>'offerAdmin',
															'?' => array(
																	  'tipoBusqueda' => 7,
															),
														),
														array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'margin-top: 5px; width: 150px;'. $seleccionado40 ,
															)	
						); 	?> 
					</div>
					
			</div>

			<div class="col-md-9" style="margin-top: 10px;">
				<p>Resultados de búsqueda</p>
			</div>
			
			<div class="col-xs-9">
				<?php 	$options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200);
						echo $this->Form->input('limit', array(
															'onchange' => 'sendLimit()',
															'type'=>'select',
															'style' => 'width: 200px;margin-left: 30px;',
															'before' => '<div class="col-md-12 " style="margin-left: 170px;"',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'data-width'=> '180px',
															'selected' => $this->Session->read('limite'),
															'label' =>'',
															'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja'
					)); ?>	
					<div class="btn-group" style="top:-32px;">
					 <?php 	echo $this->Html->link(
													'Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
															array(
																	'controller'=>'Companies',
																	'action'=>'offerAdminExcel',
																),
																array(
																	'class' => 'btn btn-default btnBlue ',
																	'style' => 'width: 180px; font-size: 14px; height: 32px;',
																	'escape' => false,
																	)	
												); 
						?>
					</div>
			</div>

			<?php if(isset($ofertas)): 
					if(empty($ofertas)):
						echo '<div class="col-md-12" style="margin-top: 15px;"> <p style="font-size: 22px;margin-left: -20px;">Sin ofertas</p></div>';
					else:
			?>
		</div>
	
	</div>
		
		<div class="col-md-10" style="max-height: 650px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0p;margin-left:-32px;">
					
					<?php 
						foreach($ofertas as $k => $oferta):
					?>
						<div class="col-md-11" style="background: #fff none repeat scroll 0 0; min-height: 115px; margin-top: 15px; padding-left: 0px; padding-right: 0px; margin-left: 25px; right: -25px;">    
						
							<div class="col-md-2" style="text-align: center; margin-top: 5px; padding-left: 0px; padding-right: 0px;">
								<?php
										if($oferta['CompanyJobOffer']['confidential_job_offer'] == 's'):
											echo $this->Html->image('company/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '95px',
																		'height' => '80px',
																	));
										else:
											if (isset($oferta)):
												if(isset($oferta['Company']['filename'])):
												$url = WWW_ROOT.'img/uploads/company/filename/'.$oferta['Company']['filename'];
													if(!file_exists( $url )):
														echo $this->Html->image('company/imagenNoEncontrada.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '95px',
																		'height' => '80px',
																	));
													else:
														if($oferta['Company']['filename'] <> ''):
															echo $this->Html->image('uploads/company/filename/'.$oferta['Company']['filename'],
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '95px',
																			'height' => '80px',
																		));
														else:
															echo $this->Html->image('company/imagenNoDisponible.png',
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '95px',
																			'height' => '80px',
																		));
														endif;
													endif;
												else:
													echo $this->Html->image('company/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '95px',
																		'height' => '80px',	
																	));
												endif;
											else:
												echo $this->Html->image('company/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '95px',
																		'height' => '80px',
																	));
											endif;
										endif;
									?>
									
								<p class="blackText" style="margin-top: 5px;">
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
														echo 'Sin especificar';
													endif;
												endif;
											endif;
										endif;
									?>
								</p>
							</div>
						
							<div class="col-xs-6" style="margin-top: 10px; text-align: left;">
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
								<p class="blackText">folio:<?php echo $folio; ?></p>
								<p class="blackText">Fecha publicación: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyJobContractType']['created'])); ?> </span></p>
								<p class="blackText">Puesto: 
									<span style="font-weight: normal;">
										<?php  
											$texto = str_ireplace ( $this->Session->read('palabraBuscada'), '<strong style="font-size: 14px;">'.$this->Session->read('palabraBuscada').'</strong>', $oferta['CompanyJobProfile']['job_name']); 
											echo $texto;
										?> 
									</span>
								</p>
								<p class="blackText">Sueldo: 
									<span style="font-weight: normal;">
										<?php  
											if(isset($oferta['CompanyJobContractType']['Salary']['salary'])):
												echo ' ' . $oferta['CompanyJobContractType']['Salary']['salary'];
											else:
												echo 'Sin especificar';
											endif;
										?>
									</span>
								</p>
								<p class="blackText">Lugar de trabajo: <span style="font-weight: normal;"><?php  echo ' ' . $oferta['CompanyJobContractType']['state'] . ' ' . $oferta['CompanyJobContractType']['subdivision'] ; ?> </span></p>
								<!--p class="blackText">Nivel académico: <span style="font-weight: normal;">
									<?php 
										foreach($oferta['CompanyCandidateProfile'] as $nivel):	
											echo $nivel['AcademicLevel']['academic_level'].' ';
										endforeach;
									?>
								</p-->
							</div>
						
						<div class="col-md-4" style="background: rgb(88, 89, 91) none repeat scroll 0% 0%; float: right; height: 30px; padding-left: 4px; padding-right: 0px;">

							<div style="margin-top: 3px" class="grises2">
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
								//Descargar oferta pdf
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
									// Descativar oferta
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
							
							<div class="col-xs-4" style="margin-top: 10px; text-align: left; padding-right: 0px;">

								<!--p class="blackText">Situación Académica: 
									<span style="font-weight: normal;">
										<?php 
											foreach($oferta['CompanyCandidateProfile'] as $situacion):	
												echo $situacion['AcademicSituation']['academic_situation'].' ';
											endforeach;
										?>
										<?php
											// if(($oferta['CompanyCandidateProfile']['academic_situation']<>'') and ($oferta['CompanyCandidateProfile']['academic_situation']<>null)):
												// echo $oferta['CompanyCandidateProfile']['AcademicSituation']['academic_situation']; 
											// else:
												// echo 'Sin especificar';
											// endif;
										?> 
									</span>
								</p-->
								<?php 
									$listaIidomas = '';
									foreach($oferta['CompanyJobLanguage'] as $k => $idoma):
										$listaIidomas .=  $idoma['Lenguage']['lenguage'] . ', ';
									endforeach;
									if($listaIidomas==''):
										$listaIidomas='No requerido';
										
									endif;
								 ?>
								
								<p class="blackText">Idioma: <span style="font-weight: normal;"><?php  echo $listaIidomas; ?> </span></p>
							
								<?php echo $this->Html->link(
														' Ver oferta completa ', 
														array(
															'controller'=>'Companies',
															'action'=>'viewOfferOnline', $oferta['CompanyJobProfile']['id']),
														array(
															'class' => 'btn btnRed col-md-10',
															'style' => 'margin-top: 5px;margin-left: 30px;',
															'escape' => false)	
								); 	?>
							
							</div>
						
						</div>
					<?php endforeach; ?>
				
			<?php 
				endif;
				endif; 
			?>	
		</div>
		
		<div class="col-md-12" style="margin-left:2px;">
			<?php 
			if(!empty($ofertas)):
			?>
			<p>
			<?php echo $this->Paginator->counter(
			array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')
			); ?>
			</p>
			
			<div class="pagin" style="">
			<?php echo $this->Paginator->first('<< primero');?>
			<?php echo $this->Paginator->prev('< anterior', array(), null, array('class' => 'prev disabled')); ?>
			<?php echo $this->Paginator->numbers(array('separator'=>'')); ?>
			<?php echo $this->Paginator->next('siguiente >', array(), null, array('class' => 'next disabled'));?>
			<?php echo $this->Paginator->last('último >>');?>
			</div>	
			
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
																						'minYear' => date('Y') - -1,
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
					
					