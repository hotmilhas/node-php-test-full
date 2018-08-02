"use strict"

class Array {
	
	constructor( elements ) {
		
		this.setElements( elements )
	}
	
	setElements( elements ) 
	{
		if( elements != null ) { 
			this.elements = elements
		}else {
			this.elements = []
		}
	}
	
	last( ) {
		
		if( this.elements.length > 0 ) { 
			return this.elements[ this.elements.length - 1 ]
		} else {
			return undefined;
		}
	}
}

let ar1 = new Array(  )
let ar2 = new Array( [1, 2, 3, 4, 5] )

//console.log( ar1, ar2 )
//console.log( ar1.last(  ), ar2.last(  ) )

//"use strict";

function retornarDadosUsuario() {
    
    return new Promise((resolve, reject) => {
        
        const usuario = { 'nome': 'Erick Wendel', 'id': 10 };
         
        return resolve(usuario);

    });

};

function retornarEndereco(usuario) {
    return new Promise((resolve, reject) => {
        usuario.endereco = [{ 'userId': usuario.id, 'descricao': 'Rua dos bobos, 0' }];
        return resolve(usuario);
    });
};
function retornarTelefone(usuario) {
    return new Promise((resolve, reject) => {
        usuario.telefone = [{ 'userId': usuario.id, 'numero': '(11) 9999-9999' }];
        return resolve(usuario);
    });
};

function retornarVeiculo(usuario) {
    return new Promise((resolve, reject) => {
        usuario.veiculo = { 'userId': usuario.id, 'descricao': 'Fuscão Turbo' };
        return resolve(usuario);
    });
};

function getTransactions() {
    return new Promise((resolve, reject) => {
        fetch(BASE_URL + '/api/transacoes')
            .then(result => {
                result.json().then(transactions_result => {
                    const transactions = []

                    for (let i in transactions_result) {
                        if (transactions_result[i].realizada)  {
                            transactions.push({
                                id: transactions_result[i].id,
                                value: transactions_result[i].valor,
                                type: transactions_result[i].valor < 0 ? 'transference' : 'deposit',
                            })
                        }
                    }

                    return resolve(transactions)
                })
            })
            .catch(e => { 
				return reject(e)
			})
    })
}



class ResponseTransaction {
	
	constructor( elements ) {
		
		this.json(  )
	}
	
	json(  ) { 
	
		this.elements = 
			
			[
				{ id: 1, valor: -1, realizada: true }, 
				{ id: 1, valor: 50, realizada: true }, 
				{ id: 1, valor: 181, realizada: false } 
			]
		 
		return this.elements
		
	}

}
	
	
const BASE_URL = 'http://teste.desenvolvimento.nodejs';

function fetch( url ) {
	
	console.log( url ) 
	return new Promise((resolve, reject) => {
        
        const response_transaction = new ResponseTransaction(  );
        //console.log( response_transaction.json(  ) )
        return resolve(response_transaction);

    });
	
}

function resolvePromiseFetchResult( result ) {
	
	
	return new Promise((resolve, reject) => {
		
		if( !result ) {
			
			return reject( "Invalid result" )
		}

        return resolve( result.json() )
    });
}

function buildArraySuccessfully( arrayTransactionsResult ) {
	
	
	
	return new Promise((resolve, reject) => {
		
		if( !arrayTransactionsResult ) {
		
			return reject( "Invalid array transaction result" )
			
		}

		let transactions = []
		
		for (let i in arrayTransactionsResult) {
			
			if (arrayTransactionsResult[i].realizada)  {
				transactions.push({
					id: arrayTransactionsResult[i].id,
					value: arrayTransactionsResult[i].valor,
					type: arrayTransactionsResult[i].valor < 0 ? 'transference' : 'deposit',
				})
			}
		}

		return resolve(transactions)
		
    });
	
}



function getTransactions2(  ) { 
	
	return new Promise((resolve, reject) => {
        
        const url = BASE_URL + '/api/transacoes';
		 
		return resolve( url )

    });

}


getTransactions2(  )
	.then( fetch )
	.then( resolvePromiseFetchResult )
	.then( buildArraySuccessfully )
	.then(
        (result) => {
           console.log(result);
        },
        
        (error) => {
            console.log(`ocorreu o seguinte erro: [ ${error} ]`);
        });






retornarDadosUsuario()
    
    .then(retornarEndereco)
    .then(retornarTelefone)
    .then(retornarVeiculo)

    .then(
        (resultados) => {
            let mensagem = `
                                Usuario: ${resultados.nome},
                                Endereco: ${resultados.endereco[0].descricao}
                                Telefone: ${resultados.telefone[0].numero}
                                Veiculo: ${resultados.veiculo.descricao}
                            `;

            //console.log(mensagem);
        },
        
        (error) => {
            console.log(`deu zica !!!! [ ${error} ]`);
        });