	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="<?= base_url('assets/img/default.jpg') ?>" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?= $this->session->usuario['nome'] ?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
<!-- 		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form> -->
		<ul class="nav menu">
			<li <?php if($pagina == 'inicio') echo 'class="active"';  ?> ><a href="<?= base_url('Painel') ?>"><em class="fa fa-home">&nbsp;</em> Início</a></li>
			<li <?php if($pagina == 'meus_dados') echo 'class="active"';  ?>><a href="<?= base_url('Painel/meus_dados') ?>"><em class="fa fa-user">&nbsp;</em> Meus dados</a></li>
			<li <?php if($pagina == 'pagamento') echo 'class="active"';  ?>><a href="<?= base_url('Painel/pagamento') ?>"><em class="fa fa-money">&nbsp;</em> Pagamento</a></li>
			
			<?php if($pagamento){ ?>
			<li <?php if($pagina == 'minicursos') echo 'class="active"';  ?>><a href="<?= base_url('Painel/selecionar') ?>"><em class="fa fa-calendar">&nbsp;</em> Minicursos</a></li>
			<?php } ?>
<!-- 			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
			</a>
			<ul class="children collapse" id="sub-item-1">
				<li><a class="" href="#">
					<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
				</a></li>
				<li><a class="" href="#">
					<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
				</a></li>
				<li><a class="" href="#">
					<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
				</a></li>
			</ul>
		</li> -->
		<li class=""><a style="" href="<?= base_url('Painel/logout') ?>"><em class="fa fa-power-off">&nbsp;</em> Sair</a></li>
	</ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	