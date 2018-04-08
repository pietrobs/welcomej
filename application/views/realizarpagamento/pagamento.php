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

<img width="200px" style="position: absolute; right: 10px; top: 10px;" src="http://model39.radiomaria.org/Data/Sites/45/pagseguro.png">

<?php if(!$pagamento){ ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		FORMA DE PAGAMENTO
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-primary btn-lg" id="boleto">Boleto</a>
				<a href="<?= base_url('RealizarPagamento/cartao_de_credito') ?>" class="btn btn-success btn-lg">Cartão de Crédito</a>
			</div>
		</div>
	</div>
</div>

<?php }else{ ?>
<div class="panel panel-success">
	<div class="panel-heading">
		PAGAMENTO EFETIVADO
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<p>Seu pagamento já foi efetivado.</p>
				<ul>
					<li><strong>Status: </strong><?= $info_pagamento->status ?></li>
					<li><strong>Parcelas: </strong><?= $info_pagamento->parcela ?>x de <?= $info_pagamento->valor_parcela ?></li>
					<li><strong>Valor pago: </strong> R$ <?= $info_pagamento->valor ?> </li>
					<li><strong>Data do pagamento: </strong> <?= date('d/m/y h:m',strtotime($info_pagamento->data)) ?></li>
					<?php if($info_pagamento->tipo_pagamento == 1){ ?>
					<li><strong>Tipo pagamento: </strong> Cartão de Crédito</li>
					<?php }else{ ?>
					<li><strong>Tipo pagamento: </strong> Boleto Bancário</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<script src="<?= base_url('assets/js/jquery.maskedinput.min.js') ?>"></script>

<script type="text/javascript" src= <?= $PAGSEGURO_DIRECT_PAYMENT ?>></script>
<script src="<?= base_url('assets/js/jquery.payment.js') ?>"></script>
<script src="<?= base_url('assets/js/pagseguro_validacoes.js') ?>"></script>
<script>
	$('#boleto').click(function(){
		var senderHash = PagSeguroDirectPayment.getSenderHash();
		
		$('#boleto').html("<div class='loader'></div> Carregando...");

		var resposta;
		$.ajax({
			method:"POST",
			url:"<?= base_url('RealizarPagamento/boleto') ?>",
			data:"senderHash="+senderHash,
			success : function(dados){
				resposta = JSON.parse(dados);
				window.location.replace(resposta);
				
			}

		});
	});
</script>
