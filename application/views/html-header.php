<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcomej</title>
	<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/datepicker3.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet">
	<link rel="icon" type="imagem/png" href="<?= base_url('assets/img/logo.png');?>" />

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
<![endif]-->

<script src="<?= base_url('assets/js/jquery-1.11.1.min.js') ?>"></script>
</head>
<!-- <body> -->
<body style="background-image: url(<?= base_url('assets/img/login.jpg') ?>); background-size: 20%;">


<div id="preloader">
	<div class="inner">
		<div class="bolas">
			<div></div>
			<div></div>
			<div></div>                    
		</div>
	</div>
</div>
<script>
	$(window).on('load', function () {
		$('#preloader .inner').delay(1000).fadeOut();
		$('#preloader').delay(350).fadeOut('slow'); 
		$('body').delay(350).css({'overflow': 'visible'});
	})
</script>