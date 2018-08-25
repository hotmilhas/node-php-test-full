# Node

1\) Qual a diferença do operador `==` para o operador `===` em JavaScript?

O operador '===' além de verificar se os valores são iguais, ele também verifica se são do mesmo tipo, já o operador '==' apenas verificas se os valores são iguais, sem considerar a tipagem.


1.1) Dê 2 exemplos de quando os operadores produziriam resultados diferentes

'1' == 1; // true
'1' === 1; // false
undefined == false; // true
undefined === false; // false

---

2\) Qual recurso javascript é mais recomendado para tratar chamadas asíncronas?

O recurso mais recomendado para tratar chamadas assíncronas são as Promises.

2.1) Justifique

Com o uso das Promises, é possível controlar o fluxo de execução do código javascript, permitindo decidir o que será retornado caso uma Promise seja aceita ou rejeitada executar o callback correto através do método then() da Promise que pode inclusive ser encadeado a outros métodos then().

---

3\) Existem threads em Node?

Node é single thread.

3.1) Explique

Node trabalha com single thread não bloqueante e executa funções de maneiras assíncronas através de um event-loop que recebe todas as requisições. Porém é possível destribuir essas requisições para novos processos através do uso de clusterização. 

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

Resultado: undefined

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

Resultado : second

---

# PHP

1\) Qual a diferença do operador `==` para o operador `===` em PHP?

O operador '===' além de verificar se os valores são iguais, ele também verifica se são do mesmo tipo, já o operador '==' apenas verificas se os valores são iguais, sem considerar a tipagem.


1.1) Dê 2 exemplos de quando os operadores produziriam resultados diferentes

```
$a = '1';
$a == 1; // true
$a === 1; // false
$a == true; // true
$a === true; // false

```

---

2\) Qual a função do apache ou nginx em uma aplicação PHP?

A função do apache / nginx é criar um servidor web para receber as requisições HTTP, buscar os arquivos necessários e / ou executar scripts PHP e devolver o html ao cliente.

---

3\) Existem threads em PHP?

Sim, PHP é uma linguagem multi thread.

3.1) Explique

PHP suporta processamento em paralelo através do uso da extensão pthreads.

---

4\) Qual o resultado dos códigos a seguir?

4.1)
```php
class Test {
    const prop = 1000 + 337;
}

echo Test::prop;
```

1337

4.2)
```php
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

'bar'
