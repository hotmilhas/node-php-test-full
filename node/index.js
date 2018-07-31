var express = require('express');
var app = express();
var bodyParser = require('body-parser');
var cache = require('memory-cache');

app.use(function (req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

var clients = require('restify-clients');
var client = clients.createJsonClient({
    url: "https://olinda.bcb.gov.br"
});

app.get('/', function (req, res) {
    res.send('hello world');
});

app.get('/api/brl-usd', function (req, res) {
    let cotacao = cache.get('cotacao');
    if(cotacao){
        res.send(cotacao);
    }else{
        client.get(`/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao='07-20-2018'&$top=100&$format=json`, (error, reqx, resx, retornox) => {
            cache.put('cotacao',retornox, 14400000);
            res.send(retornox);
        });
    }
});

app.post('/api/orders', function (req, res) {
    let items = req.body.items;
    let total = 0.0;

    items.forEach(item=>{
        total += item;
    })

    let orders = cache.get('orders');
    let id = 1; 
    if(orders){
        id = orders[orders.length - 1].id + 1;
    }else{
        console.log('nao tem')
        orders = [];
    }

    item = {
        id: id,
        createdAt: '30/07/2018',
        totalBRL: total,
        totalUSD: total * 3.73
    }

    orders.push(item);
    cache.put('orders',orders);
    res.send(item);
});

app.get('/api/orders', function (req, res) {
    let orders = cache.get('orders');
    res.send(orders?orders:[]);
});

const porta = 3000;

app.listen(3000, function () {
    console.log(`Aplicação radando na porta ${porta}`);
});