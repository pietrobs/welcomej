  function parcelasDisponiveis() {
    if($.payment.validateCardNumber($('#cardNumber').val())){
      PagSeguroDirectPayment.getInstallments({
        amount: $("#totalValue").val(),
        brand: $("#brand").val(),
      //maxInstallmentNoInterest: 2,

      success: function(response) {
        //console.log(response.installments);
        $("#installmentsWrapper").css('display', "block");
        //$("#installmentsWrapper").prop('readonly', false);


        var installments = response.installments[$("#brand").val()];
        
        
        var i;
        for(i = 0; i < 6; i++){
          $('#installmentValue'+i).val(installments[i].installmentAmount);
        }

        var options = '';
        var i = 0;
        for (i = 0; i < 6; i++ ) {

          var optionItem     = installments[i];
          var optionQuantity = optionItem.quantity;
          var optionAmount   = optionItem.installmentAmount;
          var optionTotal    = optionItem.totalAmount;
          var optionLabel    = (optionQuantity + " x R$ " + (optionAmount.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,').replace(".", ',')));

          options += ('<option value="' + optionItem.quantity + '" valorparcela="' + optionAmount +'">'+ optionLabel + " = " + optionTotal + '</option>');
          //options += ('<option value="' + optionItem.quantity + '" valorparcela="' + optionAmount +'">'+ optionLabel +'</option>');

        };

        $("#installmentQuantity").html(options);


      },

      error: function(response) {
        //console.log(response);
      },

      complete: function(response) {
      }
    });
    }
    else
    {
      $("#installmentsWrapper").css('display', "none");
      $("#installmentQuantity").html('');
      $("input[name='brand']").val('');
      $("input[name='token']").val('');
      $("input[name='senderHash']").val('');
    }



  }

  $(function($) {
    $('[data-numeric]').payment('restrictNumeric');
    $('#cardNumber').payment('formatCardNumber');
    $('#cardExpiry').payment('formatCardExpiry');
    $('#cardCVC').payment('formatCardCVC');

    $.fn.toggleInputError = function(input, erred, msg = 1) {
      switch (msg){
       case 1:
       var msg = "Preencha as informações bancárias corretamente.";
       break;
       case 2:
       var msg = "Cartão de crédito não conhecido.";
       break;
     }
     if(erred)
     {
      input.addClass('alert alert-danger');
      //console.log(input.selector == "#cardNumber");
      //console.log(input.selector);
      if(input.selector == "#cardNumber")
      {

        $("#installmentsWrapper").css('display', "none");
        $("#installmentQuantity").html('');
        $("input[name='brand']").val('');
        $("input[name='token']").val('');
        $("input[name='senderHash']").val('');
      }
      $('#mensagem').html("<i id='msgerro' style='color: #cc1111;'>" + msg + "</i>");
      $('#msgerro').delay( 2200 ).slideUp(200, function()
      {
        $(this).remove();
      });
    }
    else
    {
      input.removeClass('alert alert-danger');
    }
    return this;
  };

  $('#cardNumber').focusout(function(e) {
    e.preventDefault();
    var cardType = $.payment.cardType($('#cardNumber').val());
    if($(this).val() != ''){
      if(!$.payment.validateCardNumber($('#cardNumber').val()))
      {
        $('#cardNumber').toggleInputError($('#cardNumber'), !$.payment.validateCardNumber($('#cardNumber').val()));
      }
      else{
        PagSeguroDirectPayment.getBrand({
          cardBin: $("input[name='cardNumber']").val().replace(/ /g,''),
          success: function(json){
            var brand = json.brand.name;

            $("input[name='brand']").val(brand);

                      //alert(brand);
                      $("#bandeiraCartao").attr('src', 'https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/' + brand + '.png');
                      parcelasDisponiveis();
                    },
                    error: function(json){
                      $("#bandeiraCartao").attr('src', '../assets/imagens/credit-card.png');
                      $.fn.toggleInputError($('input[name=cardNumber]'), 1, 2);
                      //console.log(json);
                      $("#installmentsWrapper").css('display', "none");
                      $("#installmentQuantity").html('');
                      $("input[name='brand']").val('');
                      $("input[name='token']").val('');
                      $("input[name='senderHash']").val('');
                    },
                    complete: function(json){
                      $('#cardNumber').toggleInputError($('#cardNumber'), !$.payment.validateCardNumber($('#cardNumber').val()));
                    }
                  });
      }
    }
    else
    {
      $("#bandeiraCartao").attr('src', '../assets/imagens/credit-card.png');
      $("#installmentsWrapper").css('display', "none");
      $("#installmentQuantity").html('');
      $("input[name='brand']").val('');
      $("input[name='token']").val('');
      $("input[name='senderHash']").val('');
    }
  });

  $('#cardExpiry').focusout(function(e) {
    e.preventDefault();
    var cardType = $.payment.cardType($('#cardNumber').val());
    if($(this).val() != ''){
      $('#cardExpiry').toggleInputError($('#cardExpiry'), !$.payment.validateCardExpiry($('#cardExpiry').payment('cardExpiryVal')));
    }
  });
  $('#cardCVC').focusout(function(e) {
    e.preventDefault();
    var cardType = $.payment.cardType($('#cardNumber').val());
    if($(this).val() != ''){
      $('#cardCVC').toggleInputError($('#cardCVC'), !$.payment.validateCardCVC($('#cardCVC').val(), cardType));
    }
  });
  var validaDadosGeral = function()
  {

    mensagem = '';
    erro = false;
    if($('select[name=cardProp]').val() == 0){
      if(validaDadosOutros() == 0)
      {
        mensagem += "<li>Preencha todas as informações referentes ao endereço.</li><br>";
      }
      if($.payment.validateCardNumber($('#cardNumber').val())){
        if($('#cardNumber').val() != ''  && ($('#installmentQuantity').val() == null || $('#installmentQuantity').val() == '') && $('#cardExpiry').val() != '' && $('#cardCVC').val() != ''){
          mensagem += "<li>Cartão inválido ou não disponível.(Para mais informações envie um e-mail para suporte.enejunesp@gmail.com)</li><br>";
        }
        else{
          if($('#cardNumber').val() == '' || $('#cardExpiry').val() == '' || $('#cardCVC').val() == '')
          {
            mensagem += "<li>Preencha todas as informações do cartão.</li><br>";
          }
          var propName  = $("input[name='propName']").val();
          var propCPF   = $("input[name='propCPF']").val();
          var propDate  = $("input[name='propDate']").val();
          var propCel   = $("input[name='propCel']").val();

          if(propName == '' || propCPF == '' || propDate == '' || propCel == ''){
            erro = true;
            $('#mensagem').html("<i id='msgerro' style='color: #cc1111;'>Preencha todas as informações do dono do cartão.</i>");
            $('#msgerro').delay( 2800 ).slideUp(200, function(){$(this).remove();});                      
          }
        }
      }
      else
      {
        erro = true;
        mensagem += "<li>Preencha as informações bancárias corretamente.</li><br>";
      }
      if(mensagem != ''){
        erro = true;
        $('#mensagem1').show("slow");
        $('html, body').animate({scrollTop:0}, 'slow');
        $('#mensagem1').html(mensagem);
        $('#mensagem1').delay( 8200 ).slideUp(200, function(){$(this).hide();});
      }
    }
    else{
      if($.payment.validateCardNumber($('#cardNumber').val())){
        if($('#cardNumber').val() != '' && ($('#installmentQuantity').val() == null || $('#installmentQuantity').val() == '') && $('#cardExpiry').val() != '' && $('#cardCVC').val() != ''){
          $('#mensagem').html("<i id='msgerro' style='color: #cc1111;'>Cartão inválido ou não disponível.(Para mais informações envie um e-mail para suporte.enejunesp@gmail.com)</i>");
          $('#msgerro').delay( 3000 ).slideUp(200, function(){$(this).remove();});
          erro = true;
        }
        else{
          if($('#cardNumber').val() == '' || $('#cardExpiry').val() == '' || $('#cardCVC').val() == ''){
            erro = true;
            $('#mensagem').html("<i id='msgerro' style='color: #cc1111;'>Preencha todas as informações do cartão.</i>");
            $('#msgerro').delay( 2800 ).slideUp(200, function(){$(this).remove();});
          }
          var propName  = $("input[name='propName']").val();
          var propCPF   = $("input[name='propCPF']").val();
          var propDate  = $("input[name='propDate']").val();
          var propCel   = $("input[name='propCel']").val();

          if(propName == '' || propCPF == '' || propDate == '' || propCel == ''){
            erro = true;
            $('#mensagem').html("<i id='msgerro' style='color: #cc1111;'>Preencha todas as informações do dono do cartão.</i>");
            $('#msgerro').delay( 2800 ).slideUp(200, function(){$(this).remove();});                      
          }
        }
        

        
      }
      else
      {
        erro = true;
        $.fn.toggleInputError($('input[name=cardNumber]'), 1);
      }
    }
      //console.log("Erros :::" + erro);
      if(!erro){
        setTimeout(function(){  
          $('button:button').html("<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Tudo pronto! Aguarde ...");
          document.forms['form'].submit();
        }
        , 5000);
      }
      else{
        setTimeout(function(){$('button:button').html("Pagar");}, 2000);
      }
    }
    var cardCredit = function()
    {
      var param = {
        cardNumber: $("input[name='cardNumber']").val().replace(/ /g,''),
        brand: $("input[name='brand']").val(),
        cvv: $("input[name='cardCVC']").val(),
        expirationMonth: $("input[name='cardExpiry']").val().split(' /')[0],
        expirationYear: $("input[name='cardExpiry']").val().split('/ ')[1],
        success: function(json){
          var token = json.card.token;
          $("input[name='token']").val(token);
                  //console.log("Token: " + token);
                  validaDadosGeral();

                },
                error: function(json){
                    //console.log("Erros:" + json);
                    validaDadosGeral();
                  },
                  complete:function(json){
                  }
                }

                PagSeguroDirectPayment.createCardToken(param);
              }
              var validaDadosOutros = function()
              {
                var cep       = $("input[name='cep']").val();
                var endereco  = $("input[name='endereco']").val();
                var numero    = $("input[name='numero']").val();
                var bairro    = $("input[name='bairro']").val();
                var cidade    = $("input[name='cidade']").val();
                var estado    = $("input[name='estado']").val();

                if(cep != '' && endereco != '' && numero != '' && bairro != '' && cidade != '' && estado!= '')
                {
                  return 1;
                }
                else
                {
                  return 0;
                }
              }
              $('button:button').click(function(){
                $('button:button').html("<div class='loader'></div> Conferindo");
       // cardCredit();

       PagSeguroDirectPayment.createCardToken({
        cardNumber: $("input[name='cardNumber']").val().replace(/ /g,''),
        brand: $("input[name='brand']").val(),
        cvv: $("input[name='cardCVC']").val(),
        expirationMonth: $("input[name='cardExpiry']").val().split(' /')[0],
        expirationYear: $("input[name='cardExpiry']").val().split('/ ')[1],
        success: function(json){
          var token = json.card.token;
          $("input[name='token']").val(token);
                  //console.log("Token: " + token);
                  validaDadosGeral();

                },
                error: function(json){
                  console.log(json);
                  $('#mensagem').html("<i id='msgerro' style='color: #cc1111;'>Erro com as informações do cartão.<br>Verifique se a validade segue o padrão correto, exemplo: 01 / 2017.<br>Para mais informações envie um e-mail para suporte.enejunesp@gmail.com.</i>");
                  $('button:button').html("Pagar");

                    //validaDadosGeral();
                  },
                  complete:function(json){
                  //console.log(json);
                }
              });
     });

            });