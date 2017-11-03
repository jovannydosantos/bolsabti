<?php 
		foreach($ofertaSeleccionada as $k => $ofertaSeleccionada):
?>

<script>
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
		
	function ofertaExpirada(){
		$.alert({
			title:'AVISO',
			type: 'blue',
			content : 'Oferta Expirada',
		});	
	}
	
	function ofertaIncompleta(){
		$.alert({
			title:'AVISO',
			type: 'blue',
			content : 'Oferta Incompleta',
		});	
	}
	function mensajeLimiteDescargas(){
		$.alert({
			title:'AVISO',
			type: 'blue',
			content : 'Oferta Incompleta',
		});	
	}
		function mensajeSinConfigurar(){
		$.alert({
			title:'AVISO',
			type: 'blue',
			content : 'Oferta Incompleta',
		});	
	}
		function cvIncompleto(){
		$.alert({
			title:'AVISO',
			type: 'blue',
			content : 'Oferta Incompleta',
		});	
	}
	
	function deleteOffer(param){
		$.confirm({
			title: 'Confirmación!',
			icon: 'glyphicon glyphicon-warning-sign',
			type: 'red',
			content: '¿Realmente desea eliminar la oferta',
			buttons: {
				aceptar: function () {
				   $("#deleteOfferId"+param).click();
				},
				cancelar: function () {
					// $.alert('Opción cancelada!');
				},
			}
		});
	}
</script>



<div class="col-md-12 sombra" style="border: 1px solid #1a75bb; margin-bottom: 15px; background: url('/bolsabti/img/satinweave.png');">    
     <!-- columna logo -->
	<div class="col-md-2 visible-lg visible-md" style="margin-top: 1%; padding-left: 0px; padding-right: 0px;">
		<?php
			$url = WWW_ROOT.'img/uploads/company/filename/'.$ofertaSeleccionada['Company']['filename'];
			if(($ofertaSeleccionada['CompanyJobOffer']['confidential_job_offer'] == 's') || (!isset($ofertaSeleccionada)) || (!isset($ofertaSeleccionada['Company']['filename']) || (!file_exists( $url )) || (($ofertaSeleccionada['Company']['filename'] == '')))):
				echo $this->Html->image('company/imagenNoDisponible.png',['style'=>'width:100%; height: 100%; ' ]);
			else:
				echo $this->Html->image('uploads/company/filename/'.$ofertaSeleccionada['Company']['filename'],['style'=>'width:100%; height: 100%; image-rendering: pixelated;' ]);
			endif;
		?>	
		<p><center>
		<?php 
			if(($ofertaSeleccionada['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($ofertaSeleccionada['CompanyJobOffer']['company_name']<>'')):
				echo $ofertaSeleccionada['CompanyJobOffer']['company_name']; 
			else:
				if(($ofertaSeleccionada['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($ofertaSeleccionada['CompanyJobOffer']['company_name']=='')):
					echo 'Confidencial';
				else:
					if(($ofertaSeleccionada['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($ofertaSeleccionada['CompanyJobOffer']['company_name']<>'')):
						echo $ofertaSeleccionada['CompanyJobOffer']['company_name']; 
					else:
						if(($ofertaSeleccionada['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($ofertaSeleccionada['CompanyJobOffer']['company_name']=='')):
							echo $ofertaSeleccionada['Company']['CompanyProfile']['company_name'];
						else:
							echo 'Sin especificar';
						endif;
					endif;
				endif;
			endif;
		?>
			</center></p>	
	</div>
	<!-- columna datos -->
	<div class="col-md-5" style="margin-top: 5px;margin-bottom: 5px;">
		
		<?php
			$caracteres = strlen($ofertaSeleccionada['CompanyJobProfile']['id']);
			$faltantes = 5 - $caracteres;	
			if($faltantes > 0):
				$ceros = '';
				for($cont=0; $cont<=$faltantes;$cont++):
					$ceros .= '0';
				endfor;
				$folio = $ceros.$ofertaSeleccionada['CompanyJobProfile']['id'];
			else:
				$folio = strlen($ofertaSeleccionada['CompanyJobProfile']['id']);
			endif;
		?>
		<span><strong>Folio: </strong><?php echo $folio; ?></span><br />

		<?php  
			$texto = str_ireplace ( $this->Session->read('palabraBuscada'), '<strong style="font-size: 16px; font-weight: bold; color: #f28f3f;">'.$this->Session->read('palabraBuscada').'</strong>', $ofertaSeleccionada['CompanyJobProfile']['job_name']); 
			echo '<strong>Puesto: </strong><span style="font-size: 16px; font-weight: bold; color: #1a75bb;">'.$texto.'</span><br />';
		?> 
		
		<span><strong>Fecha publicación:</strong> <?= ' ' . date("d/m/Y",strtotime($ofertaSeleccionada['CompanyJobContractType']['created'])); ?> </span><br />
		<span><strong>Vigencia:</strong><?php  echo ' ' . date("d/m/Y",strtotime($ofertaSeleccionada['CompanyJobProfile']['expiration'])); ?> </span><br />
		
	<span><strong>Sueldo:</strong>
			<?php  
				if(isset($ofertaSeleccionada['CompanyJobContractType']['Salary']['salary'])):
					echo ' ' . $ofertaSeleccionada['CompanyJobContractType']['Salary']['salary'];
				else:
					echo 'Sin especificar';
				endif;
			?>
		</span><br />
		<span><strong>Lugar de trabajo:</strong><?php  echo ' ' . $ofertaSeleccionada['CompanyJobContractType']['state'] . ' ' . $ofertaSeleccionada['CompanyJobContractType']['subdivision'] ; ?> </span><br />
			<?php 
				$countLenguajes=count($ofertaSeleccionada['CompanyJobLanguage']);
				$listaIidomas = '';
				foreach($ofertaSeleccionada['CompanyJobLanguage'] as $k => $idoma):
					$listaIidomas .=  $idoma['Lenguage']['lenguage'];
					($countLenguajes>1) ? $listaIidomas .= ', ' : '';
					$countLenguajes--;
				endforeach;
				if($listaIidomas==''):
					$listaIidomas='No requerido';
				endif;
			?>
		<span><strong>Idioma: </strong><?php  echo $listaIidomas; ?> </span>		
	</div>
	<!-- columna columna opciones -->
	<div class="col-md-5" style="margin-top: 15px;">
		<center>
			<style type="text/css">
				.tooltip-inner {max-width: 150px; width: 150px; }
			</style>
		
			<div class="col-md-12">
				<!--Visto/noVisto -->
					<?php 
						$vista = 0;
						foreach($company['CompanyViewedOffer']as $k => $viewed):
							if($viewed['company_job_profile_id'] == $ofertaSeleccionada['CompanyJobProfile']['id']):
								$vista = 1;
								 break;
							endif;
						endforeach;
			
						if($vista == 1):
							echo $this->Html->image('student/visto.png',
										['title' => 'Oferta vista',
										'data-toggle'=>'tooltip',
										'data-placement'=>'left',
										'class' => 'icono']);						
						else:
							echo $this->Html->image('student/noVisto.png',
										['title' => 'Oferta no vista',
										'data-toggle'=>'tooltip',
										'data-placement'=>'left',
										'class' => 'icono']);
						endif;
					?>
				<!--Ver candidatos -->
				<?= $this->Html->image('student/lista.png',
									['title' => 'Ver candidatos dentro de oferta',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'url' => ['controller'=>'Companies',
											'action'=>'viewCandidateOffer',
											'?' => ['company_id' => $ofertaSeleccionada['Company']['id'],
													'editingAdmin' => 'yes',
													'id' => $ofertaSeleccionada['CompanyJobProfile']['id'],
													'editar' => 1,
													'nuevaBusqueda' => 'nuevaBusqueda']]]);?>
				<!--Editar oferta -->
				<?= $this->Html->image('student/lapiz.png',
									['title' => 'Editar oferta',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'url' => ['controller'=>'Companies',
											'action'=>'companyJobOffer',
											'?' => ['company_id' => $ofertaSeleccionada['Company']['id'],
													'editingAdmin' => 'yes',
													'id' => $ofertaSeleccionada['CompanyJobProfile']['id'],
													'editar' => 1]]]);?>
				<!--Vigencia oferta -->
				<?= $this->Html->image('student/visible.png',
									['title' => 'Cambiar vigencia de oferta',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'onclick' => 'saveVigencia('.$ofertaSeleccionada['CompanyJobProfile']['id'].',"'.$ofertaSeleccionada['CompanyJobProfile']['expiration'].'","'.$ofertaSeleccionada['CompanyJobProfile']['created'].'");',
									]);?>
				<!--Reportar contratación -->
				<?= $this->Html->image('student/contratado.png',
									['title' => 'Reportar contratación ',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'url' => ['controller'=>'Companies',
											'action'=>'studentReport',
											'?' => ['company_id' => $ofertaSeleccionada['Company']['id'],
													'id' => $ofertaSeleccionada['CompanyJobProfile']['id'],
													'editingAdmin' => 'yes']]]);?>
				<!--Estado Oferta -->
				<?php 
					if($ofertaSeleccionada['CompanyJobContractType']['status'] == null):
						echo $this->Html->image('student/noActiva.png',
									['title' => 'Oferta incompleta',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'onclick' => 'ofertaIncompleta();'
									]);	
					else:	
						if(strtotime($ofertaSeleccionada['CompanyJobProfile']['expiration']) < strtotime(date('Y-m-d'))):
							echo $this->Html->image('student/noActiva.png',
										['title' => 'Oferta expirada',
										'data-toggle'=>'tooltip',
										'data-placement'=>'left',
										'class' => 'icono',
									  'onclick' => 'ofertaExpirada();'
										]);	
						else:		
							if($ofertaSeleccionada['CompanyJobContractType']['status'] == 0):
								echo $this->Html->image('student/noActiva.png',
										['title' => 'Oferta inactiva',
										'data-toggle'=>'tooltip',
										'data-placement'=>'left',
										'class' => 'icono',
										'url' => [	'controller'=>'Companies',
													'action'=>'enableDisableOffer',
														'?' => ['id' => $ofertaSeleccionada['CompanyJobContractType']['id'],
																'estatus' => $ofertaSeleccionada['CompanyJobContractType']['status']]]]);
							else:
								echo $this->Html->image('student/activa.png',
										['title' => 'Oferta activa',
										'data-toggle'=>'tooltip',
										'data-placement'=>'left',
										'class' => 'icono',
										'url' => ['controller'=>'Companies',
												'action'=>'enableDisableOffer',
												'?' => ['id' => $ofertaSeleccionada['CompanyJobContractType']['id'],
														'estatus' => $ofertaSeleccionada['CompanyJobContractType']['status']]]]);
							endif;
						endif;
					endif;
				?>
				<!--Eliminar -->
				<?php echo $this->Html->image('student/eliminar.png',
					['title' => 'Eliminar oferta',
					'data-toggle'=>'tooltip',
					'data-placement'=>'left',
					'id' => 'focusOfferId'.$ofertaSeleccionada['CompanyJobProfile']['id'],
					'onclick' => 'deleteOffer('.$ofertaSeleccionada['CompanyJobProfile']['id'].');'
					]
				);
											
				 echo $this->Form->postLink(
										$this->Html->image('student/eliminar.png',
										array('alt' => 'Delete', 'title' =>'Eliminar oferta', 'style' => 'width: 20px; height: 20px; display: none','id'=>'deleteOfferId'.$ofertaSeleccionada['CompanyJobProfile']['id'] )), 
										array('action' => 'deleteOffer',$ofertaSeleccionada['CompanyJobProfile']['id']), 
										array('escape' => false) 
										);
				?>
			</div>
				<!-- Oferta completa-->
			<div class="col-md-12" style="margin-top: 10px;">
				<?= $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;Ver oferta completa', 
								['controller'=>'Companies',
								'action'=>'viewOfferOnline', $ofertaSeleccionada['CompanyJobProfile']['id']],
								['class' => 'btn btn btn-bti col-md-12',
								'escape' => false]); ?>
			</div>
		</center>
	</div>	
</div>

<?php endforeach; ?>
