<?php 
	foreach($ofertas as $k => $oferta):
?>
	<div class="col-md-10 col-md-offset-1 sombra" style="border: 1px solid #1a75bb; margin-bottom: 15px; background: url('/bolsabti/img/satinweave.png');">    
	
		<div class="col-md-2 visible-lg visible-md" style="margin-top: 3%; padding-left: 0px; padding-right: 0px;">
			<?php
				$url = WWW_ROOT.'img/uploads/company/filename/'.$oferta['Company']['filename'];
				if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') || (!isset($oferta)) || (!isset($oferta['Company']['filename']) || (!file_exists( $url )) || (($oferta['Company']['filename'] == '')))):
					echo $this->Html->image('company/imagenNoDisponible.png',
												['style'=>'width:100%; height: 100%; ' ]);
				else:
					echo $this->Html->image('uploads/company/filename/'.$oferta['Company']['filename'],
												['style'=>'width:100%; height: 100%; image-rendering: pixelated;' ]);

				endif;
			?>			
		</div>
	
		<div class="col-md-6" style="margin-top: 15px;">
			<span style="font-size: 16px; font-weight: bold; color: #1a75bb;">	
				<?php  
					$texto = str_ireplace ( $this->Session->read('palabraBuscada'), '<strong style="font-size: 16px; font-weight: bold; color: #f28f3f;">'.$this->Session->read('palabraBuscada').'</strong>', $oferta['CompanyJobProfile']['job_name']); 
					echo $texto;
				?> 
			</span><br />

			<span style="font-size: 12px; font-weight: bold; color: #000;">
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
			</span><br />

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
			<span><strong>Folio:</strong><?php echo $folio; ?></span><br />
			<span><strong>Fecha publicación:</strong> <?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyJobContractType']['created'])); ?> </span><br />
			
			<span><strong>Sueldo:</strong>
				<?php  
					if(isset($oferta['CompanyJobContractType']['Salary']['salary'])):
						echo ' ' . $oferta['CompanyJobContractType']['Salary']['salary'];
					else:
						echo 'Sin especificar';
					endif;
				?>
			</span><br />
			<span><strong>Lugar de trabajo:</strong><?php  echo ' ' . $oferta['CompanyJobContractType']['state'] . ' ' . $oferta['CompanyJobContractType']['subdivision'] ; ?> </span><br />
				<?php 
					$countLenguajes=count($oferta['CompanyJobLanguage']);
					$listaIidomas = '';
					foreach($oferta['CompanyJobLanguage'] as $k => $idoma):
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
	
		<div class="col-md-4" style="margin-top: 30px;"><center>
			
			<style type="text/css">
				.tooltip-inner {max-width: 150px; width: 150px; }
			</style>

			<div class="col-md-12">
				<?php 
					$vista = 0;
					foreach($oferta['StudentViewedOffer'] as $k => $viewed):
						if($viewed['student_id'] == ($this->Session->read('student_id'))):
							$vista = 1;
							 break;
						endif;
					endforeach;

					if($vista == 0):
						echo $this->Html->image('student/noVisto.png',
								['title' => 'Oferta no vista',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono']); 
					else:
						echo $this->Html->image('student/visto.png',
								['title' => 'Oferta vista',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono']); 
					endif;
				?>
				
				<?php 
					$postulado = 0;
					foreach($oferta['Application'] as $k => $application):
						if($application['student_id'] == ($this->Session->read('student_id'))):
							$postulado = 1;
							 break;
						endif;
					endforeach;
	
					if($postulado == 0):
						echo $this->Html->image('student/noPostulado.png',
							   ['title' => 'Postularme',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',
								'url' => [	'controller'=>'Students',
											'action'=>'postullation', $oferta['CompanyJobProfile']['id'] ]]);	
					else:
						echo $this->Html->image('student/postulado.png',
								['title' => 'Postulado',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',]);
					endif;
				?>
				
				<?php 
					$guardado = 0;
					foreach($oferta['StudentSavedOffer'] as $k => $saveOffer):
						if($saveOffer['student_id'] == ($this->Session->read('student_id'))):
							$guardado = 1;
							break;
						endif;
					endforeach;
	
					if($guardado == 0):
						echo $this->Html->image('student/noGuardado.png',
								['title' => 'Guardar oferta',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'onclick' => 'saveOffer('.$oferta['CompanyJobProfile']['id'].',"searchOffer");',
								'class' => 'icono',]);
					else:
						echo $this->Html->image('student/guardado.png',
								['title' => 'Oferta guardada en '.$oferta['StudentFolder'][0]['name'],
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',]);
					endif;
				?>
				
				<?php 
					$reportado = 0;
					foreach($oferta['Report'] as $k => $ofertaReportada):
						if(($ofertaReportada['student_id'] == ($this->Session->read('student_id')) AND ($ofertaReportada['registered_by'] =='student' ))):
							$reportado = 1;
							break;
						endif;
					endforeach;
	
					if($reportado == 0):
						echo $this->Html->image('student/noContratado.png',
								['title' => 'Reportar contratación ',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',
								'url' => ['controller'=>'Students',
										'action'=>'report', $oferta['CompanyJobProfile']['id'] ]]
						);
					else:
						echo $this->Html->image('student/contratado.png',
								['title' => 'Contratación reportada ',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',]);
					endif;
				?>
				
				<?php 
					echo $this->Html->link($this->Html->image('student/noDescargado.png', 
								['escape' => false,'style' => 'width: 17px; height: 20px; margin-right: 6px; cursor: pointer; ']),
								['controller' => 'Students', 
								'action' => 'viewOnlyOfferPdf',$oferta['CompanyJobProfile']['id']], 
								['target' => '_blank','escape' => false,
								'title' => 'Descargar oferta en PDF',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',]);
				?>
			</div>

			<div class="col-md-12" style="margin-top: 10px; margin-bottom: 15px;">
			<?= $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;Ver oferta completa', 
								['controller'=>'Students',
								'action'=>'viewOffer', $oferta['CompanyJobProfile']['id']],
								['class' => 'btn btn btn-bti col-md-12',
								'escape' => false]); ?>
			<?php 
				$reportada = true;
				foreach ($oferta['Report'] as $reporte) {
					if($reporte['student_id']==$this->Session->read('Auth.User.id')):
						$reportada = false;
					endif;
				}
				
				if($reportada): ?>
					<?= $this->Html->link('<i class="glyphicon glyphicon-ok-sign"></i>&nbsp;&nbsp;Reportar oferta', 
										'#',
										['class' => 'btn btn-info col-md-12',
										'style' => 'margin-top: 5px;',
										'onclick' =>"openModalReporte('".$oferta['CompanyJobProfile']['id']."');",
										'escape' => false]); ?>
			<?php else: ?>
				<div class="col-md-12" style="margin-top: 10px;">
					<label>Oferta reportada</label>
				</div>
			<?php endif; ?>

			</div></center>
		</div>
		
	</div>

<?php endforeach; ?>