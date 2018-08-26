var express = require('express'),
    bodyParser = require('body-parser'),
    app = express();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: true}));

app.get('/api/brl-usd', function(req, res) {
    res.send({
        'brl' : 1,
        'usd' : 4.4
    });
});

app.post('/api/orders', function(req, res) {
    res.send({
        "id": 1,
        "createdAt": "...",
        "totalBRL": 1650,
        "totalUSD": 435.84
    });
});

app.get('/api/orders', function(req, res) {
   res.send([
       {
           "id": 1,
           "createdAt": "...",
           "totalBRL": 1650,
           "totalUSD": 435.84
       },
       {
           "id": 2,
           "createdAt": "...",
           "totalBRL": 1650,
           "totalUSD": 435.84
       }
   ]);
});

app.listen(3000, function() {
    console.log('Server load');
});