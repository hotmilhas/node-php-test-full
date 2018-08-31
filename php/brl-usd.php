<?php

$url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/aplicacao#!/CotacaoDolarDia#eyJmb3JtdWxhcmlvIjp7IiR0b3AiOjEwMCwiJGZvcm1hdCI6Impzb24iLCJkYXRhQ290YWNhbyI6IjA3LTIwLTIwMTgifSwicGVzcXVpc2FkbyI6dHJ1ZSwiYWN0aXZlVGFiIjoiZGFkb3MiLCJncmlkU3RhdGUiOnsDMAM6W3sDQgMiBDAEIiwDQQN9LHsDQgMiBDEEIiwDQQN9LHsDQgMiBDIEIiwDQQN9XSwDMQM6e30sAzIDOltdLAMzAzp7fSwDNAM6e30sAzUDOnt9fSwicGl2b3RPcHRpb25zIjp7A2EDOnt9LANiAzpbXSwDYwM6NTAwLANkAzpbXSwDZQM6W10sA2YDOltdLANnAzoia2V5X2FfdG9feiIsA2gDOiJrZXlfYV90b196IiwDaQM6e30sA2oDOnt9LANrAzo4NSwDbAM6ZmFsc2UsA20DOnt9LANuAzp7fSwDbwM6IkNvbnRhZ2VtIiwDcAM6IlRhYmxlIn19';

$data = array("moeda" => "USD", "dataCotacao" => "07-20-2018");

$get_addr = $url .'?'.http_build_query($data);
$ch = curl_init($get_addr);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

$gist = json_decode($result, true);

if($gist){
    echo file_get_contents($gist['url']);
}