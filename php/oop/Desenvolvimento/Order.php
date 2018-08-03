<?php

namespace Desenvolvimento;

class Order{ 

	private $fileSystemCache;
	
	
	public function __construct( \FileSystemCache $fileSystemCache )
	{
		
		$this->fileSystemCache = $fileSystemCache;
		
	}
	
	public function getFileSystemCache(  ) 
	{
		
		return $this->fileSystemCache;
		
	}
	
	public function findLastOrderId( )
	{
		
		$orderIds= [  ];
		$maxOrderId = 1;
		
		$orders = $this->getOrders( );
		
		$orderIds = array_column( $orders, "id" ); 
		
		if( !empty( $orderIds ) ) { 
			
			$maxOrderId = max( $orderIds );
			
			$maxOrderId += 1;
			
		}
		
		return $maxOrderId;
		
	}
	
	public function insertOrder( array $items, $cotation_usd )
	{
		
		$data_insert                = [  ];
		$data_insert ["id"]         = $this->findLastOrderId( );
		$data_insert ["created_at"] = ( new \DateTime( "now", new \DateTimeZone( "America/Sao_Paulo" ) ) )->format( "Y-m-d H:i:s" );
		$data_insert ["total_brl"]  = array_sum( $items );
		$data_insert ["total_usd"]  = $data_insert ["total_brl"] * $cotation_usd ;
		
		$keycache = $this->fileSystemCache->generateCacheKey('orders');
		$orders = $this->fileSystemCache->retrieve($keycache);

		if($orders === false) {
			
			$orders = [  ];
			
		}
		
		array_push( $orders, $data_insert);
		$this->fileSystemCache->store( $keycache, $orders, 14400 ); 
		
		
		return $data_insert;
		
		
	}
	
	public function getOrders( )
	{
		
		$keycache = $this->fileSystemCache->generateCacheKey('orders');
		$datacache = $this->fileSystemCache->retrieve($keycache);

		if($datacache === false) {
			
			$datacache = [  ];
			$this->fileSystemCache->store( $keycache, $datacache, 14400 ); 
				
			return $datacache;
			
		}else {
		
			return $datacache;
			
		}
		
	}
	
	
}