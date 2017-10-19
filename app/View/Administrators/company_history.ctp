	<?php 
		$this->layout = 'administrator'; 
	?>
	<script type="text/javascript">
		
		$(document).ready(function() {
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
				$("#filtroBotonId1").addClass( "active" );
				ocultar();
				$('#filtroId1').show("slow");
				return false;
			}else if(valor==2){
				resetColor();
				$("#filtroBotonId2").addClass( "active" );
				ocultar();
				$('#filtroId2').show("slow");
				return false;
			}else if(valor==3){
				resetColor();
				$("#filtroBotonId3").addClass( "active" );
				ocultar();
				$('#filtroId3').show("slow");
				return false;
			}else if(valor==4){
				resetColor();
				$("#filtroBotonId4").addClass( "active" );
				ocultar();
				$('#filtroId4').show("slow");
				return false;
			}else if(valor==5){
				resetColor();
				$("#filtroBotonId5").addClass( "active" ); 
				ocultar();
				$('#filtroId5').show("slow");
				return false;
			}else if(valor==6){
				resetColor();
				$("#filtroBotonId6").addClass( "active" );
				ocultar();
				$('#filtroId6').show("slow");
				return false;
			}else if(validaFecha1 == false){
					$.alert({ title: '!Aviso!',type: 'red',content: 'La fecha inicio de la búsqueda es incorrecta o incompleta'});
					return false;
			}else if(validaFecha2 == false){
					$.alert({ title: '!Aviso!',type: 'red',content: 'La fecha fin de la búsqueda es incorrecta o incompleta'});
					return false;
			}else if((valor==7) && (selectedDate == 0) ){
				if(resultadoComparativa==1){
					$.alert({ title: '!Aviso!',type: 'red',content: 'La fecha inicio de la búsqueda debe ser menor a la final'});
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
			$( ".filtros" ).removeClass( "active" );
		}
		
		function validateEmpty(){
			selectedIndex = document.getElementById("AdministratorCriterio").selectedIndex;
			var palabraBuscar = document.getElementById('AdministratorBuscar').value ;
			var sueldo = document.getElementById("AdministratorBuscarSalary").selectedIndex;
			
			if(selectedIndex == 0){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione el criterio de búsqueda'});
				return false;
			}else 
			if((palabraBuscar == '') && (sueldo == '')){
				if(selectedIndex == 1){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el puesto'});
					return false;
				} else
				if(selectedIndex == 2){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione el rango de sueldo'});
					return false;
				}else{
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el folio'});
					return false;
				}
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
		}
		
	</script>
	
	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
        <p style="color: #588BAD">Historial de la empresa/Institución:</p>
    </blockquote>
    
	<div class="col-md-12" style="margin-top: 15px">
		<?= $this->element('empresasAdmin'); ?>
	</div>

	<div class="col-md-10 col-md-offset-1 fondoBti" style="margin-top: 20px;">
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 15px;margin-bottom: 5px;">
	        <p style="color: #fff">Buscar ofertas por rango de fechas.</p>
	    </blockquote>

		<?= $this->Form->create('Administrator', [
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => [
									'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
									'div' => ['class' => 'form-group'],
									'class' => 'form-control',
									'label' => ['class' => 'col-md-12  control-label', 'text'=>''],
									'between' => '<div class="col-md-12">',
									'after' => '</div>',
									'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
								],
								'action' => 'companyHistory',
								'onsubmit' =>'return sendForm(7);']); ?>
			
			<fieldset>
			
		<div class="col-md-5">
			<?= $this->Form->input('start_date_search', [
													'type' => 'date',
													'class' => 'selectpicker show-tick form-control show-menu-arrow',
													'data-width'=> '33.333%',
													'dateFormat' => 'YMD',
													'separator' => '',
													'minYear' => date('Y') - 2,
													'maxYear' => date('Y') - 0]); ?>
		</div>
		<div class="col-md-5">
			<?= $this->Form->input('end_date_search', [
													'type' => 'date',
													'class' => 'selectpicker show-tick form-control show-menu-arrow',
													'data-width'=> '33.333%',
													'dateFormat' => 'YMD',
													'separator' => '',
													'minYear' => date('Y') - 2,
													'maxYear' => date('Y') - 0]); ?>

		</div>		
		<?php echo $this->Form->input('typeFilter', ['type' => 'hidden']);?>	

		<div class="col-md-1" style="padding-top: 6px;">
			<?= $this->Form->button('Buscar &nbsp; <i class="glyphicon glyphicon-search"></i>&nbsp;',['type'=>'submit','class' => 'btn btn-default','escape' => false,'style' => 'width:120px;']);?>
			<?= $this->Form->end(); ?>
		</div>	

		</fieldset>				
	</div>

	<div class="col-md-12" style="margin-top: 15px;">
		<nav class="navbar navbar-default navbar-static-top" style="margin-top: 5px;margin-bottom: 10px;z-index: 1;">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">Ofertas:</a>
		    </div>

		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
		      <ul class="nav navbar-nav">
				<li onClick='return sendForm(1);' class="filtros" id="filtroBotonId1"><a href='#'>Publicadas</a></li>
				<li onClick='return sendForm(2);' class="filtros" id="filtroBotonId2"><a href='#'>Con contratados</a></li>
				<li onClick='return sendForm(3);' class="filtros" id="filtroBotonId3"><a href='#'>Con candidatos</a></li>
				<li onClick='return sendForm(4);' class="filtros" id="filtroBotonId4"><a href='#'>Con entrevista telefonica</a></li>
				<li onClick='return sendForm(5);' class="filtros" id="filtroBotonId5"><a href='#'>Entrevistas presenciales</a></li>
				<li onClick='return sendForm(6);' class="filtros" id="filtroBotonId6"><a href='#'>Total CV's extraidos</a></li>
			  </ul>	
			</div>
		  </div>
        </nav>
	</div>	

	<?php
		if($empresas[0]['CompanyOfferOption']['max_cv_download']<>null):
			$cvExtraer = $empresas[0]['CompanyOfferOption']['max_cv_download'];
		else:
			$cvExtraer = 'Sin especificar';
		endif;
	
	?>
	<?php if(isset($datos) and !empty($datos)): ?>

		<div class="col-md-9 col-md-offset-1" style="display: none" id="filtroId1">
			<label style="color: #FFB71F;">Total ofertas publicadas: <?php echo count($datos);  ?> </label>
		</div>

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
		
		<div class="col-md-9 col-md-offset-1" style="display: none" id="filtroId2">
			<label style="color: #FFB71F;">Total ofertas con contratados: <?php echo $totalOfertas; ?> </label><br />
			<label style="color: #FFB71F;">Total contratados: <?php echo $totalContratados; ?>  </label>
		</div>

			<?php 
			$totalPostulados = 0;
			foreach($datos as $k => $postulados):
				if(!empty($postulados['Application'])):
					$totalPostulados = $totalPostulados + count($postulados['Application']);
				endif;
			endforeach;
		?>
		<div class="col-md-9 col-md-offset-1" style="display: none" id="filtroId3">
			<label style="color: #FFB71F;">Total ofertas con postulados: <?php  echo $totalPostulados; ?> </label>
		</div>

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
		<div class="col-md-9 col-md-offset-1" style="display: none" id="filtroId4">
			<label style="color: #FFB71F;">Total ofertas con entrevistas telefónicas: <?php  echo $totalTelefonicas; ?> </label>
		</div>

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
		<div class="col-md-9 col-md-offset-1" style="display: none" id="filtroId5">
			<label style="color: #FFB71F;">Total ofertas con entrevistas presenciales: <?php  echo $totalPresenciales; ?>  </label>
		</div>

		<div class="col-md-9 col-md-offset-1" style="display: none" id="filtroId6">
			<label style="color: #FFB71F;">Total currículums extraídos: <?php echo $descargas;  ?>  </label><br />
			<label style="color: #FFB71F;">Total de currículums a extraer: <?php echo $cvExtraer;  ?>  </label>
		</div>
	<?php else: ?>
			<div class="col-md-9 col-md-offset-1" style="display: none" id="filtroId1">
				<label style="color: #FFB71F;">Total ofertas publicadas: <?php echo count($empresas[0]['CompanyJobProfile']);  ?> </label>
			</div>
		
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
			
			<div class="col-md-9 col-md-offset-1" style="display: none" id="filtroId2">
				<label style="color: #FFB71F;">Total ofertas con contratados: <?php echo $totalOfertas; ?> </label><br />
				<label style="color: #FFB71F;">Total contratados: <?php echo $totalContratados; ?>  </label>
			</div>

				<?php 
				$totalPostulados = 0;
				foreach($empresas[0]['CompanyJobProfile'] as $k => $postulados):
					if(!empty($postulados['Application'])):
						$totalPostulados = $totalPostulados + count($postulados['Application']);
					endif;
				endforeach;
			?>
			<div class="col-md-9 col-md-offset-1" style="display: none" id="filtroId3">
				<label style="color: #FFB71F;">Total ofertas con postulados: <?php  echo $totalPostulados; ?> </label>
			</div>

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
			<div class="col-md-9 col-md-offset-1" style="display: none" id="filtroId4">
				<label style="color: #FFB71F;">Total ofertas con entrevistas telefónicas: <?php  echo $totalTelefonicas; ?> </label>
			</div>

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
			<div class="col-md-9 col-md-offset-1" style="display: none" id="filtroId5">
				<label style="color: #FFB71F;">Total ofertas con entrevistas presenciales: <?php  echo $totalPresenciales; ?>  </label>
			</div>

			<div class="col-md-9 col-md-offset-1" style="display: none" id="filtroId6">
				<label style="color: #FFB71F;">Total currículums extraídos: <?php echo $descargas;  ?>  </label><br />
				<label style="color: #FFB71F;">Total de currículums a extraer: <?php echo $cvExtraer;  ?>  </label>
			</div>
<?php endif; ?>
		
	<div class="col-md-12">
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
	        <p style="color: #588BAD">Buscar en todas las ofertas de la empresa:</p>
	    </blockquote>

		<?= $this->Form->create('Administrator', [
								'class' => 'form-horizontal', 
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
								'action' => 'companyHistory',
								'onsubmit' =>'return validateEmpty();']); ?>
	
		<fieldset>
			<div class="col-md-3">
				<?php $options = array('1' => 'Puesto', '2' => 'Sueldo', '3' => 'Folio'); ?>
				<?= $this->Form->input('criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'onchange' => 'typeSearch()','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda']); ?>
			</div>

			<div class="col-md-6" id="idDivBuscar">
				<?= $this->Form->input('Buscar', ['placeholder' => 'Puesto / Sueldo / Folio','value'=> $this->Session->read('palabraBuscadaAdmin'),]); ?>
			</div>

			<div class="col-md-6" id="idDivBuscarSelect">
				<?= $this->Form->input('buscarSalary', ['type'=>'select','options' => $Salarios,'selected' => $this->Session->read('palabraBuscada'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Sueldo (Neto)']); ?>
			</div>

			<?= $this->Form->input('limite', ['type'=>'hidden']); ?>

			<div class="col-md-2 text-center" style="margin-top: 6px;">
				<?= $this->Form->button('Buscar <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary col-md-12','escape' => false]);?>
				<?= $this->Form->end(); ?>
			</div>	
		</fieldset>
	</div>

	<?php if(isset($ofertas)): 
			if(empty($ofertas)):
				echo '<div class="col-md-12"><div class="col-md-12"><blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;"><p style="color: #588BAD">Sin ofertas.</p></blockquote></div></div>';
			else:
	?>
				<div class="col-md-12" style="margin-top: 15px">
					<div class="col-md-2" >
						<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
					        <p style="color: #588BAD">Opciones:</p>
					    </blockquote>
				    </div>
					<div class="col-md-2" >
						<?= $this->Html->link('Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="fa fa-file-excel-o" aria-hidden="true"></i>', 
																['controller'=>'Administrators',
																'action'=>'companyHistoryExcel'],
																['class' => 'btn btn-default btnBlue ',
																'style' => 'font-size: 14px; height: 33px; text-align: left',
																'escape' => false]);?>
					</div>
					
					<div class="col-md-3">
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
									'action' => 'companyHistory']); ?>
						<?php $options = array('5' => 5,'25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
						<?= $this->Form->input('limit', ['type'=>'select','id'=> 'limit','options' => $options,'selected' => $this->Session->read('limiteAdmin'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Resultados por hoja','onchange'=> 'sendPaginado();']); ?>

						<?= $this->Form->end(); ?>

					</div>
				</div>

	<?php
			endif;
				endif;
	?>

	<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
		<?= $this->element('ofertasAdmin'); ?>
	</div>