<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?= $this->Html->charset(); ?>

	<title>
		<?= 'Bolsa bti' ?>
	</title>

	<?= $this->Html->meta([
		'name' => 'viewport', 
		'content' => 'width=device-width, initial-scale=1', 
		'http-equiv' => "X-UA-Compatible"
		]); ?>

	<?= $this->Html->meta ( 'favicon.ico', '/img/SISBUTicon.png', array (
		'type' => 'icon' 
		) ); ?>
	<?= $this->Html->css(['bootstrap-select.min','bootstrap.min','fileinput.min','bootstrap-responsive.min','btiStyle','jquery.alerts','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.css']) ?>
	<?= $this->Html->script(['jquery-3.1.1.min','bootstrap.min','fileinput.min','bootstrap-select.min','jquery.alerts','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.js']) ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>		

</head>
<body>

	<?php echo $this->Session->flash(); ?>

	<?php echo $this->fetch('content'); ?> 

	<!--Pie de página-->
	<div class="col-md-12 whiteText" style="text-align: center; background-color: #1a75bb; margin-top: 15px;  position:fixed;left:0px;bottom:0px;height:30px;width:100%;">
		<p style="margin: 7px;">Hecho en México, todos los derechos reservados.</p>
	</div>

	<div id="aviso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" >
		<div class="modal-content" >
			<div class="modal-header fondoBti">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel" style="color: #fff;">Aviso de privacidad</h4>
			</div>
			<div class="modal-body fondoBti" style=" height: 70vh;">
					<iframe src="http://localhost/bolsabti/files/pdf/avisoPrivacidad.pdf" width="100%" height="100%" frameborder="0" allowtransparency="true">Your browser does not support inline frames or is currently configured not to display inline frames.</iframe>
			</div>
			<div class="modal-footer fondoBti">
				<button type="button" class="btn btn-default btnBlue" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	  </div>
	</div>

	<video preload autoplay autoplay="autoplay" loop="loop" poster="img/background/background-photo-mobile-devices.png" width="640" height="360">
	    <source src="video/video.mp4" type="video/mp4">
	    <source src="video/video.webm" type="video/webm">
	    <source src="video/video.ogv" type="video/ogg">
	 	Tu navegador no soporta HTML5 Video  
	</video>

    <script type="text/javascript">
       $('.alert').animate({opacity: 1.0}, 10000).fadeOut("slow","swing");  
       $('[data-toggle="tooltip"]').tooltip(); 
    </script>

</body>
</html>
