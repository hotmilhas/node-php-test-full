<?php

namespace Desenvolvimento\Route\Get\Php;

class Orders implements \Desenvolvimento\Route\ControllerInterface {

	private $order;
	
	public function __construct( \Desenvolvimento\Order $order )
	{
		
		$this->order = $order;
		
	}
	
	public function run(  )
	{

		$orders = $this->order->getOrders(  );
		echo json_encode( $orders );
	}
	
}