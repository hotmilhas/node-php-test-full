"use strict"


class Order {
	
	
	constructor( cacheManager ) {
		
		this.cacheManager = cacheManager
		
	}
	
	getOrders(  ) { 
	
		
		return new Promise((resolve, reject) => { 
			
			let orders = this.cacheManager.getDataOrdersCache( )
			
			return resolve( orders )
        
		});
		
	}
	
	findInfoOrderId( orders ) { 
	
		return new Promise((resolve, reject) => { 
			
			let orderIds= [  ];
			let maxOrderId = 1;
			
			for ( let i in orders ) {
				orderIds.push( orders[ i ].id )
			}
			
			if( orderIds.length > 0 ) { 
				
				maxOrderId = Math.max.apply(null, orderIds );
				maxOrderId = maxOrderId + 1
				
			}
			
			let order_info = { orders : orders, maxOrderId : maxOrderId }
			
			return resolve( order_info )
			
        
		});
		
		
	}
	
	
	insertOrder( req_params, cotation_brl ) { 
	
		return new Promise((resolve, reject) => { 
			
			if( !req_params.items ) { 
			
				reject( "params items is invalid. Check the headers content type of requests" )
			}
			let items = req_params.items
			let total_items = items.reduce((x, y) => x + y)
			let createdAt   = new Date()
			let total_usd   = total_items * cotation_brl
			
			this.getOrders(  )
				.then( this.findInfoOrderId )
				.then(
						(result) => {
						   
						   let orders = result.orders
						   let info_order_record = { id : result.maxOrderId, createdAt : createdAt, totalBRL: total_items, totalUSD : total_usd }
						   
						   orders.push( info_order_record )
						   
						   this.cacheManager.recordDataOrdersCache( orders )
						   
						   return resolve( info_order_record )
						},
						
						(error) => {
							console.log(`ocorreu o seguinte erro: [ ${error} ]`);
						})
	
		});
		
	}
		
		
}

module.exports = Order