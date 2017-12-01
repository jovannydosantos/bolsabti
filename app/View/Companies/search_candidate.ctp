<?php 
	$this->layout = 'company'; 
?>

<script>
	$(document).ready(function() {
		init_contadorTa("StudentTelephoneNotificationMessage","contadorTaComentario", 316);
		updateContadorTa("StudentTelephoneNotificationMessage","contadorTaComentario", 316);
		
		init_contadorTa("StudentPersonalNotificationMessage","contadorTaComentarioPropuesta", 316);
		updateContadorTa("StudentPersonalNotificationMessage","contadorTaComentarioPropuesta", 316);
		
		init_contadorTa("messageIdEmail","contadorTaComentario2", 632);
		updateContadorTa("messageIdEmail","contadorTaComentario2", 632);
		
		 $('#StudentTelephoneNotificationDateYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentTelephoneNotificationDateMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentTelephoneNotificationDateDay').prepend('<option value="" selected>DD</option>');
		 
		 $('#StudentPersonalNotificationDateYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentPersonalNotificationDateMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentPersonalNotificationDateDay').prepend('<option value="" selected>DD</option>');
		 
		 $('#StudentPropuestaFechaYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentPropuestaFechaMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentPropuestaFechaDay').prepend('<option value="" selected>DD</option>');
		 
		 $('#StudentReportarContratacionFechaContratacionYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentReportarContratacionFechaContratacionMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentReportarContratacionFechaContratacionDay').prepend('<option value="" selected>DD</option>');
		 
		  typeSearch();
	});
	//Contador de caracteres para las notificaciones telefónicas 
	function init_contadorTa(idtextarea, idcontador,max){
		$("#"+idtextarea).keyup(function()
				{
					updateContadorTa(idtextarea, idcontador,max);
				});
		
		$("#"+idtextarea).change(function()
		{
				updateContadorTa(idtextarea, idcontador,max);
		});
		
	}

	function updateContadorTa(idtextarea, idcontador,max){
		var contador = $("#"+idcontador);
		var ta =     $("#"+idtextarea);
		contador.html("0/"+max);
		
		contador.html(ta.val().length+"/"+max);
		if(parseInt(ta.val().length)>max)
		{
			ta.val(ta.val().substring(0,max-1));
			contador.html(max+"/"+max);
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

	function nuevaFechaEntrevista(id, company_job_profile_id){
			document.getElementById('StudentPropuestaId').value = id;
			document.getElementById('StudentPropuestaCompsnyaJobProfileId').value = company_job_profile_id;
			$('#myModalnotification').modal('show');
			return false;
		}
		
	function saveOffer(StudentId){
		document.getElementById('CompanySavedStudentStudentId').value = StudentId;
		$('#myModal1').modal('show');
	}
	
	function validaFormSaveStudent(){
		var valor = document.getElementById("CompanySavedStudentCompanyFolderId").value;
		if (valor == ''){
			jAlert('Seleccione la carpeta donde se guardará el perfil','Mensaje');
			document.getElementById("CompanySavedStudentCompanyFolderId").focus;
			return false;
		} else {
			return true;
		}
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
		
	function validarFecha(fecha){
			 //Funcion validarFecha 
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
		
	
	
	function validateEmpty(){
		selectedIndex = document.getElementById("CompanyCriterio").selectedIndex;
		
		if(document.getElementById('CompanyBuscar').value == ''){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el nombre del candidato, correo ó folio a buscar'});
				return false;
			}
		 else 
		if(selectedIndex == 0){
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione el criterio de búsqueda'});
			return false;
		}else {
			return true;
		}
	}
	
	function sendLimit(){
		 selectedIndex = document.getElementById("limit").selectedIndex;
		 if(selectedIndex == 0){
			return false;
		 } else {
			document.getElementById('CompanyLimite').value = document.getElementById('limit').value;
			document.getElementById("CompanySearchCandidateForm").submit();
		 }
	}
	
	function typeSearch(){
		selectedIndexTypeSearch = document.getElementById("CompanyCriterio").selectedIndex;
		
		if(selectedIndexTypeSearch==1){
			$("#CompanyBuscar").attr("placeholder", "Ingrese el nombre del candidato");
		}
		else
			if(selectedIndexTypeSearch==2){
				$("#CompanyBuscar").attr("placeholder", "Ingrese el correo electrónico");
			}
			else
				if(selectedIndexTypeSearch==3){
					$("#CompanyBuscar").attr("placeholder", "Ingrese el folio");
				}
				else{
					$("#CompanyBuscar").attr("placeholder", "Nombre candidato / Correo electrónico / Folio ");
				}
	}
	
</script>
			
<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
      <p style="color: #588BAD">Administrar candidatos:
        <?php if((isset($intoFolder)) and ($intoFolder<>'')): ?>
				<img class="estatica" src="<?php echo $this->webroot; ?>img/student/folder1.png" style="width: 25px; ">   
				<label><?php echo $foldersList[$intoFolder]; ?> </label>
		<?php endif?></p>
</blockquote>
			
<div class="col-md-12" >
	<?= $this->Form->create('Company', [
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
						'action' => 'searchCandidate',
						'onsubmit' =>'return validateEmpty();']); ?>
	<fieldset>
		<div class="col-md-3">
			<?php $options = array('1' => 'Nombre candidato', '2' => 'Correo electrónico', '3' => 'Folio'); ?>
			<?= $this->Form->input('criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda']); ?>
		</div>
		<div class="col-md-6">
			<?= $this->Form->input('Buscar', ['placeholder' => 'Nombre candidato / Correo electrónico / Folio ','value'	=> $this->Session->read('palabraBuscada')]); ?>
		</div>
		<div class="col-md-2">
			<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px;']);?>
			<?= $this->Form->end(); ?>
		</div>
	</fieldset>
</div>
			
<div class="col-md-12"  style="padding-left: 0px;">
	<?php if(isset($candidatos)): 
		if(empty($candidatos)):
		echo '<div class="col-md-12" style="margin-top: 15px;"> <p style="font-size: 22px;margin-left: -20px;">Sin resultados</p></div>';
		else:
	?>
	<div class="col-md-12">
		<?php	
			if($newSearch == 'si'):
				echo '<div class="col-md-12" style="margin-top: 15px;"> <p style="font-size: 22px;margin-left: -20px;">Sugerencias de universitarios</p></div>';
			else:
				echo '<div class="col-md-12" style="margin-top: 15px;"> <p style="font-size: 22px;margin-left: -20px;">Resultados de busqueda</p></div>';
			endif;
		
		?>
	</div>

	<div class="col-md-2">
		<?php 	echo $this->Html->link('Descargar Excel &nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
												array(
													'controller'=>'Companies',
													'action'=>'searchCandidateExcel',
													),
												array(
													'class' => 'btn btn-primary',
													'style'=>'margin-top: 7px;',
													'escape' => false,
													)	
										); 
		?>
	</div>

	<div class="col-md-3">
		<?php $options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
		<?= $this->Form->input('limit', ['type'=>'select','options' => $options,'id'=> 'limit','class' => 'selectpicker show-tick form-control show-menu-arrow','style'=>'margin-top: 7px;','selected' => $this->Session->read('limit'),'default'=>'0', 'empty' => 'Resultados por hoja','onchange' => 'sendLimit()']); ?>	
	</div>

	<div class="col-md-3">
		<?php 
			if($this->Session->read('orden') == 'DESC'):
				$addClassSalaryASC = 'active'; 
				$addClassSalaryDESC = ''; 
			else:
				if($this->Session->read('orden') == 'ASC'):
					$addClassSalaryASC = ''; 
					$addClassSalaryDESC = 'active';
				else:
					$addClassSalaryASC = ''; 
					$addClassSalaryDESC = ''; 
				endif;
			endif;
		?>
		<div class="btn-group">
		<div class="col-md-12" style="margin-top: 7px;">
		  <button type="button" class="btn btn-default col-md-12" data-toggle="dropdown">Ordenar por fecha &nbsp;<i></i><span class="caret"></span></button>
		  <ul class="dropdown-menu nav" role="menu">
			<li>
				<?= $this->Html->link(' Más reciente a más antigua', 
											['controller'=>'Companies',
											'action'=>'searchCandidate','?' => ['orden' => 'DESC']],
											['class' => 'selectpicker show-tick form-control show-menu-arrow'.$addClassSalaryASC,'style' => 'border-color: transparent;','escape' => false]); ?>
			</li>
			<li>
			<?php echo $this->Html->link(' Más antigua a más reciente ', 
											['controller'=>'Companies',
											'action'=>'searchCandidate','?' => ['orden' => 'ASC']],
											['class' => 'selectpicker show-tick form-control show-menu-arrow' . $addClassSalaryDESC,'style' => 'margin-top: 5px;border-color: transparent;','escape' => false]); ?>
			</li>
		  </ul>
		</div>
		</div>
	</div>
</div>
		
<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">		
	<?= $this->element('candidatos'); ?>
</div>	

<?php 
		endif;
	endif; 
?>	
