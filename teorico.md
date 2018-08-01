# Node

1\) Qual a diferença do operador `==` para o operador `===` em JavaScript?

[O operador `==` avalia se dois elementos em comparação contem um mesmo valor enquanto que o operador `===` avalia alem de se dois elementos em comparação possuem o mesmo valor e o mesmo tipo.]

1.1) Dê 2 exemplos de quando os operadores produziriam resultados diferentes

```js
// Resposta

//Exemplo1:
let first_element = 20
let second_element  = "20"

console.log( first_element == second_element ) 
// irá imprimir `true` pois ambos os elementos comparativos tem o mesmo valor
console.log( first_element === second_element )
// irá imprimir `false` pois ambos os elementos comparativos tem o mesmo valor, mas não tem o mesmo tipo

//Exemplo2:
let first_element = 50
let second_element  = "50"

console.log( first_element == second_element ) 
// irá imprimir `true` pois ambos os elementos comparativos tem o mesmo valor
console.log( first_element === second_element ) 
// irá imprimir `false` pois ambos os elementos comparativos tem o mesmo valor, mas não tem o mesmo tipo

```

---

2\) Qual recurso javascript é mais recomendado para tratar chamadas assíncronas?

[Promises]

2.1) Justifique

[Existem dois recursos bem famosos para tratrar chamadas assíncronas em javascript, são eles callbacks e promises, porém
os promises são mais recomendados para o tratamento de chamadas assíncrona, pois permite escrever o código como se fosse 
síncrono diferente dos callbacks que geram chamadas dentro funções para utilizar o valor processado de uma função em
outra chamada interna, e isso pode torna dificil o entendimento e manutenção, e testabilidade. 
Com promises o fluxo de chamadas é controlado após a resulução das promessas com o metodo then, e ainda podemos tratar 
o fluxo de execução através dos parametros resolve e reject da promises.]

---

3\) Existem threads em Node?

[Sim]

3.1) Explique

[O node é single thread, porem utiliza de uma arquitetura conhecida como event drive, para fazer um enfileiramento de tarefas, 
que são pequenos processamentos ou seja execuções de callbacks ou resolução de promises através de um fluxo controlado pelo 
elemento conhecido como event loop. Este fluxo quebra o processamento de determinada rotina, script ou requisição em tasks 
que são enfileiradas em uma task queue e são executas uma a uma dentro de uma unica stack ou seja ao final da execução de 
uma task a proxima task na fila é adicionada na pilha de execução e o event loop segue seu fluxo executando varias de tasks,
utilizando-se de uma single thread sem a necessida de grande capacidade computacional do servidor.]

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

[O resultado é `undefined`, pois o fluxo de execução assincrono do javascript impede que um valor seja utiliza antes da 
resolução de uma função, ou seja para que fosse possível utilizar o userId, seria necessário realizar mudanças no 
código. ]

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


[O resultado é `second`, pois a promise resultante do método getData é reijada, pelo fato da chamada do método não passar,
 o parametro como é definido no ato da assinatura do método `getData(id)`. ]


---

# PHP

1\) Qual a diferença do operador `==` para o operador `===` em PHP?

[O operador `==` avalia se dois elementos em comparação contem um mesmo valor enquanto que o operador `===` avalia alem de se dois elementos em comparação possuem o mesmo valor e o mesmo tipo.]

1.1) Dê 2 exemplos de quando os operadores produziriam resultados diferentes

```php
// Resposta
//Exemplo1:
$first_element = 20;
$second_element  = "20";

var_dump( $first_element == $second_element ) ;
// irá imprimir `true` pois ambos os elementos comparativos tem o mesmo valor
var_dump( $first_element === $second_element ) ;
// irá imprimir `false` pois ambos os elementos comparativos tem o mesmo valor, mas não tem o mesmo tipo

//Exemplo2:
$first_element = 50;
$second_element  = "50";

var_dump( $first_element == $second_element ) ;
// irá imprimir `true` pois ambos os elementos comparativos tem o mesmo valor
var_dump( $first_element === $second_element ) ;
// irá imprimir `false` pois ambos os elementos comparativos tem o mesmo valor, mas não tem o mesmo tipo
```

---

2\) Qual a função do apache ou nginx em uma aplicação PHP?

[O apache ou nginx são servidores web, que tratam requisições e respostas de scripts  de uma aplicação construída 
em alguma linguagem como php, por exemplo. Além disso o apache e nginx, permitem realiza configurações 
no servidor que roda uma aplicação web.]

---

3\) Existem threads em PHP?

[Sim]

3.1) Explique

[Para utilizar o recurso de threads no php é necessário instalar um modulo chamado pthreads, este módulo 
possibilita criar classes que extendem a classe abstrata Thread, para ter suas próprias classes de manipulação de
threads personalizadas é necessários implementas o método principal `run`, dentre outros para utilzar os recursos
 de threads em php.]

---

4\) Qual o resultado dos códigos a seguir?

4.1)
```php
class Test {
    const prop = 1000 + 337;
}

echo Test::prop;
```

[1337, pois constantes declaradas utilizando chave `const` permitem o uso de expressoes que produzem valores
escalares como um inteiro por exemplo, seja armazenado em seu conteúdo.  ]

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

[O resuldado será a impressao da string `bar` pois a chamada do metodo estático `test` chama o método `foo`
 utilizando a palavra chave `self` associado ao operador de resolução de escopo `::`, se fosse utilizado a
 a palavra chave `static` associado ao operador de resolução de escopo `::`, o resultado seria: `baz`]
