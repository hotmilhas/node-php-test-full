# Node

1\) Qual a diferença do operador `==` para o operador `===` em JavaScript?

O operador `==` não compara o tipo das variáveis envolvidas na operação, já o operador `===` considera o tipo para efetuar a comparação.

1.1) Dê 2 exemplos de quando os operadores produziriam resultados diferentes

```js
// a variável a possui valor 1 e tipo inteiro, já a variável b possui valor 1 e tipo string
let a = 1;
let b = '1';
// o output da comparação abaixo será true, pois o operador == não considera o tipo.
console.log(a == b);
// o output da comparação abaixo será fase, pois o operador === considera o tipo.
console.log(a === b);
// o output da comparação abaixo será false, pois o operador != não considera o tipo.
console.log(a != b);
// o output da comparação abaixo será true, pois o operador !== considera o tipo.
console.log(a !== b);

```

---

2\) Qual recurso javascript é mais recomendado para tratar chamadas asíncronas?

Promise

2.1) Justifique

Além de ser uma forma organizada de fazer uma chamada assíncrona é um padrão que várias bibliotecas e recursos do javascript vem adotando.

---

3\) Existem threads em Node?

Não

3.1) Explique

O Node trabalha com single thread, porém utiliza de recursos assíncronos não bloqueantes para garantir performance.

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
O resultado do codigo acima é undefined. Caso a intenção seja retornar a lista de telefones é necessário declarar 'return' antes da chamada do método getUserPhones, como no código a seguir:
```js
function getUserByName(name) {
    return Promise.resolve({id: 1, name: name})
}

function getUserPhones(userId) {
    return Promise.resolve(['(31) 90900800', '(31) 08009090'])
}

getUserByName('jonh doe')
    .then(user => { 
        return getUserPhones(user.id)
    })
    .then(user => console.log(user))
```

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
O resultado do código acima é 'second', pois como o valor de id é undefined a função reject é executada
```

---

# PHP

1\) Qual a diferença do operador `==` para o operador `===` em PHP?

O operador `==` não compara o tipo das variáveis envolvidas na operação, já o operador `===` considera o tipo para efetuar a comparação.

1.1) Dê 2 exemplos de quando os operadores produziriam resultados diferentes

```php
// a seguir, a variável $a possui valor 1 de tipo inteiro e a variável $b com valor 1 de tipo string
$a = 1;
$b = '1';
// a comparação a seguir não considera os tipos, $r terá valor true
$r = ($a == $b);
// a comparação a seguir considera os tipos, $r terá valor false
$r = ($a === $b);
// a comparação a seguir não considera os tipos, $r terá valor false
$r = ($a != $b);
// a comparação a seguir considera os tipos, $r terá valor true
$r = ($a !== $b);
```

---

2\) Qual a função do apache ou nginx em uma aplicação PHP?

A função é serem servidores web de aplicações escritas em PHP.

---

3\) Existem threads em PHP?

Sim.

3.1) Explique

Para trabalhar com Thread no PHP é necessario adicionar a biblioteca pthreads e estender a classe Thread nas classes em que quiser trabalhar com Thread.

---

4\) Qual o resultado dos códigos a seguir?

4.1)
```php
class Test {
    const prop = 1000 + 337;
}

echo Test::prop;
```

O resultado é 1337

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

O resultado é 'bar'