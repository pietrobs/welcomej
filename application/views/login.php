<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcomej - Login</title>
	<link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/datepicker3.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet">
	<link rel="icon" type="imagem/png" href="<?= base_url('assets/img/logo-short.png');?>" />
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body style="background-image: url(<?= base_url('assets/img/login.jpg') ?>); background-size: 50%;">

	<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-dafult" style="background-color: rgba(255,255,255,.9);">
			<div class="panel-heading" align="center">PAINEL DO PARTICIPANTE</div>
			<div class="panel-body">
				<form action="<?= base_url('Login/logar') ?>" method="POST">
					<img src="<?= base_url('assets/img/logo.png') ?>" class="img-responsive">
					<?php getMensagem($this->session); ?>
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Senha" name="senha" type="password" value="">
						</div>
						<button class="btn btn-lg btn-primary">Entrar</button>
						<a style="cursor: pointer;" class="pull-right" data-toggle="modal" data-target="#myModal">Esqueci minha senha</a>
					</fieldset>
				</form>
			</div>
		</div>
	</div><!-- /.col-->



	
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Esqueci minha senha</h4>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('Congressista/nova_senha') ?>" method="POST">
						<label for="email">E-mail</label>
						<input type="text" name="email" class="form-control"><br>

						<label for="cpf">CPF</label>
						<input type="text" name="cpf" id="cpf" class="form-control"><br>

						<input type="submit" class="btn btn-lg btn-primary" value="Enviar">
					</form>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>

		</div>
	</div>

	<script src="<?= base_url('assets/js/jquery-1.11.1.min.js') ?>"></script>
	<!-- <script src="<?= base_url('assets/js/jquery.maskedinput.min.js') ?>"></script>	 -->
	<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>

<script>
	// $(document).ready(function(){
	// 	$('#cpf').mask('999.999.999-99');
	// });
</script>