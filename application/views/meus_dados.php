<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?= base_url('Painel') ?>">
				<em class="fa fa-home"></em>
			</a>
		</li>
		<li>
			<a href="">
				<em class="fa fa-user active"> Meus dados</em>
			</a>
		</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Meus dados</h1>
		<?php getMensagem($this->session) ?>
		<a href="<?= base_url('Painel/alterar_senha') ?>" class="btn btn-lg btn-primary"><em class="fa fa-lock"></em> Alterar senha</a><br><br><br>
	</div>
</div><!--/.row-->

<div class="panel panel-primary ">
	<div class="panel-heading">
		Meus dados
	</div>
	<div class="panel-body">


		<form action="<?= base_url('Congressista/atualiza') ?>" method="POST">
			<div class="col-md-6">
				<label for="nome">Nome completo</label>
				<input type="text" class="form-control" name="nome" id="nome" value="<?= $congressista->nome ?>" required>
			</div>
			<div class="col-md-6">
				<label for="apelido">Apelido</label>
				<input type="text" class="form-control" name="apelido" id="apelido" value="<?= $congressista->apelido ?>" required>
			</div>
			<div class="col-md-6">
				<label for="rg">RG</label>
				<input type="text" class="form-control" name="rg" id="rg" value="<?= $congressista->rg ?>" required>
			</div>
			<div class="col-md-6">
				<label for="celular">Celular</label>
				<input type="text" class="form-control" name="celular" id="celular" value="<?= $congressista->celular ?>" required>
			</div>
			<div class="col-md-6">
				<label for="cpf">CPF</label>
				<input type="text" class="form-control" name="cpf" id="cpf" value="<?= $congressista->cpf ?>" required>
			</div>
			<div class="col-md-6">
				<label for="empresa_junior">Empresa Júnior</label>
				<input type="text" class="form-control" name="empresa_junior" id="empresa_junior" value="<?= $congressista->empresa_junior ?>" required>
			</div>
			<div class="col-md-6">
				<label for="filiada">Sua EJ é filiada?</label>
				<select name="filiada" id="filiada" class="form-control" style="height: 50px;" required>
					<option <?php if($congressista->filiado_nucleo == 1) echo"selected"; ?> value="1">Sim</option>
					<option <?php if($congressista->filiado_nucleo == 0) echo"selected"; ?> value="0">Não</option>
				</select>
			</div>
			<div class="col-md-6">
				<label for="restricao">Você possúi alguma restrição alimentar?</label>
				<select name="restricao" id="restricao" class="form-control" style="height: 50px;" required>
					<option <?php if($congressista->restricao_alimentar == 1) echo"selected"; ?> value="1">Sim</option>
					<option <?php if($congressista->restricao_alimentar == 0) echo"selected"; ?> value="0">Não</option>
				</select>
			</div>
			<div class="col-md-12" id="div_descricao_restricao">
				<label for="descricao_restricao">Quais?</label>
				<textarea name="descricao_restricao" id="descricao_restricao" cols="30" rows="10" class="form-control"><?= $congressista->descricao_restricao_alimentar ?></textarea>
			</div>



			<div class="col-md-12">
				<br>
				<input type="submit" class="btn btn-primary btn-lg pull-right" value="Editar">
			</div>

		</form>
	</div>
</div>

<script src="<?= base_url('assets/js/jquery.maskedinput.min.js') ?>"></script>

<script>
	var div_descricao_restricao = $('#div_descricao_restricao');
	var select_restricao = $('#restricao');

	$(document).ready(function(){
		$('#rg').mask('99.999.999-9');
		$('#cpf').mask('999.999.999-99');
		$('#celular').mask('(99) 99999-9999');

		if(select_restricao.val() == 1){
			div_descricao_restricao.show();
		}else{
			$('#descricao_restricao').val("");
			div_descricao_restricao.hide();
		}
	});

	select_restricao.change(function(){
		if(select_restricao.val() == 1){
			div_descricao_restricao.show();
		}else{
			$('#descricao_restricao').val("");
			div_descricao_restricao.fadeOut('slow');
		}
	});
</script>
