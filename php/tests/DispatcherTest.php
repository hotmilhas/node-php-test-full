<?php
namespace Desenvolvimento;

use Desenvolvimento\ClientRequest;
use Desenvolvimento\DollarQuotation;

class DollarQuotationTest extends \PHPUnit_Framework_TestCase
{
	
	private $clientRequest;
	
	public function setUp( )
	{
	
		$this->clientRequest = new ClientRequest( );
	}
	
	public function testGetClientRequest(  )
	{

		$dollarQuotation = new DollarQuotation( $this->clientRequest );
		$this->assertEquals( $this->clientRequest, $dollarQuotation->getClientRequest( ) );
		
	}
		
		
	public function testGetADollarQuotationPerDayIn07202018Fail(  )
	{

		$dollarQuotation = new DollarQuotation( $this->clientRequest );
		$date = "0000000000";
		
		$result_cotation = $dollarQuotation->getADollarQuotationPerDay( $date );
		$this->assertArrayHasKey( "usd", $result_cotation );
		$this->assertEmpty( 0, $result_cotation[ "usd" ] );
		
		
	}
	
	public function testGetADollarQuotationPerDayIn07202018Success(  )
	{

		$dollarQuotation = new DollarQuotation( $this->clientRequest );
		$date = "07-20-2018";
		
		$result_cotation = $dollarQuotation->getADollarQuotationPerDay( $date );
		$this->assertTrue( is_array( $result_cotation ) );
		
		$this->assertTrue( is_array( $dollarQuotation->getADollarQuotationPerDay( $date ) ) );
		
	}
	
	public function testGetDollarCotation( )
	{
		$dollarQuotation = new DollarQuotation( $this->clientRequest );
		$date = "07-20-2018";
		
		$result_cotation = $dollarQuotation->getDollarCotation( $date );
		$this->assertEquals( false, $result_cotation );
	}
	
	
	
}