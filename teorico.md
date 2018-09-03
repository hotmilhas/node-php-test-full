# Node

1\) Qual a diferença do operador `==` para o operador `===` em JavaScript?

O operador de igualdade `==` converte os operandos para um mesmo tipo, caso não sejam e em seguida faz a comparação estrita.
O operador de identidade `===` retorna verdadeiro se ambos os operandos forem estritamente idênticos, sem conversão de tipo.

1.1) Dê 2 exemplos de quando os operadores produziriam resultados diferentes

```js
// Resposta

const a = 1
const b = true

console.log({
    'a == b': a==b, // true
    'a === b': a===b // false
});
```

---

2\) Qual recurso javascript é mais recomendado para tratar chamadas asíncronas?

`Async/Await ` 

2.1) Justifique

Entre utilizar `callbacks`, `promises` ou `async/await`, o último deixa o código
mais limpo e conciso, facilita a manipulacao de erros utilizando `try/catch`,
o uso de condicionais fica mais legível e melhora a depuração de erros, por
exemplo: quando houver um ponto de interrupção detro de um bloco `.then` ao
passar para o próximo passo o depurador seguirá direto ao invés de parar no
próximo `.then` por não ser um código síncrono e uma pilha de erros
retornada de uma cadeia de `Promises` não dá idéia de onde o erro ocorreu.

---

3\) Existem threads em Node?

[Resposta]

3.1) Explique

[Resposta]

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

---

# PHP

1\) Qual a diferença do operador `==` para o operador `===` em PHP?

[Resposta]

1.1) Dê 2 exemplos de quando os operadores produziriam resultados diferentes

```php
// Resposta
```

---

2\) Qual a função do apache ou nginx em uma aplicação PHP?

[Resposta]

---

3\) Existem threads em PHP?

[Resposta]

3.1) Explique

[Resposta]

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