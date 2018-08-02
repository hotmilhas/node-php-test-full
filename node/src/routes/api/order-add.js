const https = require( 'https' )
const dollarQuotation = require( "./../../business/dollar-quotation" )
const cacheManager = require( "./../../business/cache-manager" )
const order = require( "./../../business/order" )

module.exports = ( req, res ) => { 
	
	let dollar_quotation = new dollarQuotation(  )
		
	let cache_manager = new cacheManager( dollar_quotation )
	
	let order_manager = new order( cache_manager )
	
	cache_manager.getDataDollarQuotation(  )
		.then(
			( cotation_brl ) => {
			   
				order_manager.insertOrder( req.body, cotation_brl )
					.then( 
						( result ) => { 
							
							return res.json( result )
							
						},
						
						( error ) => { 
							
							console.log(`ocorreu o seguinte erro: [ ${error} ]`);
							
						}
					)
			   
			},
			
			(error) => {
				console.log(`ocorreu o seguinte erro: [ ${error} ]`);
			}
		)
	
	
} 
