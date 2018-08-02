<?php

namespace Desenvolvimento;

use Desenvolvimento\DollarQuotation;

class MyFirstTest extends \PHPUnit_Framework_TestCase
{
	public function testGetDollarCotation(  )
	{

		$area = new DollarQuotation(  );
		$this->assertEquals( true, $area->getDollarCotation( ) );
		
	}
	
}