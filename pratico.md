# Node

1\) Adicione o método `.last()` na classe `Array`, que retornará o último item do array, ou `undefined` caso o array estiver vazio

```js
// Resposta

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

console.log( ar1.last(  ) ) //undefined
console.log( ar2.last(  ) ) //5

// Teste/Exemplos
const array1 = [1,2,3,4,5,6,7,8,9]
console.log(array1.last()) //9

const array2 = []
console.log(array2.last()) //undefined
```

---

2\) Melhore a função a seguir:

```js
function getTransactions() {
    return new Promise((resolve, reject) => {
        fetch(BASE_URL + '/api/transacoes')
            .then(result => {
                result.json().then(transactions => {
                    var _transactions = []

                    for (var i in transactions) {
                        if (transactions[i].realizada)  {
                            _transactions.push({
                                id: transactions[i].id,
                                value: transactions[i].valor,
                                type: transactions[i].valor < 0 ? 'transference' : 'deposit',
                            })
                        }
                    }

                    resolve(_transactions)
                })
            })
            .catch(e => reject(e))
    })
}
```

```js
// Resposta

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

// ou

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

```

---

3\) No arquivo [index.js](./node/index.js), crie uma API restfull com as seguinte rotas:

Utilize [essa API](https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/aplicacao#!/CotacaoDolarDia#eyJmb3JtdWxhcmlvIjp7IiR0b3AiOjEwMCwiJGZvcm1hdCI6Impzb24iLCJkYXRhQ290YWNhbyI6IjA3LTIwLTIwMTgifSwicGVzcXVpc2FkbyI6dHJ1ZSwiYWN0aXZlVGFiIjoiZGFkb3MiLCJncmlkU3RhdGUiOnsDMAM6W3sDQgMiBDAEIiwDQQN9LHsDQgMiBDEEIiwDQQN9LHsDQgMiBDIEIiwDQQN9XSwDMQM6e30sAzIDOltdLAMzAzp7fSwDNAM6e30sAzUDOnt9fSwicGl2b3RPcHRpb25zIjp7A2EDOnt9LANiAzpbXSwDYwM6NTAwLANkAzpbXSwDZQM6W10sA2YDOltdLANnAzoia2V5X2FfdG9feiIsA2gDOiJrZXlfYV90b196IiwDaQM6e30sA2oDOnt9LANrAzo4NSwDbAM6ZmFsc2UsA20DOnt9LANuAzp7fSwDbwM6IkNvbnRhZ2VtIiwDcAM6IlRhYmxlIn19) com a cotação de venda do dia 20/07/2018 como referência

3.1) Cotação do dólar

Buscar a cotação do dólar na API do banco central (informada acima) e fazer cache de 4 horas.

Requisição:
```http
GET /api/brl-usd
```

Resposta:
```http
HTTP/1.1 200 OK
Content-Type: applicaton/json

{
    "brl": 1,
    "usd": 0.26
}
```

---

3.2) Geração de pedido

Receber uma lista de itens (em reais) e gerar o pedido.
O pedido deve conter a data/hora de criação, o total em reais e o total em dólares.

Requisição
```http
POST /api/orders
Content-Type: application/json

{"items": [1000, 500, 150]}
```

Resposta:
```http
HTTP/1.1 200 OK
Content-Type: applicaton/json
  
{
    "id": 1,
    "createdAt": "...",
    "totalBRL": 1650,
    "totalUSD": 435.84
}
```

---

3.3) Lista de pedidos

Retornar todos os pedidos salvos

Requisição
```http
GET /api/orders
```

Resposta:
```http
HTTP/1.1 200 OK
Content-Type: applicaton/json
  
[{
    "id": 1,
    "createdAt": "...",
    "totalBRL": 1650,
    "totalUSD": 435.84
},
{
    "id": 2,
    "createdAt": "...",
    "totalBRL": 1650,
    "totalUSD": 435.84
}]
```

---

# PHP

1\) Dentro da pasta [oop](./php/oop), crie as classes necessárias para representar um estacionamento

---

2\) Melhore a função a seguir:

```php
function login($username, $password) {
    $sql = "
        select * 
        from users 
        where username = $username AND password = $password
    ";

    $users = $pdo->query($sql);

    return $users[0];
}
```

```php
// Resposta

function login($username, $password) {
	
    $sql = "
        select * 
        from users 
        where username = :username AND password = :password
    ";

	$sth = $dbh->prepare( $sql );
	$sth->execute(array(':username' => $username, ':password' => $password));
	$user = $sth->fetch(PDO::FETCH_ASSOC);

    return $user;
	
}
```

---

3\) Dentro da pasta [php](./php), modifique os arquivos de cada pseudo-rota, para atender os seguintes requisitos:

Utilize [essa API](https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/aplicacao#!/CotacaoDolarDia#eyJmb3JtdWxhcmlvIjp7IiR0b3AiOjEwMCwiJGZvcm1hdCI6Impzb24iLCJkYXRhQ290YWNhbyI6IjA3LTIwLTIwMTgifSwicGVzcXVpc2FkbyI6dHJ1ZSwiYWN0aXZlVGFiIjoiZGFkb3MiLCJncmlkU3RhdGUiOnsDMAM6W3sDQgMiBDAEIiwDQQN9LHsDQgMiBDEEIiwDQQN9LHsDQgMiBDIEIiwDQQN9XSwDMQM6e30sAzIDOltdLAMzAzp7fSwDNAM6e30sAzUDOnt9fSwicGl2b3RPcHRpb25zIjp7A2EDOnt9LANiAzpbXSwDYwM6NTAwLANkAzpbXSwDZQM6W10sA2YDOltdLANnAzoia2V5X2FfdG9feiIsA2gDOiJrZXlfYV90b196IiwDaQM6e30sA2oDOnt9LANrAzo4NSwDbAM6ZmFsc2UsA20DOnt9LANuAzp7fSwDbwM6IkNvbnRhZ2VtIiwDcAM6IlRhYmxlIn19) com a cotação de venda do dia 20/07/2018 como referência

3.1) Cotação do dólar

Buscar a cotação do dólar na API do banco central (informada acima) e fazer cache de 4 horas.

Requisição:
```http
GET /php/brl-usd.php
```

Resposta:
```http
HTTP/1.1 200 OK
Content-Type: applicaton/json

{
    "brl": 1,
    "usd": 0.26
}
```

3.2) Geração de pedido

Receber uma lista de itens (em reais) e gerar o pedido.
O pedido deve conter a data/hora de criação, o total em reais e o total em dólares.

Requisição:
```http
POST /php/orders.php
Content-Type: application/x-www-form-urlencoded

items[]=1000&items[]=500&items[]=150
```

Resposta:
```http
HTTP/1.1 200 OK
Content-Type: applicaton/json
  
{
    "id": 1,
    "created_at": "...",
    "total_brl": 1650,
    "total_usd": 435.84
}
```

---

3.3) Lista de pedidos

Retornar todos os pedidos salvos

Requisição
```http
GET /php/orders.php
```

Resposta:
```http
HTTP/1.1 200 OK
Content-Type: applicaton/json
  
[{
    "id": 1,
    "createdAt": "...",
    "totalBRL": 1650,
    "totalUSD": 435.84
},
{
    "id": 2,
    "createdAt": "...",
    "totalBRL": 1650,
    "totalUSD": 435.84
}]
```
