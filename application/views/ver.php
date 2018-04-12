<?php 
if($palestra->periodo_palestra == 1){
	$hora = "08:00";
}else if($palestra->periodo_palestra == 2){
	$hora = "14:30";
}else{
	$hora = "19:00";
}
if($palestra->dia_palestra == 1){
	$dia = "21/03";
}else if($palestra->periodo_palestra == 2){
	$dia = "22/03";
}else{
	$dia = "23/03";
}
?>
<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?= base_url('Painel') ?>">
				<em class="fa fa-home"></em>
			</a>
		</li>
		<li>
			<a href="<?= base_url('Painel/selecionar') ?>">
				<em class="fa fa-calendar"></em>
			</a>
		</li>
		<li>
			<a href="">
				<em class="fa fa-eye active">  Ver</em>
			</a>
		</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ver palestra</h1>
		<?php if($inscrito){ ?>
		<div class="alert bg-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>ATENÇÃO!</strong> Você já está inscrito nessa palestra.
		</div>
		<?php } ?>
		<?php getMensagem($this->session) ?>
		<a href="<?= base_url('Painel/selecionar') ?>" class="btn btn-lg btn-primary"><em class="fa fa-undo"></em> Voltar</a><br><br><br>
	</div>
</div><!--/.row-->


<div class="panel panel-primary ">
	<div class="panel-heading">
		Informações
	</div>
	<div class="panel-body">
		<div class="col-md-4 pull-right"><img src="<?= base_url('uploads/'.$palestra->id_palestra.".jpg") ?>" class="img-responsive"></div>
		<h1 align="center"><?= $palestra->nome_palestra ?></h1>
		<h3 class="text-muted">Por: <?= $palestra->ministrante ?></h3>

		<p style="text-indent: 30px; text-align: justify;"><?= $palestra->descricao_palestra ?></p>
		<ul>
			<li><strong>Dia: </strong><?= $dia ?></li>
			<li><strong>Hora: </strong><?= $hora ?></li>
		</ul>
		<?php if(!$inscrito){ ?>
		<a href="<?= base_url('Congressista/inscrever/'.$palestra->id_palestra) ?>" class="btn btn-warning btn-lg">INSCREVER-SE</a>
		<?php } ?>
	</div>
</div>
<script>

</script>
