<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?= base_url('Painel') ?>">
				<em class="fa fa-home"></em>
			</a>
		</li>
		<li>
			<a href="<?= base_url('Painel/meus_dados') ?>">
				<em class="fa fa-user"></em>
			</a>
		</li>
		<li>
			<a href="">
				<em class="fa fa-lock active">  Alterar senha</em>
			</a>
		</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Alterar senha</h1>
		<?php getMensagem($this->session) ?>
		<a href="<?= base_url('Painel/meus_dados') ?>" class="btn btn-primary"><em class="fa fa-undo"></em> Voltar</a><br><br><br>
	</div>
</div><!--/.row-->


<div class="panel panel-primary ">
	<div class="panel-heading">
		Alterar senha
	</div>
	<div class="panel-body">

		<form action="<?= base_url('Congressista/alterar_senha') ?>" method="POST">
			<div class="col-md-4">
				<label for="nova_senha">Nova senha</label>
				<input type="password" class="form-control" name="nova_senha" id="nova_senha" required>
			</div>
			<div class="col-md-4">
				<label for="nova_senha_2">Repita a nova senha</label>
				<input type="password" class="form-control" name="nova_senha_2" id="nova_senha_2" required>
			</div>
			<div class="col-md-4">
				<br>
				<input type="submit" class="btn btn-primary btn-lg" value="Alterar">
			</div>
		</form>
	</div>
</div>
<script>

</script>
