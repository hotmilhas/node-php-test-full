<?php
namespace Desenvolvimento;

use Desenvolvimento\ClientRequest;
use Desenvolvimento\DollarQuotation;
use Desenvolvimento\Dispatcher;
use Desenvolvimento\Route\Get\Php\Brlusd;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{
	
	
	private $dependencyManager;
	
	private $dispatcher;
	
	public function setUp( )
	{
	
		$dependencyContainer     = new \Pimple\Container( );
		$this->dependencyManager = new DependencyManager( $dependencyContainer );
		$this->dispatcher        = new Dispatcher( $this->dependencyManager );
		
		
	}
	
	
	public function testGetRoutes(  )
	{

		$info_routes = [ 
						"GET" => [ 
							"/php/brl-usd.php", 
							"/php/orders.php", 
						],
						"POST" => [ "/php/orders.php" ]
				  ];

				  
		$this->assertEquals( $info_routes, $this->dispatcher->getRoutes( ) );
		
	}
		
	public function testGetPathResource(  )
	{
		$path_root_request = "/php/brl-usd.php";
		$request_method    = "get";
		$path_resource     = "Desenvolvimento/Route/Get/Php/Brlusd";
		
		$this->assertEquals( $path_resource, $this->dispatcher->getPathResource( $path_root_request, $request_method ) );
		
	}
	
	public function testDispatch(  )
	{
		$path_root_request = "/php/brl-usd.php";
		$request_method    = "GET";
		$path_resource     = "Desenvolvimento/Route/Get/Php/Brlusd";
		$client_request    = new ClientRequest(  );
		$dollar_quotation    = new DollarQuotation( $client_request );
		$instance_controller = new Brlusd( $dollar_quotation );
		$this->assertEquals( $instance_controller, $this->dispatcher->dispatch( $path_root_request, $request_method ) );
		
	}
	
	
}