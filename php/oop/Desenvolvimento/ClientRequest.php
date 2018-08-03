<?php

namespace Desenvolvimento;


class ClientRequest {

	
	
	public function getUrlRequestCotation( $date )
	{
		$url_request_cotation  = 'https://olinda.bcb.gov.br';
		$url_request_cotation .= '/olinda/servico/PTAX/versao/v1/odata';
		$url_request_cotation .= '/CotacaoDolarDia';
		$url_request_cotation .= '(dataCotacao=@dataCotacao)';
		$url_request_cotation .= "?@dataCotacao='" . $date . "'";
		$url_request_cotation .= '&$top=100&$format=json'; 
		
		return $url_request_cotation;
		
	}
	
	public function processRequest( $date )
	{
		$url_request = $this->getUrlRequestCotation( $date );
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url_request); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE );
		$output = curl_exec($ch); 
		$output = json_decode( $output, true );
		
		$status_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE);
						
		if( $status_code !== 200 ) {
			curl_close( $ch );
			return false;
		} else {
			curl_close( $ch );
			return $output;
		}				
		
		return $result;
		
	}
	
}