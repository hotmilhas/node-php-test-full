"use strict"

const https = require( 'https' )

class DollarQuotation {
	
	
	requestQuotationBcb(  ) { 
	
		let options = {
		  host: 'olinda.bcb.gov.br',
		  path: "/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao='07-20-2018'&$top=100&$format=json"
		};
	
		
		return new Promise((resolve, reject) => {
			let req = https.get(options, ( response_https ) => {
				
					if( response_https.statusCode != 200) {
						
						return reject( "Invalid status code response of request" )
						
					}
					
					return resolve( response_https );
					
				})
				
				req.on('error', function(e) {
					return reject( e )
				});
        
		});
		
	}
	
	proccessDataQuotation ( response_https ) { 
		
		return new Promise( ( resolve, reject ) => { 
			
			if( !response_https ) { 
				
				return reject( "Invalid response" ) 
				
			}
			
			let bodyChunks = [];
			
			response_https.on('data', function(chunk) {
				
				bodyChunks.push(chunk);
				
			}).on('end', function() {
				
				return resolve( JSON.parse( bodyChunks ) )
			
			})
		  
		} )
		
	}
	
	calculateDollarQuotation( dataQuotation ) { 
	
		
		return new Promise( ( resolve, reject ) => { 
			
			if( !dataQuotation ) { 
				
				return reject( "Invalid data quotation" ) 
				
			}
			
			if( !dataQuotation.value ) { 
				
				return reject( "Invalid data quotation" ) 
				
			}
			
			let cotation = 0
			if( dataQuotation.value[ 0 ].cotacaoCompra != 0 ) { 
				cotation = 1 / dataQuotation.value[ 0 ].cotacaoCompra
				cotation = Number(( cotation ).toFixed(2))
			} 
			
			return resolve( cotation )
			
			
		  
		} )
		
	}
	
			
}

module.exports = DollarQuotation