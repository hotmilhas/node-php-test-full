<?php

namespace Desenvolvimento\Route\Get\Php;

class Brlusd implements \Desenvolvimento\Route\ControllerInterface {
	
	private $dollarQuotation;
	
	public function __construct( \Desenvolvimento\DollarQuotation $dollarQuotation )
	{
		
		$this->dollarQuotation = $dollarQuotation;
		
	}
	
	public function run(  )
	{
		echo json_encode( $this->dollarQuotation->getADollarQuotationPerDay( "07-20-2018" ) );
	}
	
}