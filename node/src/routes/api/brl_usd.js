const https = require( 'https' )
const dollarQuotation = require( "./../../business/dollar-quotation" )
const cacheManager = require( "./../../business/cache-manager" )

module.exports = ( req, res ) => { 
	
	let dollar_quotation = new dollarQuotation(  )
		
	let cache_manager = new cacheManager( dollar_quotation )
	
	cache_manager.getDataDollarQuotation(  )
		.then(
			(result) => {
			   
			   return res.json( { brl: 1, usd : result } )
			},
			
			(error) => {
				console.log(`ocorreu o seguinte erro: [ ${error} ]`);
			}
		)
	
	
} 
