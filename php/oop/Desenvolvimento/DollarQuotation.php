<?php

namespace Desenvolvimento;

class DollarQuotation {
	
	private $clientRequest = null;
	
	
	public function __construct( \Desenvolvimento\ClientRequest $clientRequest )
	{
		
		$this->clientRequest = $clientRequest;
		
	}
	
	public function getClientRequest(  )
	{
		
		return $this->clientRequest;
		
	}
	
	public function getDollarCotation( $date = "07-20-2018" )
	{
		
		$info_cotation =  $this->getADollarQuotationPerDay( $date );
		
		return $info_cotation[ "usd" ];
		
	}
	
	public function getADollarQuotationPerDay( $date = "07-20-2018" )
	{
		
		$client = $this->clientRequest;
		
		$keycache = \FileSystemCache::generateCacheKey('dollar_quotation');
		$datacache = \FileSystemCache::retrieve($keycache);

		// If there was a cache miss
		if($datacache === false) {
			
			$datacache = $client->processRequest( $date );
		
			if( !empty( $datacache[ "value" ] ) ) {
				
				$info_first_cotation = $datacache[ "value" ] [ 0 ];
				$value_usd = round( ( 1 / $info_first_cotation[ "cotacaoCompra" ] ) , 2 );
				
				$datacache = [ "brl" => 1, "usd" => $value_usd ];
				\FileSystemCache::store( $keycache, $datacache, 14400 ); 
				
				return $datacache;
				
			}else { 
			
				return [ "brl" => 0, "usd" => 0 ];
				
			}
			
		}else {
		
			return $datacache;
			
		}
		
	}
	
}