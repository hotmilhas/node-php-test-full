<?php
namespace Desenvolvimento;

use Desenvolvimento\ClientRequest;

class ClientRequestTest extends \PHPUnit_Framework_TestCase
{
	public function testProcessRequestFail(  )
	{
		
		$clientRequest = new ClientRequest(  );
		$date = "0000000000";
		$this->assertEquals( false, $clientRequest->processRequest( $date ) );
		
	}
	
	public function testGetUrlRequestCotation(  )
	{
		
		$clientRequest = new ClientRequest(  );
		$url_request   = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)';
		$url_request  .= "?@dataCotacao='07-20-2018'";
		$url_request  .= '&$top=100&$format=json';
		
		$date = "07-20-2018";
		$url_request_cotation = $clientRequest->getUrlRequestCotation( $date );
		$this->assertEquals( $url_request, $url_request_cotation );
		
	}
	
	public function testProcessRequestSuccess(  )
	{
		
		$clientRequest = new ClientRequest(  );
		$url_request   = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)';
		$url_request  .= "?@dataCotacao='07-20-2018'";
		$url_request  .= '&$top=100&$format=json';
		
		$date = "07-20-2018";
		$response = $clientRequest->processRequest( $date );
		$this->assertNotEmpty( $response );
		$this->assertArrayHasKey( "value", $response );
		
	}
	
}