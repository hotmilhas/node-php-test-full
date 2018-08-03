<?php

namespace Desenvolvimento;

class DependencyManager{
	
	private $dependencyContainer = null; 
	
	public function __construct( \Pimple\Container $dependencyContainer )
	{
		
		$this->dependencyContainer = $dependencyContainer;
		$this->setDependencies( );
		
	}
	
	public function setDependencies( ) 
	{
		$this->dependencyContainer["Desenvolvimento/ClientRequest"] = function ( $recipient ) {
			return new \Desenvolvimento\ClientRequest(  );	
		};
		$this->dependencyContainer["Desenvolvimento/DollarQuotation"] = function ( $recipient ) {
			return new \Desenvolvimento\DollarQuotation( $recipient["Desenvolvimento/ClientRequest"] );	
		};
		$this->dependencyContainer["Desenvolvimento/DependencyManager"] = function ( $recipient ) {
			return new \Desenvolvimento\DependencyManager( $recipient );	
		};
		$this->dependencyContainer["Desenvolvimento/Dispatcher"] = function ( $recipient ) {
			return new \Desenvolvimento\Dispatcher( $recipient["Desenvolvimento/DependencyManager"] );	
		};
		$this->dependencyContainer["FileSystemCache"] = function ( $recipient ) {
			return new \FileSystemCache(  );	
		};
		$this->dependencyContainer["Desenvolvimento/Order"] = function ( $recipient ) {
			return new \Desenvolvimento\Order( $recipient["FileSystemCache"] );	
		};
		
		$this->dependencyContainer["Desenvolvimento/Route/Get/Php/Brlusd"] = function ( $recipient ) {
			return new \Desenvolvimento\Route\Get\Php\Brlusd( $recipient["Desenvolvimento/DollarQuotation"] );	
		};
		$this->dependencyContainer["Desenvolvimento/Route/Post/Php/Orders"] = function ( $recipient ) {
			return new \Desenvolvimento\Route\Post\Php\Orders( $recipient["Desenvolvimento/Order"], $recipient["Desenvolvimento/DollarQuotation"] );	
		};
		$this->dependencyContainer["Desenvolvimento/Route/Get/Php/Orders"] = function ( $recipient ) {
			return new \Desenvolvimento\Route\Get\Php\Orders( $recipient["Desenvolvimento/Order"] );	
		};
		
	}
	
	public function getInstanceDependencyOfContainer( $nameDependencyRecipient )
	{
		if( empty( $this->dependencyContainer[$nameDependencyRecipient] ) ) { 
		
			throw new \RuntimeException( "the dependency `$nameDependencyRecipient` is invalid" );
			
		}
		
		return $this->dependencyContainer[$nameDependencyRecipient];
		
	}
	
}