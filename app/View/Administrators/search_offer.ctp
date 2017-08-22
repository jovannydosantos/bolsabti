<?php 
	$this->layout = 'administrator'; 
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
										document.getElementById('CompanyJobProfileExpirationYear').value	;
				
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
					jAlert('La fecha de vigencia no debe ser menor a la actual', 'Mensaje');
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
				}else {
					return true;
				}
		}
			
		function typeSearch(){
			selectedIndexTypeSearch = document.getElementById("CompanyCriterio").selectedIndex;

			// if(selectedIndexTypeSearch==2){
				// $("#idDivBuscar").hide();
				// $("#idDivBuscarSelect").show();
				// $('#CompanyBuscar').val('');
				
			// } else {
				// $("#idDivBuscar").show();
				// $("#idDivBuscarSelect").hide();
				
				// document.getElementById('CompanyBuscarSalary').options[0].selected = 'selected';
			// }
			
			if(selectedIndexTypeSearch==1){
				$("#CompanyBuscar").attr("placeholder", "Ingrese el RFC");
			}else
			if(selectedIndexTypeSearch==2){
				$("#CompanyBuscar").attr("placeholder", "Ingrese el nombre de empresa o institución");
			}else
			if(selectedIndexTypeSearch==3){
				$("#CompanyBuscar").attr("placeholder", "Ingrese el puesto");
			}else
			if(selectedIndexTypeSearch==4){
				$("#CompanyBuscar").attr("placeholder", "Ingrese el nombre de contacto");
			}else
			if(selectedIndexTypeSearch==5){
				$("#CompanyBuscar").attr("placeholder", "Ingrese el correo electrónico del responsable de la oferta");
			}
			
		}
		
		function sendLimit(){
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById('CompanyLimite').value = document.getElementById('limit').value;
				$( "#idBucar" ).click();
			 }
		}
		
		function sendPaginado(){
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById("sendPaginadoForm").submit();
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
		
		function SinCandidatos(){
			jAlert('Sin candidatos a mostrar', 'Mensaje');
			return false;
		}
	</script>
	
	
	<div class="col-md-12">
		<?php 
			echo $this->Session->flash();
			$paginator = $this->Paginator;
		?>
		
		<div class="col-md-12" >
			<div class="col-md-12" style="left: -35px;">
				<div class="col-md-12" >
					<p>Buscar ofertas:</p>
				</div>
				
				<div class="col-md-9"  style="padding-left: 0px;">
				<?php 
					echo $this->Form->create('Administrator', array(
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
									'action' => 'searchOffer',
									'onsubmit' =>'return validateEmpty();'
					)); ?>
					
					<fieldset>
					<div class="col-md-7" style="padding-right: 0px;" id="idDivBuscar">
					<?php echo $this->Form->input('Company.Buscar', array(
															'before' => '<div class="col-md-12" style="padding-left: 0px;">',
															'label' =>'',
															'value'	=> $this->Session->read('palabraBuscada'), 
															'placeholder' => 'Palabra a buscar...',
															
					));	?>
					</div>
					<div class="col-md-7" style="padding-right: 0px; display: none;" id="idDivBuscarSelect">
					<?php echo $this->Form->input('Company.buscarSalary', array(
															'before' => '<div class="col-md-12" style="padding-left: 0px;">',
															'type' => 'select',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'value'	=> $this->Session->read('palabraBuscada'), 
															'label' =>'',
															'options' => $Salarios, 'default'=>'0', 'empty' => 'Sueldo (Neto)'
															
					));	?>
					</div>
					<div  class="col-md-4" style="padding-left: 0px; padding-right: 0px;">
					<?php 	$options = array('8' => 'RFC','9' => 'Nombre de empresa o institución','10' => 'Puesto', '11' => 'Nombre contacto', '12' => 'Correo electrónico del Responsable de la Oferta');
							echo $this->Form->input('Company.criterio', array(
													'type'=>'select',
													'class' => 'selectpicker show-tick form-control show-menu-arrow',
													// 'data-width' => 'fit',
													'value' => $this->Session->read('tipoBusqueda'),
													'before' => '<div class="col-md-12" style="padding-left: 0px;">',
													'label' =>'',
													'onchange' => 'typeSearch()',	
													'options' => $options,'default'=>'0', 'empty' => 'Criterio de búsqueda'
							)); ?>
					</div>
					<?php 
					// echo $this->Form->input('Company.limite', array('type'=>'hidden')); 
					?>
					<div class="col-md-1" style="padding-left: 0px; padding-right: 0px;">
						<?php 
						echo $this->Form->button(
												'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
												array(
													'type' => 'submit',
													'div' => 'form-group',
													'id' => 'idBucar',
													'class' => 'btn btnBlue btn-default',
													'style' => 'width: 130px;',
													'escape' => false,
												)
						);
						echo $this->Form->end(); 
					?>
					<img data-toggle="tooltip" id="" data-placement="top" 
title="El sistema buscará por el siguiente criterio: RFC, Nombre de empresa o institución, Puesto
Nombre contacto, Correo electrónico del Responsable de la Oferta" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: -105%; margin-left: 240%;">
			  		</div>
					</fieldset>
				</div>
			</div>
			
			<div class="col-xs-10" style="left: -20px;">
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
															'controller'=>'Administrators',
															'action'=>'searchOffer',
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
															'controller'=>'Administrators',
															'action'=>'searchOffer',
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
															'controller'=>'Administrators',
															'action'=>'searchOffer',
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
															'controller'=>'Administrators',
															'action'=>'searchOffer',
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
		</div>
	</div>
	
		<?php if(isset($ofertas)): 
				if(empty($ofertas)):
						echo '<div class="col-md-12" style="margin-top: 15px;"> <p style="font-size: 22px;">Sin ofertas</p></div>';
				else:	
		?>
		
		<div class="col-md-12" style="margin-top: 15px; margin-left: 8px;">
				<p>Resultados de búsqueda</p>
		</div>
		
		<div class="col-md-10">
			<div class="col-md-3">
					 <?php 	echo $this->Html->link(
													'Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
															array(
																	'controller'=>'Administrators',
																	'action'=>'searchOfferAdminExcel',

																),
																array(
																	'class' => 'btn btn-default btnBlue ',
																	'style' => 'width: 180px; font-size: 14px; height: 32px;',
																	'escape' => false,
																	)	
												); 
						?>
			</div>
					
			<div class="col-md-3" style="padding-left: 10px;">
						<?php 
								if($this->Session->read('orden') == '1'):
									$selectedOrden1 = 'active'; 
									$selectedOrden2 = ''; 
								else:
									if($this->Session->read('orden') == '2'):
										$selectedOrden1 = ''; 
										$selectedOrden2 = 'active';
									else:
										$selectedOrden1 = ''; 
										$selectedOrden2= ''; 
									endif;
								endif;
						?>
					
						<div class="btn-group">
						  <button type="button" style="width: 180px; font-size: 14px; height: 32px;" class="btn btnBlue btn-default dropdown-toggle" data-toggle="dropdown">Ordenar por &nbsp;<i class="glyphicon glyphicon-chevron-down" style="top: 4px;"></i><span class="caret"></span></button>
						  <ul class="dropdown-menu" role="menu">
							<li>
							<?php 
								echo $this->Html->link('Fecha de publicación por la empresa', 
															array(
																'controller'=>'Administrators',
																'action'=>'searchOffer',
																'?' => array(
																		  'orden' => '1',
																),
															),
															array(
																'class' => 'btn btn-default '.$selectedOrden1,
																'style' => 'margin-top: 5px;',
																'escape' => false)	
							); 	?>
							</li>
							<li>
							<?php echo $this->Html->link('Fecha de actualización por la empresa', 
															array(
																'controller'=>'Administrators',
																'action'=>'searchOffer',
																'?' => array(
																		  'orden' => '2',
																),
															),
															array(
																'class' => 'btn btn-default ' . $selectedOrden2,
																'style' => 'margin-top: 5px;',
																'escape' => false)	
							); 	?>
							</li>
						  </ul>
						</div>
			</div>
			
			<div class="col-md-2" style="padding-left: 0px;  margin-left: -5px;">
						<?php 	
							echo $this->Form->create('Administrator', array(
									'class' => 'form-horizontal', 
									'id' => 'sendPaginadoForm',
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
									'action' => 'searchOffer',
							)); 
						
						
						$options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200);
							echo $this->Form->input('Company.limite', array(
																'onchange' => 'sendPaginado()',
																'id'=> 'limit',
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width' => '180px',
																'before' => '<div class="col-md-12" style="padding-left: 0px;"> ',
																'selected' => $this->Session->read('limiteAdmin'),
																'label' =>'',
																'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja'
						)); 
						
						echo $this->Form->end(); 
						
						?>	
			</div>
		</div>
			
			
			
			
		<div class="col-md-10" style="max-height: 980px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0p;margin-left:-24px;">
					
					<?php 
						foreach($ofertas as $k => $oferta):
					?>
						<div class="col-md-11" style="background: #fff none repeat scroll 0 0; min-height: 177px; margin-top: 15px; padding-left: 0px; padding-right: 0px; margin-left: 25px; right: -25px;">    
						
							<div class="col-md-2" style="text-align: center; margin-top: 25px; padding-left: 0px; padding-right: 0px;">
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
									
								<p class="blackText" style="margin-top: 10px; font-size: 12px; color: #000">
									<?php 
										echo '<span>';
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
										echo '</span><br>';
									?>
								</p>
								<p class="blackText" style="font-size: 12px; color: #000">
									<?php echo '<span>'.$oferta['Company']['CompanyProfile']['rfc'].'</span>'; ?>
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
								<p class="blackText">Puesto: 
									<span style="font-weight: normal;">
										<?php  
											$texto = str_ireplace ( $this->Session->read('palabraBuscada'), '<strong style="font-size: 14px;">'.$this->Session->read('palabraBuscada').'</strong>', $oferta['CompanyJobProfile']['job_name']); 
											echo $texto;
										?> 
									</span>
								</p>
								<p class="blackText">Número de vacantes: <span style="font-weight: normal;"><?php echo $oferta['CompanyJobProfile']['vacancy_number']; ?></span></p>
								<?php
									if(!empty($oferta['CompanyLastUpdate']['Administrator'])):
										$administrador = ' / '.$oferta['CompanyLastUpdate']['Administrator']['AdministratorProfile']['contact_name'].' '.$oferta['CompanyLastUpdate']['Administrator']['AdministratorProfile']['contact_last_name'];
									else:
										$administrador = '';
									endif;
								?>
								<p class="blackText">Fecha publicación: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyJobProfile']['created']));   ?> </span></p>
								<p class="blackText">Fecha de actualización: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyLastUpdate']['modified']));  echo $administrador; ?> </span></p>
								<p class="blackText">Vigencia: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyJobProfile']['expiration'])); ?> </span></p>
								<p class="blackText">Responsable de la oferta:</p>
								
								 <?php 
									if($oferta['CompanyJobOffer']['same_contact']=='n'):
										echo '<p class="blackText"> -Nombre:<span style="font-weight: normal;">' . $oferta['CompanyJobOffer']['responsible_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_last_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_second_last_name'].'</span></p>';
										
										echo '<p class="blackText"> -Tel.:<span style="font-weight: normal;"> (' . $oferta['CompanyJobOffer']['responsible_long_distance_cod'] .') '. $oferta['CompanyJobOffer']['responsible_telephone'] . ' ';
										if($oferta['CompanyJobOffer']['responsible_phone_extension']<>''):
											echo ' - ext. '.$oferta['CompanyJobOffer']['responsible_phone_extension'];
										endif;
										echo '</span></p>';
										if($oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']<>''):
											echo '<p class="blackText"> -Cel.: <span style="font-weight: normal;">('.$oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']. ') ' .$oferta['CompanyJobOffer']['responsible_cell_phone'].'</span></p>';
										endif;	
									else:
										echo '<p class="blackText"> -Nombre:<span style="font-weight: normal;">' . $oferta['Company']['CompanyContact']['name']. ' ' .  $oferta['Company']['CompanyContact']['last_name']. ' ' .  $oferta['Company']['CompanyContact']['second_last_name'].'</span></p>';
										
										echo '<p class="blackText"> -Tel.:<span style="font-weight: normal;"> (' . $oferta['Company']['CompanyContact']['long_distance_cod'] .') '. $oferta['Company']['CompanyContact']['telephone_number'];
										if($oferta['Company']['CompanyContact']['phone_extension']<>''):
											echo '- ext. </span> '.$oferta['Company']['CompanyContact']['phone_extension'];
										endif;
										echo '</span></p>';
										if(($oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']<>'') and ($oferta['Company']['CompanyContact']['cell_phone']<>'')):
											echo '<p class="blackText"> -Cel.: ('.$oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']. ') ' .$oferta['Company']['CompanyContact']['cell_phone'].'</span></p>';
										endif;
									endif;
									?>		
								</span></p>
							</div>
						
							<div class="col-xs-4" style="background: #58595B; float: right; height: 30px; padding-left: 5px;  padding-right: 0px;">

							<div style="margin-top: 3px" class="grises2">
								<?php 
									$var = 0;
									$vista = 0;
									foreach($oferta['Company']['CompanyViewedOffer'] as $k => $viewed):
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
																'?'=> array(
																			'company_id' => $oferta['Company']['id'],
																			'editingAdmin' => 'yes',
																			'id' => $oferta['CompanyJobProfile']['id'],
																			'editar' => 1,
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
																'?'=> array(
																			'company_id' => $oferta['Company']['id'],
																			'editingAdmin' => 'yes',
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
																			'company_id' => $oferta['Company']['id'],
																			'id' => $oferta['CompanyJobProfile']['id'],
																			'editingAdmin' => 'yes',
																			// 'nuevaBusqueda' => 'nuevaBusqueda',
																			)
																),
												)
										);
								?>
								
								<?php 
									echo $this->Html->link(
														$this->Html->image('student/descargado.png', array('escape' => false,'style' => 'width: 17px; height: 20px; margin-right: 6px; cursor: pointer; ')),
														array(
															'controller' => 'Companies', 
															'action' => 'viewOnlyOfferPdf',
															'?' => array(
																			'editingAdmin' => 'yes',
																			'id' => $oferta['CompanyJobProfile']['id'],
																		)
															), 
														array('target' => '_blank','escape' => false,'title' => 'Descargar oferta en PDF',)
											);
								?>

								<?php 
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
						
						
							<div class="col-md-4" style="margin-top: 10px; text-align: left; padding-right: 35px;" >
								<?php 
								$totalTelefonicasOferta = 0;
								foreach($oferta['StudentNotification'] as $k => $telefonicasOferta):
									if($telefonicasOferta['interview_type'] == 1):
										$totalTelefonicasOferta++;
									endif;
								endforeach;
								?>
								
								<?php 
								if($totalTelefonicasOferta >0):
									echo $this->Html->link(
															'Entrevistas telefónicas: '.$totalTelefonicasOferta, 
															array(
																'controller'=>'Administrators',
																'action'=>'searchStudentOffer',
																						'?' => array(
																								'companyJobProfileId' => $oferta['CompanyJobProfile']['id'],
																								'option' => 1,
																								'totalStudents' => $totalTelefonicasOferta,
																								'newSearch' => 'nuevaBusqueda',
																								'historyCompanyId' => $oferta['Company']['id'],
																								'volver' => 'searchOffer',
																								
																						)
																),
															array(
																'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																'escape' => false)	
									); 	
								else: 
									echo $this->Html->link('Entrevistas telefónicas: '.$totalTelefonicasOferta, 
																			'',
																			array(
																				'onclick' => 'return SinCandidatos();',
																				'id' => 'filtroBotonId1',
																				'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																				)	
									); 	
								endif;
								?> 
								
								
								<?php 
								$totalPresencialesOferta = 0;
								foreach($oferta['StudentNotification'] as $k => $presencialesOferta):
									if($presencialesOferta['interview_type'] == 2):
										$totalPresencialesOferta++;
									endif;
								endforeach;
								?>
								
								<?php
								if($totalPresencialesOferta > 0):
									echo $this->Html->link(
															'Entrevistas presenciales: '.$totalPresencialesOferta, 
															array(
																'controller'=>'Administrators',
																'action'=>'searchStudentOffer',
																						'?' => array(
																								'companyJobProfileId' => $oferta['CompanyJobProfile']['id'],
																								'option' => 2,
																								'totalStudents' => $totalPresencialesOferta,
																								'newSearch' => 'nuevaBusqueda',
																								'historyCompanyId' => $oferta['Company']['id'],
																								'volver' => 'searchOffer',
																						)
																),
															array(
																'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																'escape' => false)	
									); 	
								else: 
									echo $this->Html->link('Entrevistas presenciales: '.$totalPresencialesOferta, 
																			'',
																			array(
																				'onclick' => 'return SinCandidatos();',
																				'id' => 'filtroBotonId1',
																				'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																				)	
									); 	
								endif;
								?> 
								
								<?php
									$totalContratados = 0;
									foreach($oferta['Report'] as $k => $contratadosOferta):
										if($contratadosOferta['registered_by']=='company'):
											$totalContratados++;
										endif;
									endforeach;
								?>
				
								<?php 
								if($totalContratados > 0):
									echo $this->Html->link(
															'Contrataciones: '.$totalContratados, 
															array(
																'controller'=>'Administrators',
																'action'=>'searchStudentOffer',
																						'?' => array(
																								'companyJobProfileId' => $oferta['CompanyJobProfile']['id'],
																								'option' => 3,
																								'totalStudents' => $totalContratados,
																								'newSearch' => 'nuevaBusqueda',
																								'historyCompanyId' => $oferta['Company']['id'],
																								'volver' => 'searchOffer',
																						)),
															array(
																'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																'escape' => false)	
									); 	
								else: 
									echo $this->Html->link('Contrataciones: '.$totalContratados, 
																			'',
																			array(
																				'onclick' => 'return SinCandidatos();',
																				'id' => 'filtroBotonId1',
																				'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																				)	
									); 	
								endif;
								?> 
								
								<?php 
								if(count($oferta['Application']) > 0):
									echo $this->Html->link(
															'Postulaciones: '.count($oferta['Application']), 
															array(
																'controller'=>'Administrators',
																'action'=>'searchStudentOffer',
																						'?' => array(
																								'companyJobProfileId' => $oferta['CompanyJobProfile']['id'],
																								'option' => 4,
																								'totalStudents' => count($oferta['Application']),
																								'newSearch' => 'nuevaBusqueda',
																								'volver' => 'searchOffer',
																								'historyCompanyId' => $oferta['Company']['id'],
																						)),
															array(
																'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																'escape' => false)	
														); 	
								else: 
									echo $this->Html->link('Postulaciones: '.count($oferta['Application']), 
																			'',
																			array(
																				'onclick' => 'return SinCandidatos();',
																				'id' => 'filtroBotonId1',
																				'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																				)	
									); 	
								endif;
								?> 
								
								<?php echo $this->Html->link(
														' Ver oferta completa ', 
														array(
															'controller'=>'Companies',
															'action'=>'viewOfferOnline', 
																'?'=> array(
																			'company_id' => $oferta['Company']['id'],
																			'editingAdmin' => 'yes',
																			'id' => $oferta['CompanyJobProfile']['id']
																			)
															),
														array(
															'class' => 'btn btnRed col-md-10',
															'style' => 'margin-top: 10px;',
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
		
		<div class="col-md-12" style="margin-left: 10px;">
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
									echo $this->Form->create('Administrator', array(
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
						
										<div class="col-md-11 col-md-offset-1" style=" margin-top: 30px;  padding-right: 0px;">	
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
																						'minYear' => date('Y') - -15,
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
				</div>
	
		<!--Form para envio de correo -->
		<div class="modal fade" id="myModalMail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 650px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Envio de correo electrónico </h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 440px;">
									<?php
										echo $this->Form->create('Administrator', array(
														'type' => 'file',
														'class' => 'form-horizontal', 
														'role' => 'form',
														'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'label' => array('class' => 'col-xs-4 col-sm-4 col-md-2 col-md-4 control-label '),
															'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => '<div class="col-xs-11 col-sm-10 col-md-10 " >',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
														),
														'action' => 'sendEmailStudent'
									)); ?>
										<style type="text/css">
											.upload {
												width: 154px;
												height: 35px;
												background: url("<?php echo $this->webroot; ?>/img/adjuntarboton.png");
												overflow: hidden;
												background-repeat-x: no-repeat;
												background-repeat:no-repeat;
												margin-left: 35px;
												margin-top: -28px;
											}
										</style>

										<fieldset style="margin-top: 30px;">
											
											<?php echo $this->Form->input('Student.emailTo', array(
																					'readonly' => 'readonly',
																					'before' => '<div class="col-md-9 ">',	
																					'between' => '<div class="col-xs-11 col-sm-10 col-md-10 " style="padding-left: 5px; padding-right: 5px;">',
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'style' => 'left: 6px;',
																									'text' => '',
																								),
																					'placeholder' => 'Correo',
											)); ?>
											<?php echo $this->Form->input('Student.CC', array(	
																					'type' => 'hidden',
																					'before' => '<div class="col-md-12 ">',	
																					'style'	=> 'margin-left: -15px;',		
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => 'CC:',
																									'style' => 'margin-left: 15px;',
																								),
																					'placeholder' => 'CC',
											)); ?>
											<?php echo $this->Form->input('Student.CCO', array(	
																					'type' => 'hidden',
																					'before' => '<div class="col-md-12 ">',	
																					'style' => 'margin-left: -15px;',			
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => 'CCO:',
																									'style' => 'margin-left: 15px;',
																								),
																					'placeholder' => 'CCO',
											)); ?>
											<?php echo $this->Form->input('Student.title', array(
																					'before' => '<div class="col-md-9 "><img data-toggle="tooltip" id="" data-placement="top" title="Ingresar asunto del mensaje, breve y conciso." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 8px;">',
																					'between' => '<div class="col-xs-11 col-sm-10 col-md-10 " style="padding-left: 5px; padding-right: 5px;">',
																					'style' => 'margin-left: -5px;',				
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => '',
																									'style' => 'margin-left: 5px;',
																									),
																					'placeholder' => 'Título',
											)); ?>
											
											<?php echo $this->Form->input('Student.file', array(
																					'type' => 'file',
																					'before' => '<div class="col-md-12 ">',
																					'between' => '<div class="col-xs-11 col-sm-9 col-md-8 upload">',
																					'style' => 'display: block !important;
																														width: 157px !important;
																														height: 57px !important;
																														opacity: 0 !important;
																														overflow: hidden !important;
																														background-repeat-y: no-repeat;
																														cursor: pointer;',
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-6 col-md-3 control-label',
																									'text' => 'máx. 200kb'
																									),
																					'onchange' => 'cambiarContenido()'
																					
											)); ?>
											<div class="col-md-12" >
												<p id="textFile" style="border-top-width: 0px; margin-left: 18px; "></p>
											</div>
											<?php echo $this->Form->input('Student.message', array(	
																						'type' => 'textarea',
																						'rows' => '5',
																						'cols' => '5',
																						'maxlength' => '632',
																						'id' => 'messageIdEmail',
																						'before' => '<div class="col-md-12 ">',
																						'style' => 'margin-left: -25px; resize: vertical; min-height: 75px;  max-height: 150px; height: 130px;',
																						'label' => array(
																										'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																										'text' => '',
																										'style' => 'margin-top: -5px;left: -7px;',
																						),
																						'placeholder' => 'Cuerpo del correo'
											)); ?>
											<div class="col-md-11 form-group row" style="text-align: right; top: -10px; margin-left: 7px; margin-bottom: 0px;padding-right: 22px;">
												<span id="contadorTaComentario2" style="color: white">0/632</span><span style="color: white"> caracteres máx.</span>
												<img data-toggle="tooltip" id="" data-placement="left" title="Mensaje que le será enviado al candidato" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: -55px;">
											</div>
													
											<?php echo $this->Form->input('Student.sign', array(	
																					'before' => '<div class="col-md-6 "><img data-toggle="tooltip" id="" data-placement="top" title="Texto de identificación que será presentado en todos los correos que envíe.Se sugiere los siguientes datos: nombre, cargo y empresa, teléfono de contacto, redes sociales." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: -5px;margin-top: 8px;">',
																					'style' => 'margin-left: -10px;',
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => '',
																									'style' => 'margin-left: 10px;',
																									),
																					'placeholder' => 'Firma',
																					'between' => '<div class="col-xs-11 col-sm-8 col-md-4 ">',

											)); ?>
										</fieldset>

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

		<!--Form para actualizar password -->
		<div class="modal fade" id="myModalUpdatePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 650px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Modificar contraseña del Empresa/Institucón</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 270px;">
									<?php 
										echo $this->Form->create('Administrator', array(
														'class' => 'form-horizontal', 
														'role' => 'form',
														'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'label' => array('class' => 'col-xs-4 col-sm-4 col-md-2 col-md-4 control-label '),
															'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => '<div class="col-md-7">',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
														),
														'action' => 'updateCompanyPassword'
										)); ?>
										<fieldset style="margin-top: 30px;">
												<?php echo $this->Form->input('company_id', array(					
																'label' => array(
																	'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
																	'text' => 'id de usuario',
																	),
																'placeholder' => 'id de usuario',
																'type' => 'hidden',
												)); ?>
												<?php echo $this->Form->input('password', array(
													'before' => '<div class="col-md-12 ">',
																'type' => 'password',
																'readonly' => 'readonly',
																'value' => $this->Session->read('randomPass'),
																'label' => array(
																	'class' => 'col-xs-5 control-label',
																	'text' => 'Contraseña generada automaticamente:'),
																'placeholder' => 'Escribir nueva contraseña'
												)); ?>	
												<?php echo $this->Form->input('company_email', array(	
													'before' => '<div class="col-md-12 ">',
														'readonly' => 'readonly',
														'type' => 'text',
														'label' => array(
															'class' => 'col-xs-5 control-label',
															'text'=>'Envio de notificación al correo:'),
														'placeholder' => 'Envio de notificación al correo',					
												)); ?>
												<?php echo $this->Form->input('company_email_alternativo', array(
														'before' => '<div class="col-md-12 ">',	
														'type' => 'text',
														'label' => array(
															'class' => 'col-xs-5 control-label',
															'text'=>'Correo alternativo:'),
														'placeholder' => 'Correo alternativo',					
												)); ?>
											<p style="font-size: 12px;">Si necesita agregar más de un correo alternativo estos deberan estar separados por un punto y coma ';'</p>
										</fieldset>
								</div>
								<div class="modal-footer">
									<?php 	echo $this->Form->button('Modificar&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-lock"></i>',array(
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