<?php

require "vendor/autoload.php";

header('Content-Type: application/json');

$dependencyManager = new \Desenvolvimento\DependencyManager( new \Pimple\Container(  ) );

try{ 

	$dispatcher = $dependencyManager->getInstanceDependencyOfContainer( "Desenvolvimento/Dispatcher" );
	$dispatcher->dispatch(  );
	
}catch( \RuntimeException $e ) {
	
	echo json_encode( $e->getMessage()  );
}