<div class="row">
	<ol class="breadcrumb">
		<li><a href="#">
			<em class="fa fa-home active"> Início</em>
		</a></li>
	</ol>
</div><!--/.row-->


<br>
<div class="col-md-8">
	<?php if($acao == 0){ //PRIMEIRO LOGIN ?> 

	<div class="panel panel-primary ">
		<div class="panel-heading">
			Seja bem vindo!
		</div>
		<div class="panel-body">
			<p>Aqui você poderá:
				<ul>
					<li><strong>REALIZAR O PAGAMENTO,</strong></li>
					<li>Acompanhar o <strong> STATUS DO PAGAMENTO,</strong></li>
					<li><strong>INSCREVER-SE</strong> nas palestras e workshops</li>
					<li>Ficar por dentro das <strong>NOTÍCIAS</strong> do evento.</li>
				</ul>
			</p>
			<p align="center">Sistema desenvolvido pela <a href="http://www.ejcomp.com.br" target="_blank">EJCOMP</a> Empresa Júnior de Computação.</p>
		</div>
	</div>

	<?php } if($acao ==0 || $acao == 1){ //FALTA PAGAR ?>

	<div class="panel panel-danger">
		<div class="panel-heading">
			PAGAMENTO
		</div>
		<div class="panel-body">
			<p>Não corra riscos! Efetue o pagamento agora mesmo <a href="<?= base_url('Painel/pagamento') ?>">CLICANDO AQUI</a>. Só assim sua vaga será reservada no evento.</p>
		</div>
	</div>

	<?php } if($acao == 2){  //JA PAGOU ?>

	<div class="panel panel-success">
		<div class="panel-heading">
			PAGAMENTO
		</div>
		<div class="panel-body">
			<p>Recebemos seu pagamento e tudo está OK!</p>
			<p>Não perca mais tempo! Reserve já a sua vaga nos minicursos e workshops de seu interesse! Você pode escolher até <?php echo rand()%9 ?> minicursos diferentes!</p>
			<a href="<?= base_url('Painel/selecionar') ?>">CLIQUE AQUI</a>
		</div>
	</div>

	<?php } ?>

	<div class="panel panel-default articles">
		<div class="panel-heading">
			Últimas notícias
			<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
			<div class="panel-body articles-container">
				<div class="article border-bottom">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-xs-2 col-md-2 date">
								<div class="large">04</div>
								<div class="text-muted">Abril</div>
							</div>
							<div class="col-xs-10 col-md-10">
								<h4><a href="#">Lorem ipsum dolor sit amet</a></h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at sodales nisl. Donec malesuada orci ornare risus finibus feugiat.</p>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div><!--End .article-->
			</div>
		</div><!--End .articles-->
	</div>


	<div class="col-md-4">
		<div class="panel panel-default ">
			<div class="panel-heading">
				Linha do Tempo
				<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
				<div class="panel-body timeline-container">
					<ul class="timeline">
						<li>
							<div class="timeline-badge <?php if($acao == 0 || $acao == 1){ echo 'danger';}else{ echo 'success';}?>"><i class="glyphicon glyphicon-paperclip"></i></div>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h4 class="timeline-title">Pagamento</h4>
								</div>
								<div class="timeline-body">
									<p>Realizar o pagamento referente a entrada e taxas no evento.</p>
									<?php if($acao == 0 || $acao == 1){ ?>
									<a href="<?= base_url('Painel/pagamento') ?>">Você pode realizar o pagamento clicando aqui.</a>
									<?php }else{ ?>
									<p>Você já realizou o pagamento.</p>
									<?php } ?>
								</div>
							</div>
						</li>
						<li>
							<div class="timeline-badge primary"><i class="glyphicon glyphicon-calendar"></i></div>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h4 class="timeline-title">Selecionar as palestras/minicursos</h4>
								</div>
								<div class="timeline-body">
									<p>Após a realização do pagamento, você estará apto a selecionar as palestras e minicursos de seu interesse. Lembrando que a confirmação do pagamento pode demorar até <strong>24 horas</strong>.</p>
								</div>
							</div>
						</li>
						<li>
							<div class="timeline-badge warning"><i class="glyphicon glyphicon-map-marker"></i></div>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h4 class="timeline-title">Evento</h4>
								</div>
								<div class="timeline-body">
									<p>O evento ocorrerá nos dias <strong>TAL, TAL e TAL</strong> na cidade de Araraquara.</p>
									<p>Mais informações no site <a target="_blank" href="http://walcomej.nucleounesp.com.br">oficial do evento</a>.</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

