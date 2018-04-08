<?php 

    //Config SANDBOX or PRODUCTION environment
    $SANDBOX_ENVIRONMENT = false;
    
    $PAGSEGURO_API_URL = 'https://ws.pagseguro.uol.com.br/v2';
    $PAGSEGURO_RECEBER_POST = 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications/';
    $PAGSEGURO_DIRECT_PAYMENT = 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';
    if($SANDBOX_ENVIRONMENT){
        $PAGSEGURO_API_URL = 'https://ws.sandbox.pagseguro.uol.com.br/v2';
        $PAGSEGURO_RECEBER_POST = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/';
        $PAGSEGURO_DIRECT_PAYMENT = 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';
    }

    $PAGSEGURO_EMAIL = 'darlannakamura@hotmail.com';
    $PAGSEGURO_TOKEN = '777B8F8114C2489EA2DD2AE40F9BE215';

    // $PAGSEGURO_EMAIL = 'projetos.ejcomp@gmail.com';
    // $PAGSEGURO_TOKEN = '5E77208E11B84362A3312B5AD78AA5DA';




?>