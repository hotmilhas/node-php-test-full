<?php

header('Content-Type: application/json');
require('CurlClient.php');


if(!isset($_COOKIE['cotacao'])){
    $url = "https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao='07-20-2018'";
    $cotacao = CurlClient::get($url);
    setcookie('cotacao', $cotacao, 14400);
    echo $cotacao;
}else{
    echo $_COOKIE['cotacao'];
}
?>
