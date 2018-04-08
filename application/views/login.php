<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcomej - Login</title>
	<link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/datepicker3.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body style="background-image: url(<?= base_url('assets/img/bg-login.jpeg') ?>);">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">ENTRAR</div>
				<?php getMensagem($this->session); ?>
				<div class="panel-body">
					<form action="<?= base_url('Login/logar') ?>" method="POST">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Senha" name="senha" type="password" value="">
							</div>
							<button class="btn btn-primtrar">Entrar</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	


	<script src="<?= base_url('assets/js/jquery-1.11.1.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>
