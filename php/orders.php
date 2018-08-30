<?php

Class Order
{

    public $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao=%2707-20-2018%27&$top=100&$format=json';
    public $pedidos;
    public $param = ["http" => ["method" => "GET", "header" => "Cache-Control: max-age=14400"]];
    public $cotacaoJson;

    function __construct()
    {
        $context = stream_context_create($this->param);
        $f = file_get_contents($this->url, false, $context);
        $this->cotacaoJson = json_decode($f);
    }

    public function makePedido()
    {
        // items[]=1000&items[]=500&items[]=150;
        $data = array(1000, 500, 150);

        $id = 0;
        foreach ($data as $row) {
            $pedido[] = array(
                "id" => $id++,
                "created_at" => date('c'),
                "total_brl" => ($row * $this->cotacaoJson->value[0]->cotacaoCompra),
                "total_usd" => $row * 1
            );
        }

        $this->pedidos = $pedido;
    }

    public function gravaJson()
    {
        $fp = fopen('arquivo.json', 'w');
        fwrite($fp, json_encode($this->pedidos));
        fclose($fp);
    }


}

$order = new Order();
$order->makePedido();
$order->gravaJson();