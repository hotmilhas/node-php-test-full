var clients = require('restify-clients');
var cache = require('memory-cache');
var client = clients.createJsonClient({
    url: "https://olinda.bcb.gov.br"
});


module.exports = {
    hello: (req, res) => {
        res.send('Test Hot Milhas');
    },

    cotar: (req, res) => {
        let cotacao = cache.get('cotacao');
        if (cotacao) {
            res.send(cotacao);
        } else {
            client.get(`/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao='07-20-2018'&$top=100&$format=json`, (error, reqx, resx, retornox) => {
                cache.put('cotacao', retornox, 14400000);
                res.send(retornox);
            });
        }
    },

    addOrder: (req, res) => {
        let items = req.body.items;
        let total = 0.0;

        items.forEach(item => {
            total += item;
        })

        let orders = cache.get('orders');
        let id = 1;
        if (orders) {
            id = orders[orders.length - 1].id + 1;
        } else {
            orders = [];
        }

        item = {
            id: id,
            createdAt: '30/07/2018',
            totalBRL: total,
            totalUSD: total * 3.73
        }

        orders.push(item);
        cache.put('orders', orders);
        res.send(item);
    },

    orders: (req, res) => {
        let orders = cache.get('orders');
        res.send(orders ? orders : []);
    }
}
