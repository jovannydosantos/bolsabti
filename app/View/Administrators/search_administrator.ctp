	<?php 
		$this->layout = 'administrator'; 
	?>
	<?= $this->element('contadorCaracteres'); ?>
	<script>
		$(document).ready(function() {
			typeSearch();
		});
			
		function typeSearch(){
			selectedIndexTypeSearch = document.getElementById("AdministratorCriterio").selectedIndex;
			if(selectedIndexTypeSearch==4){
				$("#idDivBuscar").hide();
				$("#idDivBuscarSelect").show();
				$('#CompanyBuscar').val('');
				
			} else {
				$("#idDivBuscar").show();
				$("#idDivBuscarSelect").hide();
				document.getElementById('AdministratorBuscarEscuelaFacultad').options[0].selected = 'selected';
			}
			
			if(selectedIndexTypeSearch==1){
				$("#AdministratorBuscar").attr("placeholder", "Ingrese el nombre(s)");
			}
			else
				if(selectedIndexTypeSearch==2){
					$("#AdministratorBuscar").attr("placeholder", "Ingrese el apellido(s)");
				}
				else
					if(selectedIndexTypeSearch==3){
						$("#AdministratorBuscar").attr("placeholder", "Ingrese el correo electrónico");
					}
					else
						if(selectedIndexTypeSearch==4){
							$("#AdministratorBuscar").attr("placeholder", "Seleccione la Ecuela / Facultad");
						}
						else{
							$("#AdministratorBuscar").attr("placeholder", "Nombre administrador / Correo electrónico / Folio ");
					}
		}
		
		function validateEmpty(){
			selectedIndex = document.getElementById("AdministratorCriterio").selectedIndex;
			selectedIndexCarrera = document.getElementById("AdministratorBuscarEscuelaFacultad").selectedIndex;
			
			if(selectedIndex == 0){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione el criterio de búsqueda'});
				return false;
			} else 
			if((selectedIndex != 4) && (document.getElementById('AdministratorBuscar').value == '')){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese la palabra a buscar'});
				return false;
			} else 
			if((selectedIndex == 4) && (selectedIndexCarrera==0)){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione la Escuela/Facultad'});
				document.getElementById('AdministratorBuscarEscuelaFacultad').focus();
				return false;
			}else {
				return true;
			}
		}
			
	</script>

	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">El sistema buscará por el siguiente criterio: nombre(s), apellidos(s), correo electrónico o escuela / facultad.</p>
    </blockquote>
	
	<div class="col-md-12">
		<?= $this->Form->create('Administrator', [
									'class' => 'form-horizontal', 
									'id' => 'sendPaginadoForm',
									'role' => 'form',
									'inputDefaults' => [
										'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
										'div' => ['class' => 'form-group'],
										'class' => 'form-control',
										'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
										'between' => '<div class="col-md-12">',
										'after' => '</div>',
										'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
									],
									'action' => 'searchAdministrator',
									'onsubmit' =>'return validateEmpty();']); ?>
		
		<fieldset>
			<div class="col-md-3">
				<?php $options = array('1' => 'Nombre(s)', '2' => 'Apellidos(s)', '3' => 'Correo electrónico', '4' =>'Escuela / Facultad'); ?>
				<?= $this->Form->input('criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda','onchange' => 'typeSearch()']); ?>
			</div>

			<div class="col-md-6" id="idDivBuscar">
				<?= $this->Form->input('Buscar', ['placeholder' => 'Buscar...','value'	=> $this->Session->read('palabraBuscada'),]); ?>
			</div>

			<div class="col-md-6" id="idDivBuscarSelect">
				<?= $this->Form->input('buscarEscuelaFacultad', ['type' => 'select','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','options' => $EscuelasFacultades, 'default'=>'0', 'empty' => 'Escuelas / Facultades','value'=> $this->Session->read('palabraBuscada')]); ?>
			</div>

			<?= $this->Form->input('limite', ['type'=>'hidden']); ?>

			<div class="col-md-2 text-center" style="margin-top: 6px;">
				<?= $this->Form->button('Buscar <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary col-md-12','escape' => false]);?>
				<?= $this->Form->end(); ?>
			</div>	
		</fieldset>
	</div>
	<br>

	<?php if(isset($administradores)): 
				if(empty($administradores)):
					echo '<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
					    <p style="color: #588BAD">Sin resultados.</p>
					  </blockquote>';
				else:
	?>
					<div class="col-md-12">
						<div class="col-md-3" >
							<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
						        <p style="color: #588BAD">Opciones:</p>
						    </blockquote>
					    </div>
						<div class="col-md-3" >
							<?= $this->Html->link('Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="fa fa-file-excel-o" aria-hidden="true"></i>', 
																	['controller'=>'Administrators',
																	'action'=>'searchAdministratorsExcel'],
																	['class' => 'btn btn-default btnBlue ',
																	'style' => 'width: 226px; font-size: 14px; height: 33px; text-align: left',
																	'escape' => false]);?>
						</div>
						<div class="col-md-4">
							<?= $this->Form->create('Administrator', [
										'class' => 'form-horizontal', 
										'role' => 'form',
										'id' => 'sendPaginadoForm',
										'inputDefaults' => [
											'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
											'div' => ['class' => 'form-group'],
											'class' => 'form-control',
											'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
											'between' => '<div class="col-md-9" style="margin-top: -8px;">',
											'after' => '</div>',
											'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
										],
										'action' => 'searchAdministrator']); ?>
							<?php $options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
							<?= $this->Form->input('Company.limite', ['type'=>'select','id'=> 'limit','options' => $options,'selected' => $this->Session->read('limiteAdmin'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Resultados por hoja','onchange'=> 'sendPaginado();']); ?>

							<?= $this->Form->end(); ?>
						</div>
					</div>
			
					<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
						<?= $this->element('administradoresAdmin'); ?>
						<?= $this->element('paginacionStudentAdmin'); ?>
					</div>
	<?php 
				endif;
		endif; 
	?>