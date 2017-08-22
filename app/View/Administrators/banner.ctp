	<?php 
		$this->layout = 'administrator'; 
	?>

	<style>
	  #sortable1, #sortable2 {
		width: 142px;
		min-height: 20px;
		list-style-type: none;
		margin: 0;
		padding: 5px 0 0 0;
		float: left;
		margin-right: 10px;
		color: #FFB71F;
	  }
	  #sortable1 li, #sortable2 li {
		margin: 0px;
		padding: 5px;
		width: 120px;
		display: inline;
		text-align: center;
		
	  }
	  .cursor {
		  // cursor: move;
		  font-size: 10px;
		  color: #fff;
	  }
	</style>
	
	<script>

		$(document).ready(function() {
			init_contadorTa("BannerDescription","contadorTaComentario", 210);
			updateContadorTa("BannerDescription","contadorTaComentario", 210);
			
			var file = document.getElementById("BannerFilename"); //El input de tipo
			file.addEventListener("change", function(){
					var fileSize = this.files[0].size; //Tamaño del archivo en Bytes
					var mb = 1024, //Cantidad de Bytes en 1 kb
					pesoFinal = fileSize / mb; //Tamaño del archivo en Megabytes
					if(pesoFinal.toFixed(2)>100){
						jAlert('Tu imagen de banner con: '+pesoFinal.toFixed(2) + ' Kb excede el límite permitido de 100kb','Mensaje');
						deleteImg();
						return false;
					} else{
						changeImg()
					}
			}, false);
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

		  // $(function() {
			// $( "#sortable1").sortable({
			  // connectWith: ".connectedSortable"
			// }).disableSelection();
		  // });
		
		
		function deleteImg(){
			$("#image-container").removeAttr('src', '');
			document.getElementById("image-container").style.display = "none";
			document.getElementById("deleteImgId").style.display = "none";
			document.getElementById('BannerFilename').value = '';  
			document.getElementById('BannerDir').value = '';
			document.getElementById('BannerMimetype').value = '';
			document.getElementById('BannerFilesize').value = '';
			return false;
		}
		
		function changeImg(){
			document.getElementById("deleteImgId").style.display = "initial";
			
			var archivo = document.getElementById('BannerFilename').value;
			extensiones_permitidas = new Array(".jpg",".jpeg",".png",".gif");
			mierror = "";
			
			if (!archivo) {
					deleteImg();
					jAlert ('Seleccione la imagen de banner a subir','Mensaje');
					document.getElementById('BannerFilename').scrollIntoView();
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
						deleteImg();
						jAlert('Compruebe la extensión de su imagen de banner a subir. \nSólo se pueden subir imagenes con extensiones: ' + extensiones_permitidas.join(),'Mensaje');
						document.getElementById('BannerFilename').scrollIntoView();
						return false;
					} else {
								var fileInput = document.getElementById('BannerFilename');
								var image = document.getElementById('image-container');
								var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
								image.src = fileUrl;
								document.getElementById("image-container").style.display = "initial";
								
								// setInterval(function(){ alerta(); }, 500); ejecuta la funcion en un intervalo 
								
								// $("#image-container").css("width", "150px");
								// $("#image-container").css("height", "150px");
					}
			   }
		}
		
		function alerta(){
			jAlert('Si manda');
			if(((document.getElementById('image-container').width) > 300) || (document.getElementById('image-container').height > 300)){
				jAlert('La imagen posee medidas diferentes a las sugeridas 300px x 300px','Mensaje');
				deleteImg();
				return false;
			}
		}
		
		function deleteBanner(param){
				document.getElementById('deleteBannerFocus'+param).scrollIntoView();
				jConfirm('¿Realmente desea eliminar la imagen de banner?', 'Confirmación', function(r){
					if( r ){						
						$("#deleteBannerId"+param).click();
					}
				});
		}
		
		function addhttp(){
			var urlpattern = new RegExp('(http|ftp|https)://[a-z0-9\-_]+(\.[a-z0-9\-_]+)+([a-z0-9\-\.,@\?^=%&;:/~\+#]*[a-z0-9\-@\?^=%&;/~\+#])?', 'i')
			var txtfield = $('#BannerWebSite').val() /*this is a textarea*/
			
			if(txtfield!=''){
				if ( !urlpattern.test(txtfield) ){
					document.getElementById('BannerWebSite').value = "http://" + txtfield;
				}
			}
		}
			
	</script>
	
	<?php echo $this->Session->flash(); ?>
	
	<div class="col-md-12" style="background-color: #002377;  margin-top: 35px; padding-left: 0px; padding-right: 0px;">
		<ul id="sortable2"class="list-inline" style="height: 40px; width:100%; margin-top: 10px;">
		  <li class="col-md-2">Banner 1</li>
		  <li class="col-md-2">Banner 2</li>
		  <li class="col-md-2">Banner 3</li>
		  <li class="col-md-2">Banner 4</li>
		  <li class="col-md-2">Banner 5</li>
		  <li class="col-md-2">Banner 6</li>
		</ul>
		<ul id="sortable1" class="list-inline" style="min-height: 200px; width:100%;">

		<?php for($i=1; $i<=6; $i++): 
				$empty = 0; 
				foreach($imagenesBanner as $imagenBanner): 
					if($imagenBanner['Banner']['id'] == $i): 
						$empty = 1; 
						$url = $this->webroot."img/uploads/banner/filename/".$imagenBanner['Banner']['filename']; ?>
						<li class="ui-state-default col-md-2 cursor"><div>
						
						<div style="position: absolute; right: 0px; margin-top: -11px;">
							<span id="deleteBannerFocus<?php echo $imagenBanner['Banner']['id']; ?>" title='Eliminar imagen' style="margin-top: 5px; width: 170px; cursor: pointer; color: #fff;" onclick="deleteBanner(<?php echo $imagenBanner['Banner']['id']; ?>);"><i class="glyphicon glyphicon-remove-circle"></i></span>
									<?php					
											echo $this->Form->postLink(
												'<i class="glyphicon glyphicon-remove-sign"></i>&nbsp;',							
													array(
														'controller'=>'Administrators',
														'action'=>'deleteBannerImage',$imagenBanner['Banner']['id'],
														),
													array(
														'title' => 'Eliminar imagen de banner',
														'escape' => false,
														'style' => 'display: none',
														'id'=>'deleteBannerId'.$imagenBanner['Banner']['id'],
														)	
											); 	
									?>
						</div>
						<?php 
							if($imagenBanner['Banner']['web_site']<>''):
								echo '<a href="'.$imagenBanner['Banner']['web_site'].'" target="_blank" title="'.$imagenBanner['Banner']['web_site'].'">';
							endif;
						?>
						<img src="<?php echo $url; ?>" style="width: 150px; height: 150px;"/>
						<?php 
							if($imagenBanner['Banner']['web_site']<>''):
								echo '</a>';
							endif;
						?>
						</div><div style="margin-top: 10px;"> <?php echo $imagenBanner['Banner']['description']; ?> </div></li>
						
		<?php   	endif; 
			
				endforeach; 
				
				if($empty == 0): 
		?>
					<li class="ui-state-default col-md-2 cursor"><div><img src="<?php echo $this->webroot; ?>/img/home/150.png" alt="..."></div><div style="margin-top: 10px;"> </div></li>
		<?php   
				endif; 
			endfor; 
		 ?>
		 
		</ul>
	</div>
				
				
	<div class="col-md-12"  style="margin-top: 100px;">
		
			<?php
				echo $this->Form->create('Administrator', array(
														'type' => 'file',
														'class' => 'form-horizontal', 
														'role' => 'form',
														'inputDefaults' => array(
																'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																'div' => array('class' => 'form-group'),
																'class' => 'form-control',
																'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" >',
																'between' => '<div class="col-md-11 ">',
																'after' => '</div></div>',
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
														),
												'action' => 'banner',
												'onsubmit' =>'return changeImg();'
									)); 
			?>
			<fieldset>
				<div class="col-md-6 col-md-offset-1">
				
					<?php 	$posiciones = array('1' => 'Banner 1','2' => 'Banner 2','3' => 'Banner 3','4' => 'Banner 4','5' => 'Banner 5','6' => 'Banner 6');
							echo $this->Form->input('Banner.id', array(				
								'type'=>'select',
								'class' => 'selectpicker show-tick form-control show-menu-arrow',
								'before' => '<div class="col-md-12 " >',
								'label' => array(
												'class' => 'col-md-0 col-md-offset-0 control-label',
												'text' => '',),
								'placeholder' => 'Tipo',
								'options' => $posiciones,'default'=>'0', 'empty' => 'Posición del banner',								
					)); ?>
					<?php echo $this->Form->input('Banner.web_site', array(
								'type' => 'text',
								'before' => '<div class="col-md-12 " >',
								'label' => array(
												'class' => 'col-md-0 col-md-offset-0 control-label',
												'text' => '',),
								'placeholder' => 'Sitio web',
								'onblur' => 'addhttp()'
					)); ?>
					<?php 	echo $this->Form->input('Banner.description', array(
													'maxlength' => '210',
													'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="Ingresar una leyenda introductoria para el banner" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 100px;">',
													'style' => 'resize: vertical; min-height: 120px;  max-height: 300px; height: 120px;',
													'label' => array(
																	'class' => 'col-md-0 col-md-offset-0 control-label',
																	'text' => '',),
													'placeholder' => 'Pie de banner',
									)); 
					?>
					<div class="col-md-11" style="text-align: right; right; top: -10px;">
						<span id="contadorTaComentario">0/1000</span><span> caracteres máx.</span>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="col-md-12" style="left: 33px;">
						<div class="col-md-12">
							<center>
								<img id="image-container" style="margin-left: -30px; margin-bottom: 15px; width: 150px; height: 150px;"/>
								<button id="deleteImgId" class='btn btnRed btn-default' onclick="deleteImg(); return false;" style="display: none">x</button>
							</center>
						</div>
						
						<label for="BannerFilename" style=" cursor:pointer;">
							&nbsp;<img src="/unam/img/administrator/uploadImage.png" style="position: relative; height: 35px; left: 10px;"/><span style="color: #fff; font-weight: lighter;  margin-left: 165px;"></span>
						</label>
						
						
						<?php echo $this->Form->input('Banner.filename', array(
										'type' => 'file',
										'label' => '',
										'before' => '<div style=" margin-top: -25px;">',
										'style' => 'display: none',
										// 'onchange' => 'changeImg()'
						)); ?>
						
					</div>
					
					<div class="col-md-12" style="margin-top: 15px; text-align: center;">
						<p>Dimensión sugerida: 300x300px</p>
						<p>Tamaño máx.: 100Kb</p>
						<p>Formatos: .jpg, .png y .gif</p>
					</div>

					<?php 	echo $this->Form->input('Banner.dir', array(
										'type' => 'hidden',			
										'label' => array(
											'class' => 'col-md-2 control-label col-md-offset-2',
											'text' => 'Dirección de la imagen',),
										'placeholder' => 'Dirección de la imagen',
					)); ?>	
					<?php 	echo $this->Form->input('Banner.mimetype', array(	
										'type' => 'hidden',				
										'label' => array(
											'class' => 'col-md-2 control-label col-md-offset-2',
											'text' => 'Tipo de imagen',),
										'placeholder' => 'Tipo de imagen',
					)); ?>	
					<?php 	echo $this->Form->input('Banner.filesize', array(	
										'type' => 'hidden',				
										'label' => array(
											'class' => 'col-md-2 control-label col-md-offset-2',
											'text' => 'Tamaño de la imagen',),
										'placeholder' => 'Tamaño de la imagen',
					)); ?>	
				</div>
				
			</fieldset>
				
				

			<div style="margin-top: 20px;" class="col-md-8 col-md-offset-0">
				<?php 
					echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp; Guardar', array(
													'type' => 'submit', 
													'div' => 'form-group',
													'class' => 'btn btnRed btn-default col-md-offset-5',
													'escape' => false,
					));
								
					echo $this->Form->end(); 
				?>
			</div>
	</div>