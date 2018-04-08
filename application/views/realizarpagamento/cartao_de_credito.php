<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?= base_url('Painel') ?>">
				<em class="fa fa-home"></em>
			</a>
		</li>
		<li>
			<a href="">
				<em class="fa fa-card active"> Cartão de Crédito</em>
			</a>
		</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Cartão de Crédito</h1>
		<?php getMensagem($this->session) ?>
	</div>
</div><!--/.row-->

<img width="200px" style="position: absolute; right: 10px; top: 10px;" src="http://model39.radiomaria.org/Data/Sites/45/pagseguro.png">


<div class="panel panel-primary">
	<div class="panel-heading">
		DADOS DO CARTÃO
	</div>
	<div class="panel-body">
		<form name="form" id="form" action="<?= base_url('RealizarPagamento/efetuar_pagamento')  ?>" method="POST">
			
			<div class="row">
				<div class="col-md-6">
					<label for="cardNumber">Nº cartão*</label>
					<div class="input-group">
						<input type="tel" class="form-control" id="cardNumber" name="cardNumber" placeholder="Número do Cartão" value="" autocomplete="cc-number" required autofocus/>
						<span class="input-group-addon"><img src="<?= base_url('assets/imagens/credit-card.png') ?>" class="bandeiraCartao" style="width: 40px; height: 20px;" id="bandeiraCartao" /></span>
					</div>
				</div>  
				<div class="col-md-6">
					<div class="field form-group" id="installmentsWrapper" style="display : none">
						<label for="installmentQuantity">Parcelamento*</label>
						<select name="installmentQuantity" class="form-control" id="installmentQuantity"></select>
						<input type="hidden" name="installmentValue0" id="installmentValue0" />
						<input type="hidden" name="installmentValue1" id="installmentValue1" />
						<input type="hidden" name="installmentValue2" id="installmentValue2" />
						<input type="hidden" name="installmentValue3" id="installmentValue3" />
						<input type="hidden" name="installmentValue4" id="installmentValue4" />
						<input type="hidden" name="installmentValue5" id="installmentValue5" />
					</div>
				</div>     
			</div>	                     
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="cardExpiry">Validade*</label>
						<input type="tel" class="form-control" id="cardExpiry" name="cardExpiry" placeholder="MM / YYYY" autocomplete="cc-exp" required value=""/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="cardCVC">CVV*</label>
						<input type="tel" class="form-control" id="cardCVC" name="cardCVC" placeholder="CVV" autocomplete="cc-csc" required value=""/>
					</div>
				</div>
			</div>
			<input type="hidden" name="brand" id ="brand">
			<input type="hidden" name="token">
			<input type="hidden" name="senderHash">
			<input type="hidden" name="totalValue" id="totalValue" value="<?= $valor ?>">

			<button class="btn  btn-primary btn-lg" type="button">Finalizar</button>
			
		</form>
	</div>
</div>





<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?= base_url('assets/js/jquery.mask.min.js') ?>"></script>



<script type="text/javascript" src= <?= $PAGSEGURO_DIRECT_PAYMENT ?>></script>
<script src="<?= base_url('assets/js/jquery.payment.js') ?>"></script>
<script src="<?= base_url('assets/js/pagseguro_validacoes.js') ?>"></script>
<script>
	$("button:button").click(function(){
		var senderHash = PagSeguroDirectPayment.getSenderHash();
		$("input[name='senderHash']").val(senderHash);
	});

	jQuery(function($) {
		var sessionCode = '';
		
		PagSeguroDirectPayment.setSessionId('<?= $sessionCode ?>');
		PagSeguroDirectPayment.getPaymentMethods({
			success: function(json){
		    //console.log(json);
		},
		error: function(json){
			    //console.log(json);
			    var erro = "";
			    for(i in json.errors){
			    	erro = erro + json.errors[i];
			    	alert(erro);
			    }
			},
			complete: function(json){
			}
		});
	});
</script>

