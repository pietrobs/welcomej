<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?= base_url('Painel') ?>">
				<em class="fa fa-home"></em>
			</a>
		</li>
		<li>
			<a href="">
				<em class="fa fa-calendar active"> Minicursos</em>
			</a>
		</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Minicursos que estou inscrito</h1>
		<?php getMensagem($this->session) ?>
	</div>
</div><!--/.row-->
<div class="col-md-12">
	<?php if(count($minhas_palestras) == 0){ ?>
	<div class="alert bg-warning alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Ops!</strong> Você ainda não se inscreveu em nenhum minicurso.
	</div>

	<?php }else if(count($minhas_palestras) == 5){ ?>
	<div class="alert bg-warning alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>ATENÇÃO</strong> Você já atingiu o limite de 5 inscrições.
	</div>
	<?php }else{ ?>
	<div class="alert bg-warning alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>ATENÇÃO</strong> Você já se inscreveu em <?= count($minhas_palestras); ?> minicurso(s). O limite é 5.
	</div>
<?php } ?>
<?php foreach($minhas_palestras as $palestra){ ?>

<!-- <a href="<?= base_url('Painel/ver/'.$palestra->id_palestra) ?>"> -->
	<div class="col-md-4">
		<div class="panel panel-primary ">
			<div class="panel-heading">

				<?= substr($palestra->nome_palestra,0,21); ?>

				<?php if(strlen($palestra->nome_palestra) > 20) echo "..." ?>		

			</div>
			<div class="panel-body">
				<p class="text-muted">Por: <?= $palestra->ministrante ?></p>

				<img style="max-height: 150px" src="<?= base_url('uploads/'.$palestra->id_palestra.'.jpg') ?>" class="img-responsive">
				<p><?= substr($palestra->descricao_palestra,0,100)."..." ?></p>

				<a href="<?= base_url('Congressista/desinscrever/'.$palestra->id) ?>" class="btn btn-danger btn-lg">Remover</a>
			</div>
		</div>
	</div>
	<!-- </a> -->

	<?php } ?>

	</div>



	<div class="row">
	<div class="col-lg-12">
	<h1 class="page-header">Minicursos</h1>
	</div>
	</div><!--/.row-->

	<div class="col-md-4">
	<div class="panel panel-default articles">
	<div class="panel-heading">
	Dia 21/04
	<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
	</div>
	<div class="panel-body articles-container">

	<?php foreach($palestras_dia_1 as $palestra){ 
		if($palestra->periodo_palestra == 1){
			$hora = "08:00";
		}else if($palestra->periodo_palestra == 2){
			$hora = "14:30";
		}else{
			$hora = "19:00";
		}
		?>

		<div class="article border-bottom">
			<div class="col-xs-12">
				<div class="row">
					<div class="col-xs-2 col-md-2 date">
						<div class="text-muted"><?= $hora ?></div>
						<div class="large">21</div>
						<div class="text-muted">Abril</div>
					</div>
					<div class="col-xs-10 col-md-10">
						<h4><a href="<?= base_url('Painel/ver/'.$palestra->id_palestra) ?>"><?= $palestra->nome_palestra ?><br><br>
							<img src="<?= base_url('uploads/'.$palestra->id_palestra.'.jpg') ?>" class="img-responsive">
						</a></h4>
						<p><?= substr($palestra->descricao_palestra,0,100)."..." ?></p>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div><!--End .article-->

		<?php } ?>
	</div>
</div><!--End .articles-->
</div>


<div class="col-md-4">
	<div class="panel panel-default articles">
		<div class="panel-heading">
			Dia 22/04
			<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
		</div>
		<div class="panel-body articles-container">

			<?php foreach($palestras_dia_2 as $palestra){ 
				if($palestra->periodo_palestra == 1){
					$hora = "08:00";
				}else if($palestra->periodo_palestra == 2){
					$hora = "14:30";
				}else{
					$hora = "19:00";
				}
				?>

				<div class="article border-bottom">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-xs-2 col-md-2 date">
								<div class="text-muted"><?= $hora ?></div>
								<div class="large">22</div>
								<div class="text-muted">Abril</div>
							</div>
							<div class="col-xs-10 col-md-10">
								<h4><a href="#"><?= $palestra->nome_palestra ?><br><br>
									<img src="<?= base_url('uploads/'.$palestra->id_palestra.'.jpg') ?>" class="img-responsive">
								</a></h4>
								<p><?= substr($palestra->descricao_palestra,0,100)."..." ?></p>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div><!--End .article-->

				<?php } ?>
			</div>
		</div><!--End .articles-->
	</div>


	<div class="col-md-4">
		<div class="panel panel-default articles">
			<div class="panel-heading">
				Dia 23/04
				<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
			</div>
			<div class="panel-body articles-container">

				<?php foreach($palestras_dia_3 as $palestra){
					if($palestra->periodo_palestra == 1){
						$hora = "08:00";
					}else if($palestra->periodo_palestra == 2){
						$hora = "14:30";
					}else{
						$hora = "19:00";
					}
					?>

					<div class="article border-bottom">
						<div class="col-xs-12">
							<div class="row">
								<div class="col-xs-2 col-md-2 date">
									<div class="text-muted"><?= $hora ?></div>
									<div class="large">23</div>
									<div class="text-muted">Abril</div>
								</div>
								<div class="col-xs-10 col-md-10">
									<h4><a href="#"><?= $palestra->nome_palestra ?><br><br>
										<img src="<?= base_url('uploads/'.$palestra->id_palestra.'.jpg') ?>" class="img-responsive">
									</a></h4>
									<p><?= substr($palestra->descricao_palestra,0,100)."..." ?></p>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div><!--End .article-->

					<?php } ?>
				</div>
			</div><!--End .articles-->
		</div>



