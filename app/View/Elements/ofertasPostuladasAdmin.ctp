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
			<?php
				if(!empty($oferta['CompanyLastUpdate']['Administrator'])):
					$administrador = ' por: '.$oferta['CompanyLastUpdate']['Administrator']['AdministratorProfile']['contact_name'].' '.$oferta['CompanyLastUpdate']['Administrator']['AdministratorProfile']['contact_last_name'];
				else:
					$administrador = '';
				endif;
			?>
			<span><strong>Fecha de actualización: </strong><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyLastUpdate']['modified']));  echo $administrador; ?> </span><br />
			<span><strong>Fecha de postulación: </strong><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyJobContractType']['created'])); ?> </span><br />
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

				<?= $this->Html->image('student/postulado.png',
									['title' => 'Ver postulaciones de la oferta',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'url' => ['controller'=>'Companies',
											'action'=>'viewCandidateOffer','nuevaBusqueda',
											'?' => ['id' => $oferta['CompanyJobProfile']['id'], 
													'tipoBusqueda' => 4,
													'company_id' => $oferta['Company']['id'], 
													'editingAdmin' => 'yes',]]]);?>

				<?php 
				// Envia a reportar contrataciones por el alumno
					$reportado = 0;
					foreach($oferta['Report'] as $k => $ofertaReportada):
						if(($ofertaReportada['student_id'] == ($this->Session->read('student_id')) AND ($ofertaReportada['registered_by'] =='student' ))):
							$reportado = 1;
							break;
						endif;
					endforeach;
					
					if($reportado == 0):
						echo $this->Html->image('student/noContratado.png',
									['title' => 'Reportar contratación por el alumno',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'url' => ['controller'=>'Students',
											'action'=>'report',$oferta['CompanyJobProfile']['id'],
											'?' => ['student_id' => $this->Session->read('student_id'), 
													'editingAdmin' => 'yes']]]);
					else:
						echo $this->Html->image('student/contratado.png',
							array(
								'title' => 'Contratación ya reportada por alumno',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',
								'style' => 'width: 20px; height: 20px; margin-right: 6px;',
							));
					endif;
				?>			

				<?php 
					 echo $this->Html->image('student/eliminarAzul.png',
									['title' => 'Eliminar oferta',
									'style' => 'wcursor: pointer;',
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

			<div class="col-md-12" style="margin-top: 15px;margin-bottom: 15px;">
				<?= $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;Ver oferta completa', 
								['controller'=>'Companies',
								'action'=>'viewOfferOnline',
								'?'=>['company_id' => $oferta['Company']['id'],
									'editingAdmin' => 'yes',
									'id' => $oferta['CompanyJobProfile']['id']]],
								['class' => 'btn btn btn-bti col-md-12',
								'escape' => false]); ?>
			</div>

			<span><strong>Guardada por usuario:</strong>
				<?php 
					$guardado = 0;
					foreach($oferta['StudentSavedOffer'] as $k => $saveOffer):
						if($saveOffer['student_id'] == ($this->Session->read('student_id'))):
							$guardado = 1;
							 break;
						endif;
					endforeach;
	
					if($guardado == 0):
						echo 'No';
					else:
						echo 'Si';
					endif;
				?>
			</span>

			</center>
		</div>
		
	</div>

<?php endforeach; ?>
