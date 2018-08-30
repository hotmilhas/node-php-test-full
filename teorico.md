# Node

1\) Qual a diferença do operador `==` para o operador `===` em JavaScript?

[Resposta]

`==` compara apenas o valor
`===` compara o valor e o tipo do valor

1.1) Dê 2 exemplos de quando os operadores produziriam resultados diferentes


```js
  false == 'false' retorna true
  false === 'false' retorna false
```

---

2\) Qual recurso javascript é mais recomendado para tratar chamadas asíncronas?

[Resposta]
Promises

2.1) Justifique

[Resposta]
Pelo fato der ser uma maneira mais rápida e organizada de executar alguma ação, enquanto alguma outra é executada e 
por ser uma maneira mais fácil de gerenciar a resposta de cada ação executada.
---

3\) Existem threads em Node?

[Resposta]
Sim

3.1) Explique

[Resposta]
O node foi criado justamente com o objetivo de ser uma biblioteca capaz de trabalhar com I/O de uma maneira mais
 eficiente e não obtrutiva, capaz de executar varias ações ao mesmo tempo.

---

4\) Qual o resultado dos códigos a seguir?

4.1)
```js
function getUserByName(name) {
    return Promise.resolve({id: 1, name: name})
}

function getUserPhones(userId) {
    return Promise.resolve(['(31) 90900800', '(31) 08009090'])
}

getUserByName('jonh doe')
    .then(user => { 
        getUserPhones(user.id)
    })
    .then(user => console.log(user))
```

[Resposta]
 getUserByName vai retornar uma promise com status resolved com array de objeto com o id e name, então,
  getUserPhones vai retornar array com valores de telefone, então, ele vai tentar imprimir o valor dentro do objeto
  user no console.log
 
4.2)
```js
function getData(id) {
    return new Promise((resolve, reject) => {
        if (!id) {
            return reject(new Error('invalid'))
        }

        resolve({ foo: 'bar' })
    })
}

getData()
    .then(() => {
        console.log('first')
    }, () => {
        console.log('second')
    })
    .catch(() => {
        console.log('third')
    })
```

```
[Resposta]
```
getData recebe um parametro (id) e dentro da promise ele testa se id é um valor true ou false, se for true
imprime 'first' se for false imprime 'second' ou em caso de erro imprime 'third'
---

# PHP

1\) Qual a diferença do operador `==` para o operador `===` em PHP?

[Resposta]

1.1) Dê 2 exemplos de quando os operadores produziriam resultados diferentes

```php
// Resposta
```
`==` compara apenas o valor
`===` compara o valor e o tipo do valor
  false == 'false' retorna true
  false === 'false' retorna false

---

2\) Qual a função do apache ou nginx em uma aplicação PHP?

[Resposta]
são serviços responsaveis por responder as requisições do protocolo http se comunicando com o php
---

3\) Existem threads em PHP?

[Resposta]
 sim e não
3.1) Explique

[Resposta]
O php disponibiliza em forma de modulo chamado pthreads, o  modulo  precisa ser habilitado, threads não estão
disponiveis na build 'normal' do php, mas somente esta disponível para o modo cli, para o ambiente de web service
ainda não está disponivel
---

4\) Qual o resultado dos códigos a seguir?

4.1)
```php
class Test {
    const prop = 1000 + 337;
}

echo Test::prop;
```

[Resposta]
Ira fazer a soma, guardar o valor na constante prop e imprimir o valor 1337
4.2)
```js
class A {
    public static function foo() {
        return 'bar';
    }

    public static function test() {
        echo self::foo();
    }
}

class B extends A {
    public static function foo() {
        return 'baz';
    }
}

B::test();
```

[Resposta]

Classe B extende de classe A que acessa de forma estatica o metodo test que imprime o metodo estatico foo da mesma
(self) classe (A)