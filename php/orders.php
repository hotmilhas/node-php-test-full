<?php

header('Content-Type: application/json');

class Pedido{
    public $total_brl = 0.0;
    public $total_usd = 0.0;

    function __construct($id){
        $this->id = $id;
        $this->created_at = date('d/m/Y');
    }

    public function addItems($items){
        foreach($items as $item){
            $this->total_brl += $item;
        }
        $this->total_usd = $this->total_brl * 3.78;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $items = $_POST['items'];
    $pedido = new Pedido(1);
    $pedido->addItems($items);
    echo json_encode((array)$pedido);
}else if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $pedido = new Pedido(1);
    $pedido->addItems([100,200,300]);
    $pedido2 = new Pedido(2);
    $pedido2->addItems([100,200,300]);
    echo json_encode([$pedido, $pedido2]);
}

