<?php 
	$this->layout = 'company'; 
?>
<style>
	.form-control {
		font-size:13px;
		padding-left: 2px;
	}
</style>
<script>
		$(document).ready(function() {

			var helpText = [
							"", 
							"Nombre genérico del puesto en el mercado laboral.                                   Ejemplos:                                                                           Puesto equivalente en el mercado                         Analista de Mercados = Analista de Mercadotecnia Gerente de atracción de talento = Gerente de reclutamiento y selección", 
							"Número de posiciones requeridas por las empresas.",
							"Actividad principal que realiza la empresa o institución. Ejemplos:                Automotriz                                             Farmacéutica",
							"",
							"Área y número de años de experiencia que requiere un candidato para ocupar el puesto",
							"Experiencia en una actividad o función específica que requiere un candidato para ocupar el puesto.",
							"Escriba las funciones o actividades a desempeñar en el puesto. Le sugerimos ser lo más claro y concreto. Sólo cuenta con 316 caracteres como máximo. ",
							"",
							"La vacante permite que candidatos con algún tipo de discapacidad puedan postularse para ocupar el puesto."
							];
			 
			$('.form-group').each(function(index, element) {
				$(this).find(".cambia").attr("id", index);
				$(this).find('#'+index).attr("data-original-title", helpText[index]);
			});	

			init_contadorTa("CompanyJobProfileActivity","contadorTaComentario", 1000);
			updateContadorTa("CompanyJobProfileActivity","contadorTaComentario", 1000);
			desabilityMobility();

		<?php if(!empty($this->request->data['CompanyJobProfile'])): ?>
			 $('#CompanyJobProfileExpirationYear').prepend('<option value="">AAAA</option>');
			 $('#CompanyJobProfileExpirationMonth').prepend('<option value="">MM</option>');
			 $('#CompanyJobProfileExpirationDay').prepend('<option value="">DD</option>');
		 <?php else: ?>
			 $('#CompanyJobProfileExpirationYear').prepend('<option value="" selected>AAAA</option>');
			 $('#CompanyJobProfileExpirationMonth').prepend('<option value="" selected>MM</option>');
			 $('#CompanyJobProfileExpirationDay').prepend('<option value="" selected>DD</option>');
		 <?php endif; ?>


		//Obtener áreas en base al giro Carga automática.
			if($("#CompanyJobProfileRotation").val() != 0)
				{
				$('#loading').show();
				$.get('http://localhost/bolsabti/app/webroot/php/derpAreas.php',{giro: $('#CompanyJobProfileRotation').val()},function(JSON)
					{
					
					$('#CompanyJobProfileInterestArea').empty();
					$('#CompanyJobProfileInterestArea').append('<option value="">Área de interés</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});

					$.each(JSON, function(key, val){
						
						if(val.id == '<?php 	if(!empty($this->request->data['CompanyJobProfile'])):
													echo $this->request->data['CompanyJobProfile']['interest_area'];
												else:
													echo '';
												endif;
												 ?>'){
							$('#CompanyJobProfileInterestArea').append('<option value="' + val.id + '" selected>' + val.area + '</option>');
						}else{
							$('#CompanyJobProfileInterestArea').append('<option value="' + val.id + '">' + val.area + '</option>');
						}
						
						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}

					});
					});
				}
			else
				{
					$('#CompanyJobProfileInterestArea').empty();
					$('#CompanyJobProfileInterestArea').append('<option value="">Área de interés</option>');
					$('.selectpicker').selectpicker('refresh');
				}
			
		//Obtener áreas en base al giro seleccionado
		$("#CompanyJobProfileRotation").on('change',function (){
			$("#divSubarea").hide();
			if($("#CompanyJobProfileRotation").val() != 0)
				{
				$('#loading').show();
				$.get('http://localhost/bolsabti/app/webroot/php/derpAreas.php',{giro: $('#CompanyJobProfileRotation').val()},function(JSON)
					{
					
					$('#CompanyJobProfileInterestArea').empty();
					$('#CompanyJobProfileInterestArea').append('<option value="">Área de interés</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});
					
					$.each(JSON, function(key, val){
						$('#CompanyJobProfileInterestArea').append('<option value="' + val.id + '">' + val.area + '</option>');
						
						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}
					});
					});
				}
				else
				{
					$('#CompanyJobProfileInterestArea').empty();
					$('#CompanyJobProfileInterestArea').append('<option value="">Área de interés</option>');
					$('.selectpicker').selectpicker('refresh');
				}
		});

		});

		//<![CDATA[	
		function init_contadorTa(idtextarea, idcontador,max)
		{
			$("#"+idtextarea).keyup(function()
					{
						updateContadorTa(idtextarea, idcontador,max);
					});
			
			$("#"+idtextarea).change(function()
			{
					updateContadorTa(idtextarea, idcontador,max);
			});
			
		}

		function updateContadorTa(idtextarea, idcontador,max)
		{
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
		//]]> 
function desabilityMobility(){
			if(document.getElementById("CompanyJobProfileDisability").value == 's') {  
				$('#tipoDiscapacidadId').show();
			} else {
				$('#tipoDiscapacidadId').hide();
			}
		}
			
	
	
	function validarFecha(fecha){
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

	function fechaMax(fecha){

		<?php if(($this->Session->read('Auth.User.role')=='administrator') OR ($this->Session->read('Auth.User.role')=='subadministrator')): ?>
				var hoy = new Date();
				var dd = hoy.getDate();
				var mm = hoy.getMonth()+1; //hoy es 0!
				var yyyy = hoy.getFullYear();
				hoy = yyyy+'-'+mm+'-'+dd;
				var fechaCreacion = hoy;
		<?php else: ?>
			<?php if(!empty($this->request->data['CompanyJobProfile'])): ?>
				var fechaCreacion = '<?php echo $this->request->data['CompanyJobProfile']['created']; ?>';
			<?php else: ?>	
				var hoy = new Date();
				var dd = hoy.getDate();
				var mm = hoy.getMonth()+1; //hoy es 0!
				var yyyy = hoy.getFullYear();
				hoy = yyyy+'-'+mm+'-'+dd;
				var fechaCreacion = hoy;
			<?php endif; ?>
		<?php endif; ?>
		
				var fechaCreacion = fechaCreacion;
				var fechaArrCreacion = fechaCreacion.split('-');
				var aho2 = fechaArrCreacion[0];
				var mes2 = fechaArrCreacion[1];
				var dia2 = fechaArrCreacion[2];
				var fechaCreacionOferta = new Date(aho2,mes2,dia2);

				var fechaArr = fecha.split('/');
				var aho = fechaArr[2];
				var mes = fechaArr[1];
				var dia = fechaArr[0];
				var fechaPropuesta = new Date(aho, mes-1, dia); 

				if(fechaPropuesta > fechaCreacionOferta){
					return false;
				} else{
					return true;
				}
		
	}
	
	function listaprohibida(){
		var  palabras = [
		"bronca",
		"broncas",
		"broncudo",
		"broncudos",
		"broncudas",
		"bobo",
		"boba",
		"bobos",
		"bobas",
		"cabron",
		"cabrona",
		"cabrones",
		"caca",
		"cagar",
		"cagada",
		"cagado",
		"cagadas",
		"cagados",
		"cagando",
		"carajo",
		"carajos",
		"chinga",
		"chingo",
		"chingar",
		"chingaos",
		"chingado",
		"chingada",
		"chingamos",
		"chingaron",
		"chingadera",
		"chingaderas",
		"chingon",
		"chingona",
		"chingones",
		"chingoneria",
		"chingale",
		"cojer",
		"cojido",
		"cojida",
		"cojidita",
		"cojidito",
		"cojemos",
		"cojen",
		"cojimos",
		"coji",
		"culera",
		"culero",
		"culerada",
		"culeras",
		"culeros",
		"culo",
		"culote",
		"culon",
		"desmadrar",
		"desmadre",
		"desmadrarse",
		"desmadrado",
		"encabronar",
		"encabronarse",
		"encabronado",
		"encabronados",
		"encabronada",
		"encabronadas",
		"enc",
		"huevon",
		"huevonada",
		"huevonear",
		"webon",
		"webos",
		"mishuevos",
		"guey",
		"golfa",
		"golfas",
		"idiota",
		"idiotas",
		"imbecil",
		"imbécil",
		"imbeciles",
		"imbéciles",
		"imbesil",
		"imbésiles",
		"joterias",
		"joteria",
		"joder",
		"jodete",
		"madrear",
		"madreado",
		"madreados",
		"madreada",
		"madreadas",
		"madriza",
		"mamar",
		"mamada",
		"mamado",
		"mamon",
		"mamadas",
		"mamados",
		"mames",
		"mamas",
		"mamamos",
		"mamaste",
		"mamo",
		"mentar",
		"mentada",
		"mientas",
		"mentando",
		"mento",
		"marica",
		"maricas",
		"maricon",
		"maricona",
		"mariconeria",
		"mariconerias",
		"mierda",
		"mierdas",
		"OGTS",
		"O.G.T",
		"ojete",
		"ojetes",
		"pedo",
		"pedote",
		"pedos",
		"pedotes",
		"pedin",
		"pendeja",
		"pendejo",
		"pendejas",
		"pendejos",
		"pendejada",
		"pitito",
		"pitote",
		"pinche",
		"pinches",
		"pija",
		"pijas",
		"pudrete",
		"puñetas",
		"puta",
		"puto",
		"putazo",
		"putiza",
		"putazos",
		"putisima",
		"putisimo",
		"putito",
		"putote",
		"verga",
		"vergas",
		"vergaso",
		"vergazo",
		"vergazos",
		"vergasos",
		"vergudo",
		"verguda",
		"vergudos",
		"wey",
		"wtf",
		"zorrear",
		"Responder",
		"joto",
		"Jundillo",
		"Perro",
		"Perramadre",
		"Desgraciado",
		"Culero",
		"Perrustico",
		"Putiar",
		"Perriar",
		"Culiar",
		"BRONCA",
		"BRONCAS",
		"BRONCUDO",
		"BRONCUDOS",
		"BRONCUDAS",
		"BOBO",
		"BOBA",
		"BOBOS",
		"BOBAS",
		"CABRON",
		"CABRONA",
		"CABRONES",
		"CACA",
		"CAGAR",
		"CAGADA",
		"CAGADO",
		"CAGADAS",
		"CAGADOS",
		"CAGANDO",
		"CARAJO",
		"CARAJOS",
		"CHINGA",
		"CHINGO",
		"CHINGAR",
		"CHINGAOS",
		"CHINGADO",
		"CHINGADA",
		"CHINGAMOS",
		"CHINGARON",
		"CHINGADERA",
		"CHINGADERAS",
		"CHINGON",
		"CHINGONA",
		"CHINGONES",
		"CHINGONERIA",
		"CHINGALE",
		"COJER",
		"COJIDO",
		"COJIDA",
		"COJIDITA",
		"COJIDITO",
		"COJEMOS",
		"COJEN",
		"COJIMOS",
		"COJI",
		"CULERA",
		"CULERO",
		"CULERADA",
		"CULERAS",
		"CULEROS",
		"CULO",
		"CULOTE",
		"CULON",
		"DESMADRAR",
		"DESMADRE",
		"DESMADRARSE",
		"DESMADRADO",
		"ENCABRONAR",
		"ENCABRONARSE",
		"ENCABRONADO",
		"ENCABRONADOS",
		"ENCABRONADA",
		"ENCABRONADAS",
		"ENC",
		"HUEVON",
		"HUEVONADA",
		"HUEVONEAR",
		"WEBON",
		"WEBOS",
		"MISHUEVOS",
		"GUEY",
		"GOLFA",
		"GOLFAS",
		"IDIOTA",
		"IDIOTAS",
		"IMBECIL",
		"IMBÉCIL",
		"IMBECILES",
		"IMBÉCILES",
		"IMBESIL",
		"IMBÉSILES",
		"JOTERIAS",
		"JOTERIA",
		"JODER",
		"JODETE",
		"MADREAR",
		"MADREADO",
		"MADREADOS",
		"MADREADA",
		"MADREADAS",
		"MADRIZA",
		"MAMAR",
		"MAMADA",
		"MAMADO",
		"MAMON",
		"MAMADAS",
		"MAMADOS",
		"MAMES",
		"MAMAS",
		"MAMAMOS",
		"MAMASTE",
		"MAMO",
		"MENTAR",
		"MENTADA",
		"MIENTAS",
		"MENTANDO",
		"MENTO",
		"MARICA",
		"MARICAS",
		"MARICON",
		"MARICONA",
		"MARICONERIA",
		"MARICONERIAS",
		"MIERDA",
		"MIERDAS",
		"OGTS",
		"O.G.T",
		"OJETE",
		"OJETES",
		"PEDO",
		"PEDOTE",
		"PEDOS",
		"PEDOTES",
		"PEDIN",
		"PENDEJA",
		"PENDEJO",
		"PENDEJAS",
		"PENDEJOS",
		"PENDEJADA",
		"PITITO",
		"PITOTE",
		"PINCHE",
		"PINCHES",
		"PIJA",
		"PIJAS",
		"PUDRETE",
		"PUÑETAS",
		"PUTA",
		"PUTO",
		"PUTAZO",
		"PUTIZA",
		"PUTAZOS",
		"PUTISIMA",
		"PUTISIMO",
		"PUTITO",
		"PUTOTE",
		"VERGA",
		"VERGAS",
		"VERGASO",
		"VERGAZO",
		"VERGAZOS",
		"VERGASOS",
		"VERGUDO",
		"VERGUDA",
		"VERGUDOS",
		"WEY",
		"WTF",
		"ZORREAR",
		"RESPONDER",
		"JOTO",
		"JUNDILLO",
		"PERRO",
		"PERRAMADRE",
		"DESGRACIADO",
		"CULERO",
		"PERRUSTICO",
		"PUTIAR",
		"PERRIAR",
		"CULIAR",
		"Bronca",
		"Broncas",
		"Broncudo",
		"Broncudos",
		"Broncudas",
		"Bobo",
		"Boba",
		"Bobos",
		"Bobas",
		"Cabron",
		"Cabrona",
		"Cabrones",
		"Caca",
		"Cagar",
		"Cagada",
		"Cagado",
		"Cagadas",
		"Cagados",
		"Cagando",
		"Carajo",
		"Carajos",
		"Chinga",
		"Chingo",
		"Chingar",
		"Chingaos",
		"Chingado",
		"Chingada",
		"Chingamos",
		"Chingaron",
		"Chingadera",
		"Chingaderas",
		"Chingon",
		"Chingona",
		"Chingones",
		"Chingoneria",
		"Chingale",
		"Cojer",
		"Cojido",
		"Cojida",
		"Cojidita",
		"Cojidito",
		"Cojemos",
		"Cojen",
		"Cojimos",
		"Coji",
		"Culera",
		"Culero",
		"Culerada",
		"Culeras",
		"Culeros",
		"Culo",
		"Culote",
		"Culon",
		"Desmadrar",
		"Desmadre",
		"Desmadrarse",
		"Desmadrado",
		"Encabronar",
		"Encabronarse",
		"Encabronado",
		"Encabronados",
		"Encabronada",
		"Encabronadas",
		"Enc",
		"Huevon",
		"Huevonada",
		"Huevonear",
		"Webon",
		"Webos",
		"Mishuevos",
		"Guey",
		"Golfa",
		"Golfas",
		"Idiota",
		"Idiotas",
		"Imbecil",
		"Imbécil",
		"Imbeciles",
		"Imbéciles",
		"Imbesil",
		"Imbésiles",
		"Joterias",
		"Joteria",
		"Joder",
		"Jodete",
		"Madrear",
		"Madreado",
		"Madreados",
		"Madreada",
		"Madreadas",
		"Madriza",
		"Mamar",
		"Mamada",
		"Mamado",
		"Mamon",
		"Mamadas",
		"Mamados",
		"Mames",
		"Mamas",
		"Mamamos",
		"Mamaste",
		"Mamo",
		"Mentar",
		"Mentada",
		"Mientas",
		"Mentando",
		"Mento",
		"Marica",
		"Maricas",
		"Maricon",
		"Maricona",
		"Mariconeria",
		"Mariconerias",
		"Mierda",
		"Mierdas",
		"Ogts",
		"O.g.t",
		"Ojete",
		"Ojetes",
		"Pedo",
		"Pedote",
		"Pedos",
		"Pedotes",
		"Pedin",
		"Pendeja",
		"Pendejo",
		"Pendejas",
		"Pendejos",
		"Pendejada",
		"Pitito",
		"Pitote",
		"Pinche",
		"Pinches",
		"Pija",
		"Pijas",
		"Pudrete",
		"Puñetas",
		"Puta",
		"Puto",
		"Putazo",
		"Putiza",
		"Putazos",
		"Putisima",
		"Putisimo",
		"Putito",
		"Putote",
		"Verga",
		"Vergas",
		"Vergaso",
		"Vergazo",
		"Vergazos",
		"Vergasos",
		"Vergudo",
		"Verguda",
		"Vergudos",
		"Wey",
		"Wtf",
		"Zorrear",
		"Responder",
		"Joto",
		"Jundillo",
		"Perro",
		"Perramadre",
		"Desgraciado",
		"Culero",
		"Perrustico",
		"Putiar",
		"Perriar",
		"Culiar"
		];

		var prohibidas = document.getElementById("CompanyJobProfileJobName").value.split(' ');
		var respuesta = false;

		for (var i= 0;i <palabras.length; i++) {
		    for (var n = 0; n < prohibidas.length; n++) {
		    	if (prohibidas[n] == palabras[i]){
		    		respuesta = true;
		    	}
		   }
		}

		for (var n = 0; n < palabras.length; n++) {
		    if (palabras[n] == $('#CompanyJobProfileJobName').val()){
		    	respuesta = true;
		    }
		}
		   
		return respuesta;
	}

	function validateInputs(){
		if(document.getElementById("CompanyJobProfileDisability").value == 's') {  
				var disabilityValue = 's';  
			} else if(document.getElementById("CompanyJobProfileDisability").value == 'n'){
				   var disabilityValue = 'n'; 
			}else{
				
				var disabilityValue = '';   
			}

		
		var fecha = document.getElementById('CompanyJobProfileExpirationDay').value	+ "/" +
					document.getElementById('CompanyJobProfileExpirationMonth').value	+ "/" +
					document.getElementById('CompanyJobProfileExpirationYear').value;
	
		vigenciaFecha = validarFecha(fecha);
		fechaMaxima = fechaMax(fecha);
		prohibidasPalabras = listaprohibida();

		if ((disabilityValue == 's') && (document.getElementById('CompanyJobProfileDisabilityType').value == '')){
			//jAlert('Seleccione un tipo de discapacidad', 'Mensaje');
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione un tipo de discapacidad'});
			document.getElementById('CompanyJobProfileDisabilityType').focus();
			return false;
		}else
		if(vigenciaFecha == false){
		//	jAlert('La fecha de vigencia es incorrecta', 'Mensaje');
			$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de vigencia es incorrecta'});
			document.getElementById('CompanyJobProfileExpirationDay').focus();
			return false;
		}else
		if(fechaMaxima == false){
			<?php if((($this->Session->read('Auth.User.role')=='administrator') OR ($this->Session->read('Auth.User.role')=='subadministrator')) OR (!isset($this->request->data['CompanyJobProfile']['created']))): ?>
				//	jAlert('La fecha de vigencia es de máximo 1 mes respecto a la fecha actual', 'Mensaje');
			$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de vigencia es de máximo 1 mes respecto a la fecha actual'});
			<?php else: ?>
					//jAlert('La fecha de vigencia es de máximo 1 mes respecto a la fecha de creación de la oferta', 'Mensaje');
			$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de vigencia es de máximo 1 mes respecto a la fecha de creación de la oferta'});
			<?php endif; ?>		
			document.getElementById('CompanyJobProfileExpirationDay').focus();
			return false;
		}else
		if(prohibidasPalabras == true){
		//	jAlert('El nombre del puesto no está permitido', 'Mensaje');
			$.alert({ title: '!Aviso!',type: 'blue',content: 'El nombre del puesto no está permitido'});
			document.getElementById('CompanyJobProfileJobName').focus();
			return false;
		}else{
			return true;
		}
		
		

	}
	
	
	</script>
	
<div class="col-md-12">

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
									'action' => 'CompanyJobProfile',
								'onsubmit' =>'return validateInputs();']); ?>
	<fieldset>
		<div class="col-md-6">
			<div class="col-md-12">
					<?php echo $this->Form->input('CompanyJobProfile.id'); ?>
					<?= $this->Form->input('CompanyJobProfile.job_name', ['placeholder' => 'Puesto']); ?>
					<?php echo $this->Form->input('CompanyJobProfile.equivalent_job',['type' => 'hidden','placeholder' => 'Puesto equivalente en el mercado','options' => $Puestos,'default'=>'0', 'empty' => 'Puesto equivalente en el mercado']); ?>
					<?= $this->Form->input('CompanyJobProfile.vacancy_number', ['placeholder' =>'Número de vacantes','type'=>'number']); ?>
					<?= $this->Form->input('CompanyJobProfile.rotation', ['type'=>'select','options' => $Giros,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Giro de interés']); ?>
					<?= $this->Form->input('CompanyJobProfile.interest_area', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Área de interés']); ?>		
					<?= $this->Form->input('CompanyJobProfile.experience_area', ['type'=>'select','options' => $tiemposExperiencia,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Experiencia']); ?>
			</div>		
		</div>
	

		<div class="col-md-6">
		<div class="col-md-12">
		
			<?= $this->Form->input('CompanyJobProfile.activity', ['placeholder' => 'Actividades a desarrollar...','style' => ' max-height: 280px; margin-top: 0px;','maxlength' => '1000',]); ?>
		
			<div class="col-md-12" style="text-align: right;">
				<span id="contadorTaComentario">0/1000</span><span> caracteres máx.</span>
			</div>
		
		</div>
			<div class="col-md-12">
				<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('CompanyJobProfile.disability', ['type' => 'select','default'=> 0,'empty' => '¿Oferta incluyente?','options' => $options,'onchange' => 'desabilityMobility()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
				?>
				<div id="tipoDiscapacidadId" style="display:none">
					<?php 
						echo $this->Form->input('CompanyJobProfile.disability_type', ['type' => 'select','default'=> 0,'empty' => 'Tipo de discapacidad','options' => $TiposDiscapacidad,'class' => 'selectpicker show-tick form-control show-menu-arrow']);
					?>
				</div>
				<?= $this->Form->input('CompanyJobProfile.expiration', [
												'class' => 'selectpicker show-tick form-control show-menu-arrow',
												'data-width'=> '140px',
												'dateFormat' => 'YMD',
												'separator' => '',
												'minYear' => date('Y') - -2,
												'maxYear' => date('Y') - 0,
												'maxYear' => date('Y') - 0]); 
				?>	
			</div>
		

		</div>	
	</fieldset>	
</div>

	<div class="col-md-12 text-center">
		<?= $this->Form->button('<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar',['type'=>'submit','class' => 'btn btn-primary btn-bti','escape' => false]);?>

		<?= $this->Form->end(); ?>

		<!-- <?= $this->Html->link('Continuar&nbsp;<i class="glyphicon glyphicon-arrow-right"></i>',
														['controller'=>'Companies',
														'action'=>'CompanyJobContractType',1],
														['class' => 'btn btn-default',
														'escape' => false]); ?>  -->
	</div>
