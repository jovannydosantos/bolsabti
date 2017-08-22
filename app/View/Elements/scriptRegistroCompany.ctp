<script type="text/javascript">

	$("#estado").on('change',function (){
		if($("#estado").val() != 0)
		{	
			$('#loading').show();
			$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
			{	
				$('#ciudad').empty();
				$('#ciudad').append('<option value="">Delegación / Municipio</option>');

				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});	

				$.each(JSON, function(key, val){
					$('#ciudad').append('<option value="' + val.mun + '">' + val.mun + '</option>');
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
					}
				});
			});	
		}
		else
		{
			$('#ciudad').empty();
			$('#ciudad').append('<option value="">Delegación / Municipio</option>');
			$('.selectpicker').selectpicker('refresh');
		}
	});	

	$("#estado2").on('change',function (){
		if($("#estado2").val() != 0)
		{	
			$('#loading').show();
			$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado2 option:selected").text() },function(JSON)
			{	
				$('#ciudad2').empty();
				$('#ciudad2').append('<option value="">Delegación / Municipio</option>');

				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});	

				$.each(JSON, function(key, val){
					$('#ciudad2').append('<option value="' + val.mun + '">' + val.mun + '</option>');
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
					}
				});
			});	
		}
		else
		{
			$('#ciudad2').empty();
			$('#ciudad2').append('<option value="">Delegación / Municipio</option>');
			$('.selectpicker').selectpicker('refresh');
		}
	});	

		// Carga automática de las ciudades si es que existe un estado seleccionado (AUTOMÁTICO)
		if($("#estado").val() != 0)
		{	
			$('#loading').show();
			$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
			{	
				$('#ciudad').empty();
				$('#ciudad').append('<option value="">Delegación / Municipio</option>');

				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});	

				$.each(JSON, function(key, val){
					if(val.mun == '<?php echo (isset($this->request->data['CompanyProfile']['city']) and ($this->request->data['CompanyProfile']['city'] <> '')) ? $this->request->data['CompanyProfile']['city']: ''; ?>'){
						$('#ciudad').append('<option value="' + val.mun + '" selected>' + val.mun + '</option>');
					}else{
						$('#ciudad').append('<option value="' + val.mun + '">' + val.mun + '</option>');
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
			$('#ciudad').empty();
			$('#ciudad').append('<option value="">Delegación / Municipio</option>');
			$('.selectpicker').selectpicker('refresh');
		}
		
		if($("#estado2").val() != 0)
		{	
			$('#loading').show();
			$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
			{	
				$('#ciudad2').empty();
				$('#ciudad2').append('<option value="">Delegación / Municipio</option>');

				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});	

				$.each(JSON, function(key, val){
					if(val.mun == '<?php echo (isset($this->request->data['CompanyProfile']['city_sede']) and ($this->request->data['CompanyProfile']['city_sede'] <> '')) ? $this->request->data['CompanyProfile']['city_sede']: ''; ?>'){
						$('#ciudad2').append('<option value="' + val.mun + '" selected>' + val.mun + '</option>');
					}else{
						$('#ciudad2').append('<option value="' + val.mun + '">' + val.mun + '</option>');
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
			$('#ciudad2').empty();
			$('#ciudad2').append('<option value="">Delegación / Municipio</option>');
			$('.selectpicker').selectpicker('refresh');
		}


		function condiciones(){
			if(document.getElementById('CompanyFile').value == ''){
				jAlert ('Favor de adjuntar Cédula de Identificación Fiscal');
				document.getElementById('CompanyFile').scrollIntoView();
				return false;
			} else
			if(document.getElementById('CompanyFilename').value == ''){
				jAlert ('Favor de adjuntar el logotipo de la empresa');
				document.getElementById('CompanyFilename').scrollIntoView();
				return false;
			}
			else if( $('#terminos').is(':checked') ) {
				return true;
			} else {
				jAlert('Aún no ha aceptado los  términos  y condiciones del SISBUT. Los puede consultar en la liga en azul: “Leer Aviso de Privacidad”');
				document.getElementById('terminos').focus();
				return false;
			}
		}

		function sendRfc(){
			document.getElementById('CompanyUsername').value = document.getElementById('CompanyProfileRfc').value;
		}

		function addhttp(){
			var urlpattern = new RegExp('(http|ftp|https)://[a-z0-9\-_]+(\.[a-z0-9\-_]+)+([a-z0-9\-\.,@\?^=%&;:/~\+#]*[a-z0-9\-@\?^=%&;/~\+#])?', 'i')
			var txtfield = $('#CompanyProfileWebSite').val() /*this is a textarea*/

			if(txtfield!=''){
				if ( !urlpattern.test(txtfield) ){
					document.getElementById('CompanyProfileWebSite').value = "http://" + txtfield;
				}
			}
		}

		function clonarDireccion(){
			document.getElementById('CompanyProfileStreetSede').value = document.getElementById('CompanyProfileStreet').value;
			document.getElementById('estado2').options[$("#estado option:selected").index()].selected = 'selected';
			if($("#estado2").val() != 0)
			{	
				$('#loading').show();
				$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
				{	
					$('#ciudad2').empty();
					$('#ciudad2').append('<option value="">Delegación / Municipio</option>');

					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});

					$.each(JSON, function(key, val){
						if(val.mun == $("#ciudad option:selected").text()){
							$('#ciudad2').append('<option value="' + val.mun + '" selected>' + val.mun + '</option>');
						}else{
							$('#ciudad2').append('<option value="' + val.mun + '">' + val.mun + '</option>');
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
				$('#ciudad2').empty();
				$('#ciudad2').append('<option value="">Delegación / Municipio</option>');
				$('.selectpicker').selectpicker('refresh');
			}
			document.getElementById('CompanyProfileSubdivisionSede').value = document.getElementById('CompanyProfileSubdivision').value;
			document.getElementById('CompanyProfileZipSede').value = document.getElementById('CompanyProfileZip').value;

			return false;
		}
</script>