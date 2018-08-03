<?php

namespace Desenvolvimento\Route\Post\Php;

class Orders implements \Desenvolvimento\Route\ControllerInterface {

	private $order;
	
	private $dollarQuotation;
	
	public function __construct( \Desenvolvimento\Order $order, \Desenvolvimento\DollarQuotation $dollarQuotation )
	{
		
		$this->dollarQuotation = $dollarQuotation;
		$this->order           = $order;
		
	}
	
	public function run(  )
	{
		$date = "07-20-2018";
		$cotation_usd = $this->dollarQuotation->getDollarCotation( $date );
		$items        = $_POST[ "items" ];
		$insert_result = $this->order->insertOrder( $items, $cotation_usd );
		echo json_encode( $insert_result );
	}
	
}