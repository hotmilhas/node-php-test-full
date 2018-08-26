const express = require('express'),
    bodyParser = require('body-parser'),
    request = require('request-promise'),
    Order = require('./Order'),
    moment = require('moment'),
    app = express();

const urlAPI = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)';
const queryString = {
    '@dataCotacao' : "'07-20-2018'",
    '$top' : '100',
    '$format': 'json'
};
const dollarPrice = request.get({ url: urlAPI, qs: queryString, json: true });

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: true}));

app.get('/api/brl-usd', (req, res) => {
    dollarPrice.then((price) => {
        res.json({
            'brl' : 1,
            'usd' : price.value[0].cotacaoVenda.toFixed(2)
        });
    }, () => {
        res.json({});
    });
});

app.post('/api/orders', (req, res) => {
    dollarPrice.then((price) => {
        let items = req.body.items || [0];
        let total = items.reduce((a, b) => Number(a) + Number(b), 0);
        let totalSellPrice = price.value[0].cotacaoVenda * total;
        let order = {
            'created_at' : moment().format("YYYY-MM-DD HH:mm:ss"),
            'total_brl' : total.toFixed(2),
            'total_usd' : totalSellPrice.toFixed(2)
        };

        order = Order.save(order);
        res.json(order);
    }, () => {
        res.json({});
    });
});

app.get('/api/orders', (req, res) => {
    res.json(Order.getAll());
});

app.listen(3000, () => {
    console.log('Server load');
});