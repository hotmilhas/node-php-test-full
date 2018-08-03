<?php
namespace Desenvolvimento;

use Desenvolvimento\Order;

class OrderTest extends \PHPUnit_Framework_TestCase
{
	
	private $fileSystemCache;
	
	private $order;
	
	private $clientRequest;
	
	private $dollarQuotation;
	
	public function setUp( )
	{
	
		$this->fileSystemCache = new \FileSystemCache( );
		$this->order = new Order( $this->fileSystemCache );
		$this->clientRequest = new ClientRequest( );
		$this->dollarQuotation = new DollarQuotation( $this->clientRequest );
		$key = $this->fileSystemCache->generateCacheKey('orders');
		$this->fileSystemCache->invalidate( $key );
	}
	
	public function testGetFileSystemCache(  )
	{

		$this->assertEquals( $this->fileSystemCache, $this->order->getFileSystemCache( ) );
		
	}
	
	public function testInsertOrder(  )
	{
		$date_time = ( new \DateTime( "now", new \DateTimeZone( "America/Sao_Paulo" ) ) )->format( "Y-m-d H:i:s" );
		$data_order = [ "id" => 1, "created_at" => $date_time, "total_brl" => 1650, "total_usd" => 429 ];
		$items      = [ 1000, 500, 150 ];
		$date = "07-20-2018";
		
		
		$cotation_usd = $this->dollarQuotation->getDollarCotation( $date );
		$this->assertEquals( $data_order, $this->order->insertOrder( $items, $cotation_usd ) );
		
	}
		
	
	public function testGetOrdersEmpty(  )
	{
		
		$orders = [  ];
		$this->assertEquals( $orders, $this->order->getOrders( ) );
		
	}
	
	public function testGetOrders(  )
	{
		$date_time = ( new \DateTime( "now", new \DateTimeZone( "America/Sao_Paulo" ) ) )->format( "Y-m-d H:i:s" );
		$data_order1 = [ "id" => 1, "created_at" => $date_time, "total_brl" => 1650, "total_usd" => 429 ];
		$data_order2 = [ "id" => 2, "created_at" => $date_time, "total_brl" => 1650, "total_usd" => 429 ];
		$items      = [ 1000, 500, 150 ];
		$date = "07-20-2018";
		$orders     = [ $data_order1, $data_order2 ];
		
		
		$cotation_usd = $this->dollarQuotation->getDollarCotation( $date );
		$this->order->insertOrder( $items, $cotation_usd );
		$this->order->insertOrder( $items, $cotation_usd );
		
		$this->assertEquals( $orders, $this->order->getOrders() );
	}
	
	public function testFindLastOrderId(  )
	{
		
		$this->assertEquals( 1, $this->order->findLastOrderId( ) );
		
	}
	
	
}