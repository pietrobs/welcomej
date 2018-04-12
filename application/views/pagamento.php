<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url('Painel') ?>">
					<em class="fa fa-home"></em>
				</a>
			</li>
			<li>
				<a href="">
					<em class="fa fa-money active"> Pagamento</em>
				</a>
			</li>
		</ol>
	</div><!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Pagamento</h1>
			<?php getMensagem($this->session) ?>
		</div>
	</div><!--/.row-->
	<?php if($pagamento == 0){ ?>
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading" id="duvida">
				<strong>Instruções para anexar o <strong>comprovante de depósito:</strong></strong>
				<span class="pull-right"></span></div>
				<div class="panel-body">

					<form class="form-horizontal" action="<?= base_url('Painel/send_photo') ?>" method="post" enctype="multipart/form-data">
						<fieldset>
							<p><strong>1</strong> - Scaneie ou tire a foto do comprovante de depósito via câmera (celular ou câmera digital) de maneira que seja legível as informações contidas no mesmo.</p>
							<p><strong>2</strong> - Passe para o computador.</p>
							<p><strong>3</strong> - Selecione abaixo a foto do comprovante de depósito. Os tipos de imagens permitidos são: <strong>.pdf, .jpg, .jpeg, .gif, .bmp, .png.</strong> com o tamanho máximo de <strong>2 MB.</strong></p>
							<p><strong>4</strong> - Clique sobre o botão <strong>"Enviar Comprovante"</strong></p>
							<!-- Message body -->
							<div class="form-group">

								<div class="col-md-12">
									<input type="file" name="comprovante_deposito" id="comprovante_deposito" class="form-control" required="true" accept="image/*, .pdf"> 
									<br>
									<input type="submit" name="submit" id="submimt" class="btn btn-primary" value="Enviar Comprovante">
								</div>

							</div>


						</fieldset>
					</form>
				</div>

			</div>
		</div>

		<?php } else{ ?>

	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<p align="center" style="color:white;">Status do Pagamento: Em Análise</p>


				<span class="pull-right"></span></div>
				<div class="panel-body">
					<h2>Seu comprovante de pagamento está em <strong>análise.</strong></h2>
					<h3>Falta atualizar a view conforme atualiza o Status do Pagaemnto, está fixo em Análise.</h3>
				</div>

			</div>
		</div>
		<?php } ?>
	</div>