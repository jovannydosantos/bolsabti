	<?php 
		$this->layout = 'company'; 
	?>
	<script>
		function validateEmpty(){
			selectedIndex = document.getElementById("CompanyCriterio").selectedIndex;
			if(document.getElementById('CompanyBuscar').value == ''){
				jAlert('Ingrese el nombre de la empresa, puesto ó folio a buscar', 'Mensaje');
				document.getElementById('CompanyBuscar').focus();
				return false;
			} else 
			if(selectedIndex == 0){
				jAlert('Seleccione el criterio de búsqueda', 'Mensaje');
				document.getElementById('CompanyCriterio').focus();
				return false;
			}else {
				return true;
			}
		}
	</script>
	
	<?php 
		echo $this->Session->flash();
		$paginator = $this->Paginator;
	?>

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
									'action' => 'companyPostullation',
									'onsubmit' =>'return validateEmpty();'
					)); ?>		
				<fieldset>
					<div class="col-md-6" style="padding-right: 0px;">
					<?php echo $this->Form->input('Buscar', array(
															'before' => '<div class="col-md-12" style="padding-left: 0px;">',
															'label' =>'',
															'value'	=> $this->Session->read('palabraBuscada'), 
															'placeholder' => 'Nombre de la empresa / Puesto / Folio',
															
					));	?>
					</div>
					<div  class="col-md-4" style="padding-left: 0px; padding-right: 0px;">
					<?php 	$options = array('1' => 'Nombre de la empresa', '2' => 'Puesto', '3' => 'Folio');
							echo $this->Form->input('criterio', array(
													'type'=>'select',
													'before' => '<div class="col-md-12" style="padding-left: 0px;">',
													'label' =>'',
													'label' =>'',
													'selected' => $this->Session->read('tipoBusqueda'),
													'options' => $options,'default'=>'0', 'empty' => 'Criterio de búsqueda'
							)); ?>
					</div>
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
			  		</div>
				</fieldset>
			</div>
	
	<?php if(isset($ofertas)): 
					if(empty($ofertas)):
						echo '<div class="col-md-9"  style="padding-left: 0px; margin-left: 15px">';
							echo '<p style="font-size: 22px; ">Sin resultados</p>';
						echo '</div>';
					else:
	?>
		
	<div class="col-md-8 col-md-offset-1" style="max-height: 450px; width:720px; overflow-y: auto; margin-top: 50px; font-size: 12px;">
			
		<?php 
			foreach($ofertas as $k => $oferta):
		?>
		<div class="col-md-12" style="margin-bottom: 10px;">
			<div class="col-md-8"  style="color: #FFB71F; margin-top: 7px;">
				<?php  
					$texto = str_ireplace ( $this->Session->read('palabraBuscada'), '<strong style="font-size: 14px; color: #93B2FF">'.$this->Session->read('palabraBuscada').'</strong>', $oferta['CompanyJobProfile']['job_name']); 
				?> 
				<b><?php echo $texto; ?></b> 
				/
				<?php if($oferta['CompanyJobContractType']['status'] == 1): ?>
					<b>Activa</b>
				<?php else: 
							if($oferta['CompanyJobContractType']['status'] == 2):?>
								<b>Inactiva</b>
					<?php   else: ?>
								<b>Sin especificar</b>
					<?php 	endif; ?>
				<?php endif; ?>
				/
				<?php if($oferta['CompanyJobProfile']['expiration']<>''): ?>
					<b><?php echo  date("d-m-Y",strtotime($oferta['CompanyJobProfile']['expiration'])); ?></b> 
				<?php endif; ?>
				
				<?php if(!empty($oferta['Application'])): ?>
					<b>  <?php echo  '('.count($oferta['Application']).')'; ?>  </b> 
				<?php else: ?>	
					<b>  <?php echo  '(0)'; ?>  </b> 
				<?php endif; ?>
				
			</div>
			<div class="col-md-3" >
				<?php 
						if(!empty($oferta['Application'])):
							echo $this->Html->link(
												'Descargar Postulados  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
														array(
																'controller'=>'Companies',
																'action'=>'results_search_excel',$oferta['CompanyJobProfile']['id'],$oferta['CompanyJobProfile']['job_name'],
															),
															array(
																'class' => 'btn btn-default btnBlue ',
																'style' => 'width: 200px; font-size: 12px;',
																'escape' => false,
																)	
											); 
						else:
							echo $this->Html->link(
													'Descargar Postulados  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-ban-circle"></i>', 
														array(
																'#' => ''
															),
															array(
																'title' => 'Sin postulados',
																'class' => 'btn btn-default btnBlue ',
																'style' => 'width: 200px; cursor: not-allowed; font-size: 12px;',
																'escape' => false,
																)	
											); 	
						
						endif;
						
						
				?> 
			</div>
		</div>
		
		<?php 
			endforeach;
		?>
	</div>
	
	<?php 			
		endif;
		endif; 
	?>
	
	<div class="col-md-8 col-md-offset-1" style="margin-top: 30px;">
		<?php 
			if(!empty($ofertas)):
		?>
			<p style="margin-left: 30px; font-size: 14px;">
				<?php echo $this->Paginator->counter(
													array('format' => 'Total de ofertas {:count}')
													); 
				?>
			</p>
		<?php 
			endif;
		?>
	</div>