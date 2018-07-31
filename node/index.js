var express = require('express');
var app = express();
var bodyParser = require('body-parser');

app.use(function (req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));


// routes
controllers = require('./controllers.js');

app.get('/', controllers.hello);

app.get('/api/brl-usd', controllers.cotar);

app.post('/api/orders', controllers.addOrder);

app.get('/api/orders', controllers.orders);

const porta = 3000;

app.listen(3000, function () {
    console.log(`Aplicação radando na porta ${porta}`);
});