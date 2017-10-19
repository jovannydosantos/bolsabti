<?php 
	$this->layout = 'administrator'; 
?>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#CompanyJobProfileExpirationYear').prepend('<option value="" selected>AAAA</option>');
			$('#CompanyJobProfileExpirationMonth').prepend('<option value="" selected>MM</option>');
			$('#CompanyJobProfileExpirationDay').prepend('<option value="" selected>DD</option>');
			 
			typeSearch();
			$('.selectpicker').selectpicker('refresh');
		});	
		
		function validateEmpty(){
			var selectedIndex = document.getElementById("CompanyCriterio").selectedIndex;
			var palabraBuscar = document.getElementById('CompanyBuscar').value ;
			
			if(selectedIndex == 0){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione el criterio de búsqueda.'});
				return false;
			}else 
			if(palabraBuscar == ''){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese texto a buscar.'});
				return false;
			}else {
				return true;
			}
		}
	
		function typeSearch(){
			selectedIndexTypeSearch = document.getElementById("CompanyCriterio").selectedIndex;
			
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
		
	</script>
	
	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">Buscar ofertas:</p>
    </blockquote>

    <div class="col-md-12">
		<?= $this->Form->create('Administrator', [
									'class' => 'form-horizontal', 
									'role' => 'form',
									'id' => 'sendPaginadoForm',
									'inputDefaults' => [
										'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
										'div' => ['class' => 'form-group'],
										'class' => 'form-control',
										'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
										'between' => '<div class="col-md-12">',
										'after' => '</div>',
										'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
									],
									'action' => 'searchOffer',
									'onsubmit' =>'return validateEmpty();']); ?>
		
		<fieldset>
			<div class="col-md-4">
				<?php $options = array('8' => 'RFC','9' => 'Nombre de empresa o institución','10' => 'Puesto', '11' => 'Nombre contacto', '12' => 'Correo electrónico del Responsable de la Oferta'); ?>
				<?= $this->Form->input('Company.criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusquedaAdmin'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda','onchange' => 'typeSearch()']); ?>
			</div>

			<div class="col-md-5" id="idDivBuscar">
				<?= $this->Form->input('Company.Buscar', ['placeholder' => 'Buscar...','value'	=> $this->Session->read('palabraBuscadaAdmin'),]); ?>
			</div>

			<div class="col-md-2 text-center" style="margin-top: 6px;">
				<?= $this->Form->button('Buscar <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary col-md-12','escape' => false,'id' => 'idBucar',]);?>
				<?= $this->Form->end(); ?>
			</div>	
		</fieldset>
	</div>

	<div class="col-md-12">
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
	        <p style="color: #588BAD">Filtrar todas las ofertas por:</p>
	    </blockquote>
		<div class="col-md-12">
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
			<div class="btn-group">				
				<?= $this->Html->link('Activas', [ 'controller'=>'Administrators','action'=>'searchOffer','?' => ['tipoBusqueda' => 4]],
												['class' => 'btn btn-info ','style' => 'width: 130px;' . $seleccionado10]); ?> 
			</div>
			<div class="btn-group">				
				<?= $this->Html->link('Por expirar', [ 'controller'=>'Administrators','action'=>'searchOffer','?' => ['tipoBusqueda' => 5]],
												['class' => 'btn btn-info ','style' => 'width: 130px;' . $seleccionado20]); ?> 
			</div>
			<div class="btn-group">				
				<?= $this->Html->link('Expiradas', [ 'controller'=>'Administrators','action'=>'searchOffer','?' => ['tipoBusqueda' => 6]],
												['class' => 'btn btn-info ','style' => 'width: 130px;' . $seleccionado30]); ?> 
			</div>
			<div class="btn-group">				
				<?= $this->Html->link('Inactivas', [ 'controller'=>'Administrators','action'=>'searchOffer','?' => ['tipoBusqueda' => 7]],
												['class' => 'btn btn-info ','style' => 'width: 130px;' . $seleccionado40]); ?> 
			</div>
		</div>
	</div>

	<?php if(isset($ofertas)): 
			if(empty($ofertas)):
					echo '<div class="col-md-12"><div class="col-md-12"><blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;"><p style="color: #588BAD">Sin ofertas.</p></blockquote></div></div>';
			else:	
	?>
				<div class="col-md-12" style="margin-top: 10px;">
			
					<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
				        <p style="color: #588BAD">Opciones:</p>
				    </blockquote>
				  	
				  	<div class="col-md-3">
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
						
						<div class="btn-group" style="width: 100%;">
						  <button type="button" class="btn btn-default col-md-12 " data-toggle="dropdown">Ordenar resultados por: &nbsp;<span class="caret"></span></button>
						  <ul class="dropdown-menu nav" role="menu">
							<li>
								<?= $this->Html->link('Fecha de publicación por la empresa', 
															['controller'=>'Administrators',
															'action'=>'searchOffer','?' => ['orden' => '1']],
															['class' => 'btn btn-default '.$selectedOrden1,'style' => 'border-color: transparent;','escape' => false]); ?>
							</li>
							<li>
							<?php echo $this->Html->link('Fecha de actualización por la empresa', 
															['controller'=>'Administrators',
															'action'=>'searchOffer','?' => ['orden' => '2']],
															['class' => 'btn btn-default ' . $selectedOrden2,'style' => 'margin-top: 5px;border-color: transparent;','escape' => false]); ?>
							</li>
						  </ul>
						</div>
					</div>

					<div class="col-md-3" >
						<?= $this->Html->link('Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="fa fa-file-excel-o" aria-hidden="true"></i>', 
																['controller'=>'Administrators',
																'action'=>'searchOfferAdminExcel'],
																['class' => 'btn btn-default btnBlue ',
																'style' => 'width: 226px; font-size: 14px; height: 33px; text-align: left',
																'escape' => false]);?>
					</div>
					<div class="col-md-4">
						<?= $this->Form->create('Administrator', [
									'class' => 'form-horizontal', 
									'role' => 'form',
									'inputDefaults' => [
										'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
										'div' => ['class' => 'form-group'],
										'class' => 'form-control',
										'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
										'between' => '<div class="col-md-9" style="margin-top: -8px;">',
										'after' => '</div>',
										'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
									],
									'action' => 'searchOffer']); ?>
						<?php $options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
						<?= $this->Form->input('Company.limite', ['type'=>'select','id'=> 'limit','options' => $options,'selected' => $this->Session->read('limiteAdmin'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Resultados por hoja','onchange'=> 'sendPaginado();']); ?>

						<?= $this->Form->end(); ?>
					</div>	
				</div>

				<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
					<?= $this->element('ofertasAdmin'); ?>
				</div>
				
		<?php 
			endif;
				endif; 
		?>	