<?php 
	foreach($empresas as $k => $empresa):
?>
	<div class="col-md-10 col-md-offset-1 sombra" style="border: 1px solid #1a75bb; margin-bottom: 15px; background: url('/bolsabti/img/satinweave.png');">    
	
		<div class="col-md-2 visible-lg visible-md" style="margin-top: 2%; padding-left: 0px; padding-right: 0px;">
			<?php
				$url = WWW_ROOT.'img/uploads/company/filename/'.$empresa['Company']['filename'];
				if( (!isset($empresa)) || (!isset($empresa['Company']['filename']) || (!file_exists( $url )) || (($empresa['Company']['filename'] == '')))):
					echo $this->Html->image('company/imagenNoDisponible.png',['style'=>'width:100%; height: 100%; ' ]);
				else:
					echo $this->Html->image('uploads/company/filename/'.$empresa['Company']['filename'],['style'=>'width:100%; height: 100%; image-rendering: pixelated;' ]);
				endif;
			?>	
			<center><span><strong><?= '<span>'.$empresa['CompanyProfile']['company_name'].'</span><br>'; ?></strong></span></center>	
			<center><span><strong>RFC: </strong><?= $empresa['CompanyProfile']['rfc'].'</span>'; ?></span></center>			
		</div>
	
		<div class="col-md-6" style="margin-top: 2%;margin-bottom: 15px">
			<span><strong>Usuario: </strong><?= $empresa['Company']['username']; ?></span><br />
			<span><strong>Razón social: </strong><?= $empresa['CompanyProfile']['social_reason']; ?></span><br />
			<span><strong>Fecha de registro: </strong><?= ' ' . date("d/m/Y",strtotime($empresa['Company']['created'])); ?> </span><br />
			<span><strong>Fecha de último movimiento:</strong>
			<?php  
				if(empty($empresa['CompanyLastUpdate'])):
					echo ' ' . date("d/m/Y",strtotime($empresa['Company']['created'])); 
				else:
					echo ' ' . date("d/m/Y",strtotime($empresa['CompanyLastUpdate'][0]['modified'])); 
				endif;
			?></span><br />
			<span><strong>Contacto de la empresa:</strong>
			<span><br />
			<?php
				if($empresa['CompanyContact']['name']==null):
					echo '<span><strong> - Nombre: </strong> Sin especificar </span><br />';
					echo '<span><strong> - Tel.: </strong>Sin especificar </span><br />';
					echo '<span><strong> - Cel.: </strong> Sin especificar </span><br />';
					echo '<span><strong> - Correo: </strong> Sin especificar</span><br />';
				else:
					echo '<span><strong> - Nombre: </strong>' . $empresa['CompanyContact']['name']. ' ' .  $empresa['CompanyContact']['last_name']. ' ' .  $empresa['CompanyContact']['second_last_name'].'<span><br />';
					echo '<span><strong> - Tel.: </strong> (' . $empresa['CompanyContact']['long_distance_cod'] .') '. $empresa['CompanyContact']['telephone_number'] . '<span><br />';
					if($empresa['CompanyContact']['phone_extension']<>''):
						echo '<span><strong> - ext. </strong> '.$empresa['CompanyContact']['phone_extension'].'<span><br />';
					endif;
					if(($empresa['CompanyContact']['long_distance_cod_cell_phone']<>'') and ($empresa['CompanyContact']['cell_phone']<>'')):
						echo '<span><strong> - Cel.: </strong> ('.$empresa['CompanyContact']['long_distance_cod_cell_phone']. ') ' .$empresa['CompanyContact']['cell_phone'] .'<span><br />';
					endif;
					echo '<span><strong> - Correo: </strong> '.$empresa['Company']['email'].'<span><br />';
				endif;
			  ?>
			</span>
		</div>
	
		<div class="col-md-4" style="margin-top: 15px;"><center>
			
			<style type="text/css">
				.tooltip-inner {max-width: 150px; width: 150px; }
			</style>

			<div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
		
				<?php 
					if(($empresa['CompanyOfferOption']['id']==null) OR ($empresa['Company']['status'] == 0) OR (strtotime($empresa['CompanyOfferOption']['end_date_company']) < strtotime(date('Y-m-d')))):
						$ruta='student/noActiva.png';
					else:
						$ruta='student/activa.png';
					endif;

					echo $this->Html->image($ruta,
								['title' => 'Empresa / Institución inactiva click para activar',
								'style' => 'width: 20px; height: 20px; margin-right: 3px;',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',
								'url' => ['controller'=>'Administrators','action'=>'enableDisableCompany',
								'?' => ['id' => $empresa['Company']['id'],'estatus' => $empresa['Company']['status']]]]);
				?>
				
				<?php 
					echo $this->Html->image('administrator/r.png',
								['title' => 'Editar lineamientos de publicación y descarga de cv´s',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',
								'style' => 'width: 20px; height: 20px; margin-right: 3px;',
								'url' => ['controller'=>'Administrators','action'=>'companyOfferOption',$empresa['Company']['id']]]);
				?>
				
				<?php 
					echo $this->Html->image('student/lapiz.png',
								['title' => 'Editar Empresa/Institución',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',
								'style' => 'width: 20px; height: 20px; margin-right: 3px;',
								'url' => ['controller'=>'Companies','action'=>'companyContact',
								'?' => ['company_id' => $empresa['Company']['id'],'editingAdmin' => 'yes']]]);
				?>
				
				<?php 
					echo $this->Html->image('administrator/candado.png',
								['title' => 'Actualizar contraseña',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',
								'onclick' => 'updatePasswordCompany('.$empresa['Company']['id'].',"'.$empresa['Company']['email'].'","");',
								'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 3px;']);	
				?>
				
				<?php 
					echo $this->Html->image('administrator/arroba.png',
								['title' => 'Enviar correo',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',
								'onclick' => 'saveEmailNotification("'.$empresa['Company']['email'].'");',
								'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 3px;']);	
				?>
				
				<?php 
					echo $this->Html->image('administrator/clock.png',
								['title' => 'Historial de la Empresa/Institución',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',
								'style' => 'width: 20px; height: 20px; margin-right: 3px;',
								'url' => ['controller'=>'Administrators','action'=>'companyHistory',
								'?' => ['id' => $empresa['Company']['id'],'newSearch' => 'nuevaBusqueda']]]);
				?>

				<?php 
					echo $this->Html->image('administrator/contratado.png',
								['title' => 'Reportar contratación',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',
								'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 3px;',
								'url' => ['controller'=>'Companies','action'=>'studentReport','nuevaBusqueda',
								'?' => ['company_id' => $empresa['Company']['id'], 'editingAdmin' => 'yes']]]);
				?>
				
				<?php 
					 echo $this->Html->image('administrator/eliminar.png',
								['title' => 'Eliminar Empresa/Institución',
								'style' => 'cursor:pointer; width: 20px; height: 20px;',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',
								'id' => 'focusStudentId'.$empresa['Company']['id'],
								'onclick' => 'deleteRegister('.$empresa['Company']['id'].',"'.$empresa['CompanyProfile']['company_name'].'");']);
							
					 echo $this->Form->postLink($this->Html->image('student/eliminar.png',
								array('alt' => 'Eliminar universitario', 'title' =>'Eliminar universitario', 'style' => 'width: 20px; height: 20px; display: none','id'=>'deleteStudentId'.$empresa['Company']['id'] )), 
								array('action' => 'deleteCompany',$empresa['Company']['id']), 
								array('escape' => false));
				?>

			</div>
		</center></div>
	
		<div class="col-md-4" style="margin-top: 15px; text-align: center;">
			
			<span><strong>Ofertas a publicar: </strong><?php echo ($empresa['CompanyOfferOption']['max_offer_publication']<>null) ? $empresa['CompanyOfferOption']['max_offer_publication'] : '0'; ?>
				<?php echo (!empty($empresa['CompanyJobProfile'])) ? '('.count($empresa['CompanyJobProfile']).')' : ''; ?>
			</span><br />
			<span><strong>Curriculums a extraer: </strong><?php echo ($empresa['CompanyOfferOption']['max_cv_download']<>null) ? $empresa['CompanyOfferOption']['max_cv_download'] : '0'; ?>
				<?php echo (!empty($empresa['CompanyDownloadedStudent'])) ? '('.count($empresa['CompanyDownloadedStudent']).')' : ''; ?>
			</span>
			
			<div class="col-md-12" style="margin-top: 15px;">
			<?= $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;Ver registro completo', 
								['controller'=>'Companies',
								'action'=>'companyContact',
								'?'=> ['company_id' => $empresa['Company']['id'],'editingAdmin' => 'yes']],
								['class' => 'btn btn btn-bti col-md-12',
								'escape' => false]); ?>
				
			</div>
		</div>
	
	</div>
<?php endforeach; ?>