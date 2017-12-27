<?php 
	$this->layout = 'company'; 
?>
<script>
	
	$(document).ready(function() {
		
			var helpText = [
							"Guarda y nombra las consultas de ofertas en carpetas para una mejor organización. Las carpetas creadas se ordenarán alfabéticamente.",					
							];
			 
			$('.form-group').each(function(index, element) {
				$(this).find(".cambia").attr("id", index);
				$(this).find('#'+index).attr("data-original-title", helpText[index]);
			});
			
		
			
			 
			typeSearch();
		});		
		
			$(document).ready(function() {
			$('#CompanyJobProfileExpirationYear').prepend('<option value="" selected>AAAA</option>');
			$('#CompanyJobProfileExpirationMonth').prepend('<option value="" selected>MM</option>');
			$('#CompanyJobProfileExpirationDay').prepend('<option value="" selected>DD</option>');
			 
			typeSearch();
			$('.selectpicker').selectpicker('refresh');
		});	
	function validateEmptyCompany(){
			selectedIndex = document.getElementById("CompanyCriterio").selectedIndex;
			var palabraBuscar = document.getElementById('CompanyBuscar').value ;
			var sueldo = document.getElementById("CompanyBuscarSalary").selectedIndex;

			if(selectedIndex == 0){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione el criterio de búsqueda'});
				document.getElementById('CompanyCriterio').focus();
				return false;
			}else 
			if((palabraBuscar == '') && (sueldo == '')){
				
				if(selectedIndex == 1){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el puesto'});
					document.getElementById('CompanyBuscar').focus();
				} else
				if(selectedIndex == 2){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione el rango de sueldo'});
					document.getElementById('CompanyBuscarSalary').focus();
				}else{
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el folio'});
						document.getElementById('CompanyBuscar').focus();
				}
				
				return false;
			}else {
				return true;
			}
		}
/* 	function typeSearchStudent(){
			if ( $("#CompanyCriterioStudent").length > 0 ) {
				selectedIndexTypeSearch = document.getElementById("CompanyCriterioStudent").selectedIndex;
			
				if(selectedIndexTypeSearch==1){
					$("#CompanyBuscarStudent").attr("placeholder", "Ingrese el nombre del candidato");
				}
				else
					if(selectedIndexTypeSearch==2){
						$("#CompanyBuscarStudent").attr("placeholder", "Ingrese el correo electrónico");
					}
					else
						if(selectedIndexTypeSearch==3){
							$("#CompanyBuscarStudent").attr("placeholder", "Ingrese el folio");
						}
						else{
							$("#CompanyBuscarStudent").attr("placeholder", "Nombre candidato / Correo electrónico / Folio ");
						}
			}
		} */
	function typeSearch(){
			selectedIndexTypeSearch = document.getElementById("CompanyCriterio").selectedIndex;

			if(selectedIndexTypeSearch==2){
				$("#idDivBuscar").hide();
				$("#idDivBuscarSelect").show();
				$('#CompanyBuscar').val('');
				
			} else {
				$("#idDivBuscar").show();
				$("#idDivBuscarSelect").hide();
				
				document.getElementById('CompanyBuscarSalary').options[0].selected = 'selected';
			}
			
			if(selectedIndexTypeSearch==1){
				$("#CompanyBuscar").attr("placeholder", "Ingrese el puesto");
			}
			else
				if(selectedIndexTypeSearch==3){
						$("#CompanyBuscar").attr("placeholder", "Ingrese el folio");
				}
			
		}
	//function saveOffer(StudentId){
		//		document.getElementById('CompanySavedStudentStudentId').value = StudentId;
				//$('#myModal1').modal('show');
			//}
	function sendLimit(){
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById('CompanyLimite').value = document.getElementById('limit').value;
				document.getElementById("CompanySearchCandidateForm").submit();
			 }
		}

</script>
	
<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">Administrar ofertas guardadas.
        <?php if((isset($intoFolder)) and ($intoFolder<>'')): ?>
				<img class="estatica" src="<?php echo $this->webroot; ?>img/student/folder1.png" style="width: 25px; ">   
				<label><?php echo $foldersList[$intoFolder]; ?> </label>
		<?php endif?></p>
</blockquote>

<div class="col-md-12" >
	<div class="col-md-12" >
		<label>Buscar oferta:</label>
	</div>
</div>

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
						'action' => 'studentReport',
						'onsubmit' =>'return validateEmptyCompany();']); ?>

	<fieldset>
		<div class="col-md-3">
			<?php $options = array('1' => 'Puesto', '2' => 'Sueldo', '3' => 'Folio'); ?>
			<?= $this->Form->input('criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'onchange' => 'typeSearch()','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda']); ?>
		</div>
		<div class="col-md-6" id="idDivBuscar">
			<?= $this->Form->input('Buscar', ['placeholder' => 'Puesto / Sueldo / Folio ','value'	=> $this->Session->read('palabraBuscada')]); ?>
		</div>
		<div class="col-md-6" id="idDivBuscarSelect">
			<?= $this->Form->input('buscarSalary', ['placeholder' => 'Puesto / Sueldo / Folio ','value'	=> $this->Session->read('palabraBuscada'),'options' => $Salarios,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Sueldo (Neto)']); ?>
		</div>
		<?php echo $this->Form->input('limite', array('type'=>'hidden')); ?>
		<div class="col-md-2">
			<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px;']);?>
			<?= $this->Form->end(); ?>
		</div>
	</fieldset>
</div>
	
<div class="col-md-12">
	<div class="col-md-12">
		<label> Resultados de busqueda</label>
	</div>
</div>

<?php if(isset($ofertas)): 
		if(empty($ofertas)):
			echo '<div class="col-md-12" style="margin-top: 15px;"> <p style="font-size: 22px;margin-left: -20px;">Sin ofertas</p></div>';
		else:
?>
				
<div class="col-md-12 scrollbar" id="style-2" >
<?= $this->element('ReportarOfertasCom'); ?>
		
	<div class="col-md-12">
		<center>
			<?php 
				if(!empty($candidatos)):
			?>
		
			<div class="pagination" style="margin-top: 5px;margin-bottom: 15px;">
					<p style="margin-bottom: 0px;">
						<?= $this->Paginator->counter(array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')); ?>
					</p>
		    		<ul class="pagination pagination-sm" style="margin-top: 5px;margin-bottom: 5px;">  
						<?= $this->Paginator->first('<<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						<?= $this->Paginator->prev('<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						<?= $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1)); ?>
						<?= $this->Paginator->next('>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						<?= $this->Paginator->last('>>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
			        </ul>
		    </div>
			
			<?php endif; ?>
		</center>
	</div>		
</div>					

<?php 
		endif;
	endif; 
?>	
<!--misma ?? -->

