"use strict"

const nodeCache = require( "node-cache" )
const cacheManager  = new nodeCache(  )

class CacheManager {
	
	
	constructor( dollarQuotation ) {
		
		this.dollarQuotation = dollarQuotation
		
	}
	
	recoverDataDollarQuotation(  ) { 
	
		
		return new Promise((resolve, reject) => { 
			
			cacheManager.get( "dollar_quotation", ( err, value ) => {
			
				if( !err ){
					
					  return resolve( value )
					
				}else { 
					
					return reject ( err )
				
				}
			
			} )
        
		});
		
	}
	getDataDollarQuotation( value ) { 
	
		
		return new Promise((resolve, reject) => { 
			
			
			cacheManager.get( "dollar_quotation", ( err, value ) => {
			
				if( !err ){
					
					  if(value == undefined){
			  
						  this.dollarQuotation.requestQuotationBcb(  )
							.then( this.dollarQuotation.proccessDataQuotation )
							.then( this.dollarQuotation.calculateDollarQuotation )
							.then(
							(result) => {
							   
							   cacheManager.set( "dollar_quotation", result, 14400, ( err, success) => {
								if( !err && success ){
									
									return resolve( result )
								  }
							  });
							},
							
							(error) => {
								console.log(`ocorreu o seguinte erro: [ ${error} ]`);
							})
						  
						}else{
						  
						  return resolve( value )
						}
					
				}else { 
					
					return reject ( err )
				
				}
			
			} )
			
				

        
		});
		
	}
	
	getDataOrdersCache( ) {
		
		return new Promise((resolve, reject) => { 
			
			
			cacheManager.get( "orders", ( err, value ) => {
			
				if( !err ){
					
					  if(value == undefined){
			  
						  return resolve( [  ] )
						  
						}else{
						  
						  return resolve( value )
						}
					
				}else { 
					
					return reject ( err )
				
				}
			
			} )
			
				

        
		});
		
	}
	
	recordDataOrdersCache( dataOrders ) {
		
		return new Promise((resolve, reject) => {
			cacheManager.set( "orders", dataOrders, 14400, ( err, success) => {
									if( !err && success ){
										
										return resolve( success )
									}else {
										reject( "Error to record orders" )
									}
									
			});
				


				
		} )
		
		
		
							  
	}
}

module.exports = CacheManager