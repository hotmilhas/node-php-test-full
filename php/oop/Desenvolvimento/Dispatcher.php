<?php

namespace Desenvolvimento;

class Dispatcher {
	
	private $dependencyManager = null;
	
	public function __construct( \Desenvolvimento\DependencyManager $dependencyManager )
	{
		
		$this->dependencyManager = $dependencyManager;
		
	}
	
	public function getRoutes(  )
	{
		
		return [ 
						"GET" => [ 
							"/php/brl-usd.php", 
							"/php/orders.php", 
						],
						"POST" => [ "/php/orders.php" ]
				  ];

		
	}
	
	public function getPathResource( $path_root_request, $request_method )
	{
	
		$path_root_request     = str_replace( "-", "", $path_root_request );
		$path_root_request     = strtolower( $path_root_request );
		$request_method        = strtolower( $request_method );
		$path_root_request     = preg_replace_callback('~(/)([a-z])~', function ($match) {
	
			return $match[1] . ucfirst( $match[2] );
		}, $path_root_request );
		$controller_class_name = ucfirst( $request_method ) . ucfirst( $path_root_request );
		$controller_class_name = str_replace( ".php", "", $controller_class_name );
		$controller_class_name = "Desenvolvimento/Route/" . $controller_class_name ;
		
		return $controller_class_name;
		
	}
		
	public function dispatch( $path_root_request = null, $request_method = null )
	{
				
		if( is_null( $path_root_request ) ) {
			$path_root_request = $_SERVER[ "PHP_SELF" ];
		}
		if( is_null( $request_method ) ) {
			$request_method    = $_SERVER[ "REQUEST_METHOD" ];
		}
		$routes = $this->getRoutes(  );
		
		if( !empty( $routes [ $request_method ] )  ) {
			
			if( in_array( $path_root_request, $routes [ $request_method ] ) ) {
				
				$controller_class_name = $this->getPathResource( $path_root_request, $request_method );
				$instance_controller = $this->dependencyManager->getInstanceDependencyOfContainer( $controller_class_name );
				$instance_controller->run(  );
				
				return $instance_controller;
				
			} else {
				
				throw new \RuntimeException( "the requested resource is not valid" );
				
			}
			
		}else { 
		
			throw new \RuntimeException( "the requested resource is not valid" );
			
		}
	}
	
}