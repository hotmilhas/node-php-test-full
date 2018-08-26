# Node

1\) Adicione o método `.last()` na classe `Array`, que retornará o último item do array, ou `undefined` caso o array estiver vazio

```js
// Resposta
Array.prototype.last = () => { return this[this.length - 1]; };

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
