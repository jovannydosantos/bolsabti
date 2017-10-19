<?php 
	foreach($ofertas as $k => $oferta):
?>
	<div class="col-md-12 sombra" style="border: 1px solid #1a75bb; margin-bottom: 15px; background: url('/bolsabti/img/satinweave.png');">    
	
		<div class="col-md-2 visible-lg visible-md" style="margin-top: 1%; padding-left: 0px; padding-right: 0px;">
			<?php
				$url = WWW_ROOT.'img/uploads/company/filename/'.$oferta['Company']['filename'];
				if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') || (!isset($oferta)) || (!isset($oferta['Company']['filename']) || (!file_exists( $url )) || (($oferta['Company']['filename'] == '')))):
					echo $this->Html->image('company/imagenNoDisponible.png',['style'=>'width:100%; height: 100%; ' ]);
				else:
					echo $this->Html->image('uploads/company/filename/'.$oferta['Company']['filename'],['style'=>'width:100%; height: 100%; image-rendering: pixelated;' ]);
				endif;
			?>	
			<p><center>
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
			</center></p>
			<center><span><strong>RFC: </strong><?= $oferta['Company']['CompanyProfile']['rfc'].'</span>'; ?></span><br /></center>	
		</div>
	
		<div class="col-md-6" style="margin-top: 5px;margin-bottom: 5px;">
			
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
			<span><strong>Folio: </strong><?php echo $folio; ?></span><br />

			<?php  
				$texto = str_ireplace ( $this->Session->read('palabraBuscada'), '<strong style="font-size: 16px; font-weight: bold; color: #f28f3f;">'.$this->Session->read('palabraBuscada').'</strong>', $oferta['CompanyJobProfile']['job_name']); 
				echo '<strong>Puesto: </strong><span style="font-size: 16px; font-weight: bold; color: #1a75bb;">'.$texto.'</span><br />';
			?> 
			
			<span><strong>Número de vacantes: </strong><?= $oferta['CompanyJobProfile']['vacancy_number']; ?></span><br />
			<span><strong>Fecha publicación:</strong> <?= ' ' . date("d/m/Y",strtotime($oferta['CompanyJobContractType']['created'])); ?> </span><br />
			<span><strong>Fecha de actualización: </strong><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyLastUpdate']['modified'])); ?> </span><br />
			<span><strong>Vigencia:</strong><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyJobProfile']['expiration'])); ?> </span><br />
			<span><strong>Responsable de la oferta:</strong></span><br />
				
				 <?php 
					if($oferta['CompanyJobOffer']['same_contact']=='n'):
						echo '<span>-Nombre:</strong>' . $oferta['CompanyJobOffer']['responsible_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_last_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_second_last_name'].'</span><br />';
						echo '<span> -Tel.:</strong> (' . $oferta['CompanyJobOffer']['responsible_long_distance_cod'] .') '. $oferta['CompanyJobOffer']['responsible_telephone'] . ' ';
						if($oferta['CompanyJobOffer']['responsible_phone_extension']<>''):
							echo ' - ext. '.$oferta['CompanyJobOffer']['responsible_phone_extension'];
						endif;
						echo '</span><br />';
						if($oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']<>''):
							echo '<span><strong> -Cel.: </strong>('.$oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']. ') ' .$oferta['CompanyJobOffer']['responsible_cell_phone'].'</span><br />';
						endif;	
					else:
						echo '<span><strong> -Nombre:</strong>' . $oferta['Company']['CompanyContact']['name']. ' ' .  $oferta['Company']['CompanyContact']['last_name']. ' ' .  $oferta['Company']['CompanyContact']['second_last_name'].'</span><br />';
						echo '<span><strong> -Tel.:</strong> (' . $oferta['Company']['CompanyContact']['long_distance_cod'] .') '. $oferta['Company']['CompanyContact']['telephone_number'];
						if($oferta['Company']['CompanyContact']['phone_extension']<>''):
							echo '- ext. </span> '.$oferta['Company']['CompanyContact']['phone_extension'];
						endif;
						echo '</span><br />';
						if(($oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']<>'') and ($oferta['Company']['CompanyContact']['cell_phone']<>'')):
							echo '<span><strong> -Cel.:</strong> ('.$oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']. ') ' .$oferta['Company']['CompanyContact']['cell_phone'].'</span><br />';
						endif;
					endif;
					?>		
				</span>
		</div>
	
		<div class="col-md-4" style="margin-top: 15px;"><center>
			
			<style type="text/css">
				.tooltip-inner {max-width: 150px; width: 150px; }
			</style>

			<div class="col-md-12">
				<?php 
					if($oferta['CompanyJobContractType']['status'] == null):
						echo $this->Html->image('student/noActiva.png',
									['title' => 'Oferta incompleta',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'onclick' => 'ofertaIncompleta();']);	
					else:	
						if(strtotime($oferta['CompanyJobProfile']['expiration']) < strtotime(date('Y-m-d'))):
							echo $this->Html->image('student/noActiva.png',
										['title' => 'Oferta expirada',
										'data-toggle'=>'tooltip',
										'data-placement'=>'left',
										'class' => 'icono',
										'onclick' => 'ofertaExpirada();']);	
						else:		
							if($oferta['CompanyJobContractType']['status'] == 0):
								echo $this->Html->image('student/noActiva.png',
										['title' => 'Oferta inactiva',
										'data-toggle'=>'tooltip',
										'data-placement'=>'left',
										'class' => 'icono',
										'url' => [	'controller'=>'Administrators',
													'action'=>'enableDisableOffer',
														'?' => ['id' => $oferta['CompanyJobContractType']['id'],
																'estatus' => $oferta['CompanyJobContractType']['status']]]]);
							else:
								echo $this->Html->image('student/activa.png',
										['title' => 'Oferta activa',
										'data-toggle'=>'tooltip',
										'data-placement'=>'left',
										'class' => 'icono',
										'url' => ['controller'=>'Administrators',
												'action'=>'enableDisableOffer',
												'?' => ['id' => $oferta['CompanyJobContractType']['id'],
														'estatus' => $oferta['CompanyJobContractType']['status']]]]);
							endif;
						endif;
					endif;
				?>

				<?= $this->Html->image('student/lista.png',
									['title' => 'Ver candidatos dentro de oferta',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'url' => ['controller'=>'Companies',
											'action'=>'viewCandidateOffer',
											'?' => ['company_id' => $oferta['Company']['id'],
													'editingAdmin' => 'yes',
													'id' => $oferta['CompanyJobProfile']['id'],
													'editar' => 1,
													'nuevaBusqueda' => 'nuevaBusqueda']]]);?>

				<?= $this->Html->image('student/lapiz.png',
									['title' => 'Editar oferta',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'url' => ['controller'=>'Companies',
											'action'=>'companyJobOffer',
											'?' => ['company_id' => $oferta['Company']['id'],
													'editingAdmin' => 'yes',
													'id' => $oferta['CompanyJobProfile']['id'],
													'editar' => 1]]]);?>

				<?= $this->Html->image('student/visible.png',
									['title' => 'Cambiar vigencia de oferta',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'onclick' => 'saveVigencia('.$oferta['CompanyJobProfile']['id'].',"'.$oferta['CompanyJobProfile']['expiration'].'","'.$oferta['CompanyJobProfile']['created'].'");',
									]);?>

				<?= $this->Html->image('student/contratado.png',
									['title' => 'Reportar contratación ',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'url' => ['controller'=>'Companies',
											'action'=>'studentReport',
											'?' => ['company_id' => $oferta['Company']['id'],
													'id' => $oferta['CompanyJobProfile']['id'],
													'editingAdmin' => 'yes']]]);?>

				<?= $this->Html->link($this->Html->image('student/descargar.png',['class' => 'icono','style'=>'width: 22px; height:22px']),
								['controller' => 'Companies', 
								'action' => 'viewOnlyOfferPdf',$oferta['CompanyJobProfile']['id'],
								'?'=>['editingAdmin' => 'yes',
									  'id' => $oferta['CompanyJobProfile']['id']]], 
								['target' => '_blank','escape' => false,
								'title' => 'Descargar oferta en PDF',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left']);
				?>

				<?php 
					 echo $this->Html->image('student/eliminarAzul.png',
									['title' => 'Eliminar oferta',
									'style' => 'cursor: pointer;',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'id' => 'focusStudentId'.$oferta['CompanyJobProfile']['id'],
									'onclick' => 'deleteRegister('.$oferta['CompanyJobProfile']['id'].',"'.$oferta['CompanyJobProfile']['job_name'].'");']);
							
					 echo $this->Form->postLink(
											$this->Html->image('student/eliminar.png',
											array('alt' => 'Delete', 'title' =>'Eliminar oferta', 'style' => 'width: 20px; height: 20px; display: none','id'=>'deleteStudentId'.$oferta['CompanyJobProfile']['id'] )), 
											array('action' => 'deleteOffer',$oferta['CompanyJobProfile']['id']), 
											array('escape' => false) );?>
			</div>

			<div class="col-md-12" style="margin-top: 15px;">
				<?= $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;Ver oferta completa', 
								['controller'=>'Companies',
								'action'=>'viewOfferOnline',
								'?'=>['company_id' => $oferta['Company']['id'],
									'editingAdmin' => 'yes',
									'id' => $oferta['CompanyJobProfile']['id']]],
								['class' => 'btn btn btn-bti col-md-12',
								'escape' => false]); ?>
			</div>

			<div class="col-md-12" style="margin-top: 15px; text-align: left;" >
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
					echo $this->Html->link('Entrevistas telefónicas: '.$totalTelefonicasOferta, 
											['controller'=>'Administrators',
											'action'=>'searchStudentOffer',
													'?' => array(
															'companyJobProfileId' => $oferta['CompanyJobProfile']['id'],
															'option' => 1,
															'totalStudents' => $totalTelefonicasOferta,
															'newSearch' => 'nuevaBusqueda',
															'historyCompanyId' => $oferta['Company']['id'],
															'volver' => 'searchOffer',
															
													)
												],
											array(
												'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
												'escape' => false)	
					); 	
				else: 
					echo $this->Html->link('Entrevistas telefónicas: '.$totalTelefonicasOferta, '',
															array(
																'onclick' => 'return SinCandidatos();',
																'id' => 'filtroBotonId1',
																'style' => 'margin-top: 5px; color:#2D3881; text-decoration: underline;',
																)	
					); 	
				endif;
				?> 
				<br />
				
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
					echo $this->Html->link('Entrevistas presenciales: '.$totalPresencialesOferta, 
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
				<br />
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
					echo $this->Html->link('Contrataciones: '.$totalContratados, 
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
				<br />
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
			</div>

			</center>
		</div>
		
	</div>

<?php endforeach; ?>
