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
	<div class="alert bg-warning alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Ops!</strong> Você ainda não se inscreveu em nenhum minicurso.
	</div>
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

			<?php for($i=0; $i < 3; $i++){ ?>

			<div class="article border-bottom">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-2 col-md-2 date">
							<div class="large">04</div>
							<div class="text-muted">Abril</div>
						</div>
						<div class="col-xs-10 col-md-10">
							<h4><a href="#">Lorem ipsum dolor sit amet
							<img src="http://simonesimon.com.br/novo/wp-content/uploads/2016/09/banner-1.jpg" class="img-responsive">
							</a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at sodales nisl. Donec malesuada orci ornare risus finibus feugiat.</p>
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

			<?php for($i=0; $i < 3; $i++){ ?>

			<div class="article border-bottom">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-2 col-md-2 date">
							<div class="large">22</div>
							<div class="text-muted">Abril</div>
						</div>
						<div class="col-xs-10 col-md-10">

							<h4><a href="#">Lorem ipsum dolor sit amet
							<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9NUhksocxLPDJrxQk4aRp1HBnBMxseZUGa_pvcL0EFa_4bH8_" class="img-responsive"></a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at sodales nisl. Donec malesuada orci ornare risus finibus feugiat.</p>
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

			<?php for($i=0; $i < 3; $i++){ ?>

			<div class="article border-bottom">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-2 col-md-2 date">
							<div class="large">23</div>
							<div class="text-muted">Abril</div>
						</div>
						<div class="col-xs-10 col-md-10">
							<h4><a href="<?= base_url('Painel/ver') ?>">Lorem ipsum dolor sit amet
							<img src="http://marcialuz.com/wp-content/uploads/2017/02/coach-palestrante.png" class="img-responsive">
							</a></h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at sodales nisl. Donec malesuada orci ornare risus finibus feugiat.</p>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div><!--End .article-->

			<?php } ?>
		</div>
	</div><!--End .articles-->
</div>



