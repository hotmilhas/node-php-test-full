# Node

1\) Qual a diferença do operador `==` para o operador `===` em JavaScript?

[Resposta]
    ambos são operadores de igualdade no entanto quando se usam tres '===' ele também irá verificar se o tipo de dados também é igual.

1.1) Dê 2 exemplos de quando os operadores produziriam resultados diferentes

```js
// Resposta
```
    var valorA = 3.0;
    var ValorB = "3.0";

    if(valorA == ValorB) //true

    if(ValorA === valorB) //falso
---

2\) Qual recurso javascript é mais recomendado para tratar chamadas asíncronas?

[Resposta]
    utilizando o XMLHttpRequest do Ajax.

2.1) Justifique

[Resposta]
    quando este recurso é utilizado o processo fica rodando enquanto o cliente continua fazendo suas tarefas, essa solicitação é verificada e se ela finalizar e não houver erros no servidor os dados do serivço são processados e exibidos na pagina.
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
    Resultará em uma promisse com status resolved, no entanto o valor será undefined.
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
    o valor será uma promisse com status resolved e o valor de undefined, no entanto no segundo bloco de codigo o resultado será second
---

# PHP

1\) Qual a diferença do operador `==` para o operador `===` em PHP?

[Resposta]
    ambos são operadores de igualdade no entanto quando se usam tres '===' ele também irá verificar se o tipo de dados também é igual.

1.1) Dê 2 exemplos de quando os operadores produziriam resultados diferentes

```php
// Resposta
```
    $a = 123;
    $b = '123';

    if($a == $b){
        echo '$a e $b são iguais'; //true
    }

    if($a === $b){ // false vai cair no else.
        echo '$a e $b são iguais e são do mesmo tipo';
    }
    else {
        echo '$a e $b são iguais POREM NÃO são do mesmo tipo';
    }
---

2\) Qual a função do apache ou nginx em uma aplicação PHP?

[Resposta]
    ambos são servidores web capazes de fazer a interpretação entre os codigos PHP e traduzilas para visualização.
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
    1337;

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
bar