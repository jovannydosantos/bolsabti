	<?php 
		$this->layout = 'administrator'; 
	?>
	<script>
		
		$(document).ready(function() {
			$("#AdministratorStartDateSearchYear").css("width", "65px");
			$("#AdministratorStartDateSearchMonth").css("width", "90px");
			$("#AdministratorStartDateSearchDay").css("width", "60px");
			
			$("#AdministratorEndDateSearchYear").css("width", "65px");
			$("#AdministratorEndDateSearchMonth").css("width", "90px");
			$("#AdministratorEndDateSearchDay").css("width", "60px");
		
		<?php if( (isset($this->request->data)) and (!empty($this->request->data)) and (isset($this->request->data['Administrator']['start_date_search']['year'])) and (($this->request->data['Administrator']['start_date_search']['year']<>''))): ?>
			 $('#AdministratorStartDateSearchYear').prepend('<option value="">AAAA</option>');
			 $('#AdministratorStartDateSearchMonth').prepend('<option value="">MM</option>');
			 $('#AdministratorStartDateSearchDay').prepend('<option value="">DD</option>');
			 
			 $('#AdministratorEndDateSearchYear').prepend('<option value="">AAAA</option>');
			 $('#AdministratorEndDateSearchMonth').prepend('<option value="">MM</option>');
			 $('#AdministratorEndDateSearchDay').prepend('<option value="">DD</option>');
		 <?php else: ?>
			 $('#AdministratorStartDateSearchYear').prepend('<option value="" selected>AAAA</option>');
			 $('#AdministratorStartDateSearchMonth').prepend('<option value="" selected>MM</option>');
			 $('#AdministratorStartDateSearchDay').prepend('<option value="" selected>DD</option>');
			 
			 $('#AdministratorEndDateSearchYear').prepend('<option value="" selected>AAAA</option>');
			 $('#AdministratorEndDateSearchMonth').prepend('<option value="" selected>MM</option>');
			 $('#AdministratorEndDateSearchDay').prepend('<option value="" selected>DD</option>');
		 <?php endif; ?>
		
				$('#CompanyJobProfileExpirationYear').prepend('<option value="" selected>AAAA</option>');
				$('#CompanyJobProfileExpirationMonth').prepend('<option value="" selected>MM</option>');
				$('#CompanyJobProfileExpirationDay').prepend('<option value="" selected>DD</option>');
		setDates();
		typeSearch();
		ocultar();
	});	
		
		function setDates(){
			if ($('#AdministratorProfileUnlimited').is(':checked')) {
					document.getElementById('AdministratorProfileStartDateExpirationYear').options[0].selected = 'selected';
					document.getElementById('AdministratorProfileStartDateExpirationMonth').options[0].selected = 'selected';
					document.getElementById('AdministratorProfileStartDateExpirationDay').options[0].selected = 'selected';
					
					document.getElementById('AdministratorProfileEndDateExpirationYear').options[0].selected = 'selected';
					document.getElementById('AdministratorProfileEndDateExpirationMonth').options[0].selected = 'selected';
					document.getElementById('AdministratorProfileEndDateExpirationDay').options[0].selected = 'selected';
			}
		}
	
		function saveEmailNotification(email){
			document.getElementById('StudentEmailTo').value = email;
			$('#myModalMail').modal('show');
		}
		
		function updatePassword(id,email,secondaryEmail){
			document.getElementById('AdministratorCompanyId').value = id;
			var stringMails = email;
			if(secondaryEmail!=''){
				if(secondaryEmail!=null){
					stringMails = stringMails+';'+secondaryEmail;
				}
			}
			document.getElementById('AdministratorCompanyEmail').value = stringMails;
			$('#myModalUpdatePassword').modal('show');
		}

		function cambiarContenido(){
				var archivo = document.getElementById('StudentFile').value;
				extensiones_permitidas = new Array(".jpg",".pdf");
				mierror = "";

				if (!archivo) {
						jAlert('No se ha adjuntado ningún archivo', 'Mensaje');
						document.getElementById('StudentFile').scrollIntoView();
						return false;
				}else{
						extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
						permitida = false;
						for (var i = 0; i < extensiones_permitidas.length; i++) {
							 if (extensiones_permitidas[i] == extension) {
							 permitida = true;
							 break;
							 }
						}
						  
						if (!permitida) {
							jAlert("Compruebe la extensión de su archivo. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(), 'Mensaje');
							document.getElementById('StudentFile').scrollIntoView();
							deleteText();
							return false;
						}else{
							document.getElementById("textFile").innerHTML = document.getElementById('StudentFile').value + '<button id="deleteTextId" onclick="deleteText();" class="btnBlue" style="margin-left: 10px;" >x</button>';
							return false;
						}
				   }
		}
			
		function deleteText(){
			document.getElementById("textFile").innerHTML = '';
			document.getElementById('StudentFile').value = '';  
			return false;
		}
		
		function deleteCompany(param){
			document.getElementById('focusCompanyId'+param).scrollIntoView();
			jConfirm('¿Realmente desea eliminar a esta empresa?', 'Confirmación', function(r){
				if( r ){
					$("#deleteCompanyId"+param).click();
					}
			});	
		}
		
		function validarFecha(fecha){
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
		
		function validate_fechaMayorQue(fechaInicial,fechaFinal){
			// dd/mm/yyyy
            valuesStart=fechaInicial.split("/");
            valuesEnd=fechaFinal.split("/");

            // Verificamos que la fecha no sea posterior a la actual
            var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
            var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);

            if(dateStart>=dateEnd){
                return 0;
            }
            return 1;
        }
		
		function sendForm(valor){
			ocultar();
			
			var year1  = $( "#AdministratorStartDateSearchYear" ).val();
			var month1 = $( "#AdministratorStartDateSearchMonth" ).val();
			var day1   = $( "#AdministratorStartDateSearchDay" ).val();
				
			var year2  = $( "#AdministratorEndDateSearchYear" ).val();
			var month2 = $( "#AdministratorEndDateSearchMonth" ).val();
			var day2   = $( "#AdministratorEndDateSearchDay" ).val();
			
			var fecha1 = document.getElementById('AdministratorStartDateSearchDay').value	+ "/" +
						document.getElementById('AdministratorStartDateSearchMonth').value	+ "/" +
						document.getElementById('AdministratorStartDateSearchYear').value;
			
			var fecha2 = document.getElementById('AdministratorEndDateSearchDay').value	+ "/" +
						document.getElementById('AdministratorEndDateSearchMonth').value	+ "/" +
						document.getElementById('AdministratorEndDateSearchYear').value;
						
			validaFecha1 = validarFecha(fecha1);
			validaFecha2 = validarFecha(fecha2);
			
			// dd/mm/yyyy
			valida1 = day1+'/'+month1+'/'+year1;
			valida2 = day2+'/'+month2+'/'+year2;
			resultadoComparativa=validate_fechaMayorQue(valida1,valida2);
			
			selectedDate = 0;
			if((year1 == '') && (month1 == '') && (day1 == '') && (year2 == '') && (month2 == '') && (day2 == '')){
				selectedDate = 1;
			}
		
			if(valor==1){
				resetColor();
				$("#filtroBotonId1").css({"background-color": "#e6e6e6", "color": "#333"}); 
				ocultar();
				$('#filtroId1').show("slow");
				return false;
			}else if(valor==2){
				resetColor();
				$("#filtroBotonId2").css({"background-color": "#e6e6e6", "color": "#333"}); 
				ocultar();
				$('#filtroId2').show("slow");
				return false;
			}else if(valor==3){
				resetColor();
				$("#filtroBotonId3").css({"background-color": "#e6e6e6", "color": "#333"}); 
				ocultar();
				$('#filtroId3').show("slow");
				return false;
			}else if(valor==4){
				resetColor();
				$("#filtroBotonId4").css({"background-color": "#e6e6e6", "color": "#333"}); 
				ocultar();
				$('#filtroId4').show("slow");
				return false;
			}else if(valor==5){
				resetColor();
				$("#filtroBotonId5").css({"background-color": "#e6e6e6", "color": "#333"}); 
				ocultar();
				$('#filtroId5').show("slow");
				return false;
			}else if(valor==6){
				resetColor();
				$("#filtroBotonId6").css({"background-color": "#e6e6e6", "color": "#333"}); 
				ocultar();
				$('#filtroId6').show("slow");
				return false;
			}else if(validaFecha1 == false){
					jAlert('La fecha inicio de la búsqueda es incorrecta o incompleta', 'Mensaje');
					document.getElementById('AdministratorStartDateSearchDay').focus();
					return false;
			}else if(validaFecha2 == false){
					jAlert('La fecha fin de la búsqueda es incorrecta o incompleta', 'Mensaje');
					document.getElementById('AdministratorEndDateSearchDay').focus();
					return false;
			}else if((valor==7) && (selectedDate == 0) ){
				if(resultadoComparativa==1){
					jAlert('La fecha inicio de la búsqueda debe ser menor a la final', 'Mensaje');
					document.getElementById('AdministratorEndDateSearchDay').focus();
					return false;
				}else{
					document.getElementById('AdministratorTypeFilter').value = valor;
					document.getElementById("AdministratorCompanyHistoryForm").submit();
				}
			}else {
					return false;
				
			}
		}

		function ocultar(){
			$('#filtroId1').hide(1000);
			$('#filtroId2').hide(1000);
			$('#filtroId3').hide(1000);
			$('#filtroId4').hide(1000);
			$('#filtroId5').hide(1000);
			$('#filtroId6').hide(1000);
			
		}
		
		function resetColor(){
			$("#filtroBotonId1").css({"background-color": "#2d3881", "color": "white"}); 
			$("#filtroBotonId2").css({"background-color": "#2d3881", "color": "white"}); 
			$("#filtroBotonId3").css({"background-color": "#2d3881", "color": "white"}); 
			$("#filtroBotonId4").css({"background-color": "#2d3881", "color": "white"}); 
			$("#filtroBotonId5").css({"background-color": "#2d3881", "color": "white"}); 
			$("#filtroBotonId6").css({"background-color": "#2d3881", "color": "white"}); 
		}
		
		function validateEmpty(){
			selectedIndex = document.getElementById("AdministratorCriterio").selectedIndex;
			var palabraBuscar = document.getElementById('AdministratorBuscar').value ;
			var sueldo = document.getElementById("AdministratorBuscarSalary").selectedIndex;
			
			
			if(selectedIndex == 0){
				jAlert('Seleccione el criterio de búsqueda', 'Mensaje');
				document.getElementById('AdministratorCriterio').focus();
				return true;
			}else 
			if((palabraBuscar == '') && (sueldo == '')){
				
				if(selectedIndex == 1){
					jAlert('Ingrese el puesto', 'Mensaje');
					document.getElementById('AdministratorBuscar').focus();
				} else
				if(selectedIndex == 2){
					jAlert('Seleccione el rango de sueldo', 'Mensaje');
					document.getElementById('AdministratorBuscarSalary').focus();
				}else{
						jAlert('Ingrese el folio', 'Mensaje');
						document.getElementById('AdministratorBuscar').focus();
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
			selectedIndexTypeSearch = document.getElementById("AdministratorCriterio").selectedIndex;

			if(selectedIndexTypeSearch==2){
				$("#idDivBuscar").hide();
				$("#idDivBuscarSelect").show();
				$('#AdministratorBuscar').val('');
				
			} else {
				$("#idDivBuscar").show();
				$("#idDivBuscarSelect").hide();
				
				document.getElementById('AdministratorBuscarSalary').options[0].selected = 'selected';
			}
			
			if(selectedIndexTypeSearch==1){
				$("#AdministratorBuscar").attr("placeholder", "Ingrese el puesto");
			}else
			if(selectedIndexTypeSearch==3){
				$("AdministratorBuscar").attr("placeholder", "Ingrese el folio");
			}
			
		}
		
		function sendLimit(){
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById('AdministratorLimite').value = document.getElementById('limit').value;
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
		// $paginator = $this->Paginator;
	?>
	</div>
	
		<div class="col-md-9"  style="padding-left: 0px;">
			<?php if(isset($empresas)): 
					if(empty($empresas)):
						echo '<div class="col-md-12"  style="padding-left: 0px; margin-left: 15px">';
							echo '<p style="font-size: 22px; ">No se concontró la empresa solicitada</p>';
						echo '</div>';
						echo '<div class="col-md-2">';
							echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> &nbsp;&nbsp; Regresar', 
																array(
																	'controller'=>'Administrators',
																	'action'=>'searchCompany',
																),
																array(
																	'class' => 'btn btn-default btnBlue ',
																	'style' => 'margin-top: 5px; width: 145px;',
																	'escape' => false
																)	
								);
						echo '</div>';
					else:
			?>
		</div>
				
		<div class="col-md-10" style="max-height: 880px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0px;  margin-left: 24px;">
					
					<?php 
						foreach($companies as $k => $company):
					?>
						<div class="col-md-11" style="background: #fff none repeat scroll 0 0; min-height: 160px;  padding-left: 0px; padding-right: 0px; margin-left: 25px; right: -25px;">    
						
							<div class="col-md-2" style="text-align: center; margin-top: 10px; padding-left: 0px; padding-right: 0px;">
								<?php
											if (isset($company)):
												if(isset($company['Company']['filename'])):
													$url = WWW_ROOT.'img/uploads/company/filename/'.$company['Company']['filename'];
													if(!file_exists( $url )):
														echo $this->Html->image('company/imagenNoEncontrada.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '80px',
																		'height' => '80px',
																	));
													else:
														if($company['Company']['filename'] <> ''):
															echo $this->Html->image('uploads/company/filename/'.$company['Company']['filename'],
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '80px',
																			'height' => '80px',
																		));
														else:
															echo $this->Html->image('company/imagenNoDisponible.png',
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '80px',
																			'height' => '80px',
																		));
														endif;
													endif;
												else:
													echo $this->Html->image('company/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '80px',
																		'height' => '80px',	
																	));
												endif;
											else:
												echo $this->Html->image('company/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '80px',
																		'height' => '80px',
																	));
											endif;
									?>
									
								<p class="blackText" style="margin-top: 10px; font-size: 12px; color: #000">
									<?php echo '<span>'.$company['CompanyProfile']['company_name'].'</span><br>'; ?>
								</p>
								<p class="blackText" style="font-size: 12px; color: #000">
									<?php echo '<span>'.$company['CompanyProfile']['rfc'].'</span>'; ?>
								</p>
							</div>
						
							<div class="col-xs-6" style="margin-top: 15px; text-align: left;">
								<p class="blackText" style="font-size: 14px;">Usuario: <?php echo $company['Company']['username']; ?></p>
								<p class="blackText">Razón social: <?php echo $company['CompanyProfile']['social_reason']; ?></p>
								<p class="blackText">Fecha de registro: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($company['Company']['created'])); ?> </span></p>
								<p class="blackText">Fecha de último movimiento: <span style="font-weight: normal;">
								<?php  
									if(empty($company['CompanyLastUpdate'])):
										echo ' ' . date("d/m/Y",strtotime($company['Company']['created'])); 
									else:
										echo ' ' . date("d/m/Y",strtotime($company['CompanyLastUpdate'][0]['modified'])); 
									endif;
								?> 	
								</span></p>
								<p class="blackText">Contacto de la empresa:</p>
								<span class="blackText">
								<?php
									if($company['CompanyContact']['name']==null):
										echo '<p class="blackText"> - Nombre: </span> Sin especificar <br>';
										echo '<p class="blackText"> - Tel.: Sin especificar <br>';
										echo '<p class="blackText"> - Cel.: </span> Sin especificar </span></p>';
										echo '<p class="blackText"> - Correo: </span> Sin especificar</span></p>';
									else:
										echo '<p class="blackText"> - Nombre: </span>' . $company['CompanyContact']['name']. ' ' .  $company['CompanyContact']['last_name']. ' ' .  $company['CompanyContact']['second_last_name'].'<br>';
										echo '<p class="blackText"> - Tel.: </span> (' . $company['CompanyContact']['long_distance_cod'] .') '. $company['CompanyContact']['telephone_number'] . ' ';
										if($company['CompanyContact']['phone_extension']<>''):
											echo ' - ext. </span> '.$company['CompanyContact']['phone_extension'];
										endif;
										echo '<br>';
										if(($company['CompanyContact']['long_distance_cod_cell_phone']<>'') and ($company['CompanyContact']['cell_phone']<>'')):
											echo '<p class="blackText"> - Cel.: </span> ('.$company['CompanyContact']['long_distance_cod_cell_phone']. ') ' .$company['CompanyContact']['cell_phone'] .'</span></p>';
										endif;
										echo '<p class="blackText"> - Correo: </span> '.$company['Company']['email'].'</span></p>';
									endif;
								  ?>
								</span>	
							</div>
						
						<div class="col-md-4" style=" background: #58595B; float: right;  height: 30px; padding-left: 5px; padding-right: 0px; ">
							<div style="margin-top: 3px" class="grises2">
							
								<?php 
								 // Descativar/activar empresa
									if(($company['CompanyOfferOption']['id']==null) OR ($company['Company']['status'] == 0) OR (strtotime($company['CompanyOfferOption']['end_date_company']) < strtotime(date('Y-m-d')))):
										echo $this->Html->image('student/noActiva.png',
											array(
												'title' => 'Empresa/Institución inactiva click para activar',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'class' => 'class="img-responsive center-block"',
												'url' => array(
																'controller'=>'Administrators',
																'action'=>'enableDisableCompany',
																'?' => array(
																			'id' => $company['Company']['id'],
																			'estatus' => $company['Company']['status'],
																		)
																),
												)
										);
									else:
										echo $this->Html->image('student/activa.png',
											array(
												'title' => 'Empresa/Institución activa click para desactivar',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Administrators',
																'action'=>'enableDisableCompany',
																'?' => array(
																			'id' => $company['Company']['id'],
																			'estatus' => $company['Company']['status'],
																		)
																),
											));
									endif;
								?>
								
								<?php 
								 // Redirecciona a revisión
									echo $this->Html->image('administrator/r.png',
											array(
												'title' => 'Editar lineamientos de publicación y descarga de cv´s',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Administrators',
																'action'=>'companyOfferOption',$company['Company']['id'],
																),
												));
								?>
								
								<?php 
								 // Editar oferta
									echo $this->Html->image('student/lapiz.png',
											array(
												'title' => 'Editar Empresa/Institución',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'companyContact',
																'?' => array(
																		'company_id' => $company['Company']['id'],
																		'editingAdmin' => 'yes')
																),
												));
								?>
								
								<?php 
								// Actualizar contraseña de la empresa
									echo $this->Html->image('administrator/candado.png',
											array(
												'title' => 'Actualizar contraseña',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'updatePassword('.$company['Company']['id'].',"'.$company['Company']['email'].'");',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												)
												);	
								
								?>
								
								<?php 
								// Enviar email a la empresa
									echo $this->Html->image('administrator/arroba.png',
											array(
												'title' => 'Enviar correo',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'saveEmailNotification("'.$company['Company']['email'].'");',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												)
												);	
								
								?>
								
								<?php 
								 // Ver historial de la empresa
									echo $this->Html->image('administrator/clock.png',
											array(
												'title' => 'Historial de la Empresa/Institución',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Administrators',
																'action'=>'companyHistory',$company['Company']['id'],
																),
												));
								?>

								<?php 
								// Envia a reportar contrataciones
									echo $this->Html->image('administrator/contratado.png',
											array(
												'title' => 'Reportar contratación',
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'studentReport','nuevaBusqueda',
																'?' => array(
																		'company_id' => $company['Company']['id'], 
																		'editingAdmin' => 'yes',
																		)
																),
												)
											);
								?>
								
								<?php 
									 // Eliminar empresa
									 echo $this->Html->image('student/eliminar.png',
												array(
													'title' => 'Eliminar Empresa/Institución',
													'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
													'class' => 'class="img-responsive center-block"',
													'id' => 'focusCompanyId'.$company['Company']['id'],
													'onclick' => 'deleteCompany('.$company['Company']['id'].');'
													)
											);
											
									 echo $this->Form->postLink(
															$this->Html->image('student/eliminar.png',
															array('alt' => 'Eliminar universitario', 'title' =>'Eliminar universitario', 'style' => 'width: 20px; height: 20px; display: none','id'=>'deleteCompanyId'.$company['Company']['id'] )), 
															array('action' => 'deleteCompany',$company['Company']['id']), 
															array('escape' => false) 
															);
								?>
							</div>
						</div>
						
							<div class="col-xs-4" style="margin-top: 30px; text-align: left; padding-right: 0px;">
								
								<p class="blackText">
									Ofertas a publicar: <?php echo ($company['CompanyOfferOption']['max_offer_publication']<>null) ? $company['CompanyOfferOption']['max_offer_publication'] : 'Sin especificar'; ?>
									<?php echo (!empty($company['CompanyJobProfile'])) ? '('.count($company['CompanyJobProfile']).')' : ''; ?>
								</p>
								<p class="blackText">
									Curriculums a extraer: <?php echo ($company['CompanyOfferOption']['max_cv_download']<>null) ? $company['CompanyOfferOption']['max_cv_download'] : 'Sin especificar'; ?>
									<?php echo (!empty($company['CompanyDownloadedStudent'])) ? '('.count($company['CompanyDownloadedStudent']).')' : ''; ?>
								</p>
								
								<?php echo $this->Html->link(
														' Ver registro completo ', 
														array(
															'controller'=>'Companies',
															'action'=>'companyContact',
																'?' => array(
																		'company_id' => $company['Company']['id'],
																		'editingAdmin' => 'yes')
															),
														array(
															'class' => 'btn btnRed col-md-10',
															'style' => 'margin-top: 15px;',
															'escape' => false
															)	
								); 	?>
							
							</div>
						
						</div>
					<?php endforeach; ?>
				
			<?php 
				endif;
				endif; 
			?>
		</div>
		
		<div class="col-md-8 col-md-offset-1" style="left: 35px;">
			<?php	echo $this->Form->create('Administrator', array(
							'class' => 'form-horizontal', 
							'role' => 'form',
							'inputDefaults' => array(
								'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'label' => array('class' => 'col-md-2 control-label '),
								'before' => '<div class="col-md-11 col-md-offset-1">',
								'between' => '<div class="col-md-11">',
								'after' => '</div></div>',
								'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style'=>'padding-left: 5px; padding-right: 5px;'))
							),
							'action' => 'companyHistory',
							'onsubmit' =>'return sendForm(7);'
			)); ?>		
			
			<fieldset>
			
		<div class="col-md-12"  style="margin-top: 30px; padding-left: 0px; padding-right: 0px;" >
					<div class="col-md-11"  style="text-align: center; font-weight: bold;" >
					   <p>Buscar por fechas:</p>
					</div>
					<div style="text-align: center; font-weight: bold; height: 0px; margin-right: 50px; margin-left: 30px;" >
					   <p> a </p>
					</div>
					<div class="col-md-6" style=" padding-right: 0px;">
						<?php echo $this->Form->input('start_date_search', array(
																	'type' => 'date',
																	'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">',
																	'between' => '<div class="col-md-12 ">',
																	'class' => 'selectpicker show-tick form-control show-menu-arrow',
																	'data-width'=> '80px',
																	'label' => array(
																				'class' => 'col-md-0 col-md-offset-0 control-label',
																				'text' => '',),
																	'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px; font-size: 12px;',
																	'div' => array('class' => 'form-inline'),
																	'label' => array(
																		'class' => 'col-sm-0 col-md-0 control-label',
																		'text' => '',),
																	'dateFormat' => 'YMD',
																	'separator' => '',
																	'minYear' => date('Y') - 2,
																	'maxYear' => date('Y') - 0,
																	'onchange' => 'setDates();',
																	'placeholder' => 'Vigencia que aparecerá en la oferta',
																	'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
									));
						?>
					</div>
					<div class="col-md-6" style=" padding-right: 0px;">
						<?php echo $this->Form->input('end_date_search', array(
																	'type' => 'date',
																	'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">',
																	'between' => '<div class="col-md-12 ">',
																	'class' => 'selectpicker show-tick form-control show-menu-arrow',
																	'data-width'=> '80px',
																	'label' => array(
																				'class' => 'col-md-0 col-md-offset-0 control-label',
																				'text' => '',),
																	'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px; font-size: 12px;',
																	'div' => array('class' => 'form-inline'),
																	'label' => array(
																		'class' => 'col-sm-0 col-md-0 control-label',
																		'text' => '',),
																	'dateFormat' => 'YMD',
																	'separator' => '',
																	'minYear' => date('Y') - 2,
																	'maxYear' => date('Y') - 0,
																	'onchange' => 'setDates();',
																	'placeholder' => 'Vigencia que aparecerá en la oferta',
																	'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
									)); 
						?>
					</div>		
					<?php echo $this->Form->input('typeFilter', array(				
																	'type' => 'hidden'
																				)				
												);
					?>					
				</div>
				</fieldset>
				<div style="margin-top: 20px;" class="col-md-7 col-md-offset-2">
						<?php 
							echo $this->Form->button('<i class="glyphicon glyphicon-search"></i>&nbsp; Buscar', array(
											'type' => 'submit', 
											'div' => 'form-group',
											'class' => 'btn btnBlue btn-default col-md-offset-5',
											'escape' => false,
						));
							echo $this->Form->end(); 
						?>
				</div>
			</div>

		<div class="col-md-9 col-md-offset-1" style="margin-top: 25px;">
					<div class="btn-group" style="margin-left: 0px; margin-right: 50px;">
					<?php 
							echo $this->Html->link('Ofertas publicadas', 
																		'',
																		array(
																			'onClick' => 'return sendForm(1);',
																			'class' => 'btn btn-default btnBlue ',
																			'id' => 'filtroBotonId1',
																			'style' => 'margin-top: 5px; width: 200px;',
																			)	
						); 	?> 
					</div>

					<div class="btn-group" style="margin-left: 5px; margin-right: 50px;">
						<?php 
							echo $this->Html->link('Ofertas con contratados', 
																			'',
																		array(
																			'onClick' => 'return sendForm(2);',
																			'class' => 'btn btn-default btnBlue ',
																			'id' => 'filtroBotonId2',
																			'style' => 'margin-top: 5px; width: 200px;',
																			)		
						); 	?> 
					</div>
					
					
					<div class="btn-group" style="margin-left: 5px;">
						<?php 
							echo $this->Html->link('Candidatos postulados', 
																		'',
																		array(
																			'onClick' => 'return sendForm(3);',
																			'class' => 'btn btn-default btnBlue ',
																			'id' => 'filtroBotonId3',
																			'style' => 'margin-top: 5px; width: 200px;',
																			)	
						); 	?> 
					</div>
					
					
		</div>
		
		<div class="col-md-9 col-md-offset-1" style="margin-top: 15px;">
					<div class="btn-group" style="margin-right: 50px;">
						<?php 
							echo $this->Html->link('Entrevistas telefónicas', 
																		'',
																		array(
																			'onClick' => 'return sendForm(4);',
																			'class' => 'btn btn-default btnBlue ',
																			'id' => 'filtroBotonId4',
																			'style' => 'margin-top: 5px; width: 200px;',
																			)		
						); 	?> 
					</div>	
					
					<div class="btn-group" style="margin-left: 5px;margin-right: 50px;">
						<?php 
							echo $this->Html->link('Entrevistas presenciales', 
																		'',
																		array(
																			'onClick' => 'return sendForm(5);',
																			'class' => 'btn btn-default btnBlue ',
																			'id' => 'filtroBotonId5',
																			'style' => 'margin-top: 5px; width: 200px;',
																			)		
						); 	?> 
					</div>	
					
					<div class="btn-group" style="margin-left: 5px;">
						<?php 
							echo $this->Html->link('Currículums extraidos', 
																		'',
																		array(
																			'onClick' => 'return sendForm(6);',
																			'class' => 'btn btn-default btnBlue ',
																			'id' => 'filtroBotonId6',
																			'style' => 'margin-top: 5px; width: 200px;',
																			)		
						); 	?> 
					</div>	
		</div>
		<?php
			if($empresas[0]['CompanyOfferOption']['max_cv_download']<>null):
				$cvExtraer = $empresas[0]['CompanyOfferOption']['max_cv_download'];
			else:
				$cvExtraer = 'Sin especificar';
			endif;
		
		?>
		<?php if(isset($datos) and !empty($datos)): ?>
				
				<!--Resultados de filtro 1 -->
				<div class="col-md-9 col-md-offset-1" style="margin-top: 30px; display: none" id="filtroId1">
					<p style="color: #FFB71F;">Total ofertas publicadas: <?php echo count($datos);  ?> </p>
				</div>

				<!--Resultados de filtro 2 -->
				<?php 
					$totalOfertas = 0;
					$totalContratados = 0;
					foreach($datos as $k => $oferta):
						if(!empty($oferta['Report'])):
							$totalOfertas++;
							foreach($oferta['Report'] as $k => $reporte):
								if($reporte['registered_by']=='company'):
									$totalContratados++;
								endif;
							endforeach;
						endif;
					endforeach;
				?>
				
				<div class="col-md-9 col-md-offset-1" style="margin-top: 30px; display: none" id="filtroId2">
					<p style="color: #FFB71F;">Total ofertas con contratados: <?php echo $totalOfertas; ?> </p>
					<p style="color: #FFB71F;">Total contratados: <?php echo $totalContratados; ?>  </p>
				</div>

				<!--Resultados de filtro 3-->
					<?php 
					$totalPostulados = 0;
					foreach($datos as $k => $postulados):
						if(!empty($postulados['Application'])):
							$totalPostulados = $totalPostulados + count($postulados['Application']);
						endif;
					endforeach;
				?>
				<div class="col-md-9 col-md-offset-1" style="margin-top: 30px; display: none" id="filtroId3">
					<p style="color: #FFB71F;">Total ofertas con postulados: <?php  echo $totalPostulados; ?> </p>
				</div>

				<!--Resultados de filtro 4 -->
				<?php 
					$totalTelefonicas = 0;
					foreach($datos as $k => $telefonicas):
						if(!empty($telefonicas['StudentNotification'])):
							foreach($telefonicas['StudentNotification'] as $k => $telefonica):
								if($telefonica['interview_type'] == 1):
									$totalTelefonicas++;
								endif;
							endforeach;
						endif;
					endforeach;
				?>
				<div class="col-md-9 col-md-offset-1" style="margin-top: 30px; display: none" id="filtroId4">
					<p style="color: #FFB71F;">Total ofertas con entrevistas telefónicas: <?php  echo $totalTelefonicas; ?> </p>
				</div>

				<!--Resultados de filtro 5 -->
				<?php 
					$totalPresenciales = 0;
					foreach($datos as $k => $presenciales):
						if(!empty($presenciales['StudentNotification'])):
							foreach($presenciales['StudentNotification'] as $k => $presencial):
								if($presencial['interview_type'] == 2):
									$totalPresenciales++;
								endif;
							endforeach;
						endif;
					endforeach;
				?>
				<div class="col-md-9 col-md-offset-1" style="margin-top: 30px; display: none" id="filtroId5">
					<p style="color: #FFB71F;">Total ofertas con entrevistas presenciales: <?php  echo $totalPresenciales; ?>  </p>
				</div>

				<!--Resultados de filtro 6 -->
				<div class="col-md-9 col-md-offset-1" style="margin-top: 30px; display: none" id="filtroId6">
					<p style="color: #FFB71F;">Total currículums extraídos: <?php echo $descargas;  ?>  </p>
					<p style="color: #FFB71F;">Total de currículums a extraer: <?php echo $cvExtraer;  ?>  </p>
				</div>
	<?php else: ?>
				<!--Resultados de filtro 1 -->
				<div class="col-md-9 col-md-offset-1" style="margin-top: 30px; display: none" id="filtroId1">
					<p style="color: #FFB71F;">Total ofertas publicadas: <?php echo count($empresas[0]['CompanyJobProfile']);  ?> </p>
				</div>

				<!--Resultados de filtro 2 -->			
				<?php 
					$totalOfertas = 0;
					$totalContratados = 0;
					foreach($empresas[0]['CompanyJobProfile'] as $k => $oferta):
						if(!empty($oferta['Report'])):
							$totalOfertas++;
							foreach($oferta['Report'] as $k => $reporte):
								if($reporte['registered_by']=='company'):
									$totalContratados++;
								endif;
							endforeach;
						endif;
					endforeach;
				?>
				
				<div class="col-md-9 col-md-offset-1" style="margin-top: 30px; display: none" id="filtroId2">
					<p style="color: #FFB71F;">Total ofertas con contratados: <?php echo $totalOfertas; ?> </p>
					<p style="color: #FFB71F;">Total contratados: <?php echo $totalContratados; ?>  </p>
				</div>

				<!--Resultados de filtro 3-->
					<?php 
					$totalPostulados = 0;
					foreach($empresas[0]['CompanyJobProfile'] as $k => $postulados):
						if(!empty($postulados['Application'])):
							$totalPostulados = $totalPostulados + count($postulados['Application']);
						endif;
					endforeach;
				?>
				<div class="col-md-9 col-md-offset-1" style="margin-top: 30px; display: none" id="filtroId3">
					<p style="color: #FFB71F;">Total ofertas con postulados: <?php  echo $totalPostulados; ?> </p>
				</div>

				<!--Resultados de filtro 4 -->
				<?php 
					$totalTelefonicas = 0;
					foreach($empresas[0]['CompanyJobProfile'] as $k => $telefonicas):
						if(!empty($telefonicas['StudentNotification'])):
							foreach($telefonicas['StudentNotification'] as $k => $telefonica):
								if($telefonica['interview_type'] == 1):
									$totalTelefonicas++;
								endif;
							endforeach;
						endif;
					endforeach;
				?>
				<div class="col-md-9 col-md-offset-1" style="margin-top: 30px; display: none" id="filtroId4">
					<p style="color: #FFB71F;">Total ofertas con entrevistas telefónicas: <?php  echo $totalTelefonicas; ?> </p>
				</div>

				<!--Resultados de filtro 5 -->
				<?php 
					$totalPresenciales = 0;
					foreach($empresas[0]['CompanyJobProfile'] as $k => $presenciales):
						if(!empty($presenciales['StudentNotification'])):
							foreach($presenciales['StudentNotification'] as $k => $presencial):
								if($presencial['interview_type'] == 2):
									$totalPresenciales++;
								endif;
							endforeach;
						endif;
					endforeach;
				?>
				<div class="col-md-9 col-md-offset-1" style="margin-top: 30px; display: none" id="filtroId5">
					<p style="color: #FFB71F;">Total ofertas con entrevistas presenciales: <?php  echo $totalPresenciales; ?>  </p>
				</div>

				<!--Resultados de filtro 6 -->
				<div class="col-md-9 col-md-offset-1" style="margin-top: 30px; display: none" id="filtroId6">
					<p style="color: #FFB71F;">Total currículums extraídos: <?php echo $descargas;  ?>  </p>
					<p style="color: #FFB71F;">Total de currículums a extraer: <?php echo $cvExtraer;  ?>  </p>
				</div>
	<?php endif; ?>
		
	<div class="col-md-12">
		<?php 
			echo $this->Session->flash();
			
		?>
		
		<div class="col-md-12" >

			<div class="col-md-12" style="left: -35px;">
				<div class="col-md-12"  style="margin-top: 25px;">
					<p>Buscar en todas las ofertas de la empresa <?php echo '<span>'.$company['CompanyProfile']['company_name'].'</span>'; ?> :</p>
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
									'action' => 'companyHistory',
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
															'type' => 'select',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
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
													'class' => 'selectpicker show-tick form-control show-menu-arrow',
													'value' => $this->Session->read('tipoBusqueda'),
													'before' => '<div class="col-md-12" style="padding-left: 0px;">',
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
												'id' => 'idBucar',
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

			

			<?php if(isset($ofertas)): 
					if(empty($ofertas)):
						echo '<div class="col-md-12" style="margin-top: 15px;"> <p style="font-size: 22px;">Sin ofertas</p></div>';
					else:
					
					
			?>
		</div>
	
	</div>
	
		<div class="col-md-7" style="left: 10px; height: 70px;">
				<p>Ofertas de la empresa</p>
				
				<div class="col-md-3" style="padding-left: 0px;">
					 <?php 	echo $this->Html->link(
													'Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
															array(
																	'controller'=>'Administrators',
																	'action'=>'companyHistoryExcel',
																),
																array(
																	'class' => 'btn btn-default btnBlue ',
																	'style' => 'width: 180px; font-size: 14px; height: 32px;',
																	'escape' => false,
																	)	
												); 
						?>
				</div>
				<div class="col-md-4" >
					
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
															'between' => ' <div class="col-md-10" style="margin-left: 20px;">',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
									),
									'action' => 'companyHistory',
							));
					
						$options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200);
						echo $this->Form->input('limit', array(
															'onchange' => 'sendPaginado()',
															'id' => 'limit',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'data-width' => '180px',
															'type'=>'select',
															'before' => '<div class="col-md-12 " ',
															'selected' => $this->Session->read('limite'),
															'label' =>'',
															'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja'
						)); 
						
						echo $this->Form->end(); 
						
						?>	
				</div>
		</div>
			
		<div class="col-md-11" style="max-height: 650px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0p;margin-left:-24px;">
					
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
								<p class="blackText">Fecha publicación: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyJobProfile']['created'])); ?> </span></p>
								<p class="blackText">Fecha de actualización: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyLastUpdate']['modified'])); ?> </span></p>
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
						
						<div class="col-xs-4" style="background: #58595B; float: right; height: 30px; padding-left: 5px; padding-right: 5px;">

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
																'?'=> array(
																			'company_id' => $company['Company']['id'],
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
																			'company_id' => $company['Company']['id'],
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
																			'company_id' => $company['Company']['id'],
																			'id' => $oferta['CompanyJobProfile']['id'],
																			'editingAdmin' => 'yes',
																			// 'nuevaBusqueda' => 'nuevaBusqueda',
																			)
																),
												)
										);
								?>
								
								<?php 
									echo $this->Html->image('student/descargado.png',
											array(
												'title' => 'Descargar PDF',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'profile'),
											));
								?>
								
								<?php 
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
						
						
							<div class="col-md-4" style="margin-top: 10px; text-align: left; padding-right: 0px;" >
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
																								'volver' => 'companyHistory',
																								
																						)
																),
															array(
																'style' => 'margin-top: 5px;margin-left: 30px; color:#2D3881; text-decoration: underline;',
																'escape' => false)	
									); 	
								else: 
									echo $this->Html->link('Entrevistas telefónicas: '.$totalTelefonicasOferta, 
																			'',
																			array(
																				'onclick' => 'return SinCandidatos();',
																				'id' => 'filtroBotonId1',
																				'style' => 'margin-top: 5px;margin-left: 30px; color:#2D3881; text-decoration: underline;',
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
																								'volver' => 'companyHistory',
																						)
																),
															array(
																'style' => 'margin-top: 5px;margin-left: 30px; color:#2D3881; text-decoration: underline;',
																'escape' => false)	
									); 	
								else: 
									echo $this->Html->link('Entrevistas presenciales: '.$totalPresencialesOferta, 
																			'',
																			array(
																				'onclick' => 'return SinCandidatos();',
																				'id' => 'filtroBotonId1',
																				'style' => 'margin-top: 5px;margin-left: 30px; color:#2D3881; text-decoration: underline;',
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
								
								<br>
								
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
																								'volver' => 'companyHistory',
																						)),
															array(
																'style' => 'margin-top: 5px;margin-left: 30px; color:#2D3881; text-decoration: underline;',
																'escape' => false)	
									); 	
								else: 
									echo $this->Html->link('Contrataciones: '.$totalContratados, 
																			'',
																			array(
																				'onclick' => 'return SinCandidatos();',
																				'id' => 'filtroBotonId1',
																				'style' => 'margin-top: 5px;margin-left: 30px; color:#2D3881; text-decoration: underline;',
																				)	
									); 	
								endif;
								?> 
								
								<br>
								
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
																								'volver' => 'companyHistory',
																						)),
															array(
																'style' => 'margin-top: 5px;margin-left: 30px; color:#2D3881; text-decoration: underline;',
																'escape' => false)	
														); 	
								else: 
									echo $this->Html->link('Postulaciones: '.count($oferta['Application']), 
																			'',
																			array(
																				'onclick' => 'return SinCandidatos();',
																				'id' => 'filtroBotonId1',
																				'style' => 'margin-top: 5px;margin-left: 30px; color:#2D3881; text-decoration: underline;',
																				)	
									); 	
								endif;
								?> 
								
								<br>
								
								<?php echo $this->Html->link(
														' Ver oferta completa ', 
														array(
															'controller'=>'Companies',
															'action'=>'viewOfferOnline', 
																'?'=> array(
																			'company_id' => $company['Company']['id'],
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
									<h4 class="modal-title" id="myModalLabel">Modificar contraseña de Empresa/Institucón</h4>
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