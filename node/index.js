const express = require('express'),
      bodyParser = require('body-parser'),
      cache = require('memory-cache'),
      fetch = require('node-fetch'),
      app = express(),
      port = process.argv[2] || 3000,
      Orders = [];

if (!Array.prototype.sum) {
  Array.prototype.sum = function () {
    return this.reduce((a, b) => (parseFloat(a) + parseFloat(b)), 0)
  }
}

// const cacheMiddleware = (duration) => {
//   return (req, res, next) => {
//     let key = '__express__' + req.originalUrl || req.url
//     let cachedBody = cache.get(key)
//     if (cachedBody) {
//       res.send(cachedBody)
//       return
//     } else {
//       res.sendResponse = res.send
//       res.send = (body) => {
//         cache.put(key, body, duration * 1000, (key) => console.log(key+' expired'));
//         res.sendResponse(body)
//       }
//       next()
//     }
//   }
// }

const parseQuotation = (data) => {
  const value = data.value[0].cotacaoCompra,
    brl = 1,
    usd = brl/value
  return { brl, usd }
}

const fethQuotation = () => {
  const urlQuotation = "https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao='07-20-2018'&$top=100&$format=json",
  ttl = 14400 /* 4 horas */
  return new Promise((resolve, reject) => {
    let key = 'fethQuotation'
    let data = cache.get(key)
    if (data) {
      resolve(data)
    } else {
      fetch(urlQuotation)
        .then(result => result.json())
        .then(json => parseQuotation(json))
        .then(data => {
          cache.put(key, data, 1000*ttl)
          resolve(data)
        })
        .catch(e => reject(e))
    }
  })
}

const formatQuotation = (data) => {
  for (let prop in data) {
    data[prop] = parseFloat(data[prop].toFixed(2))
  }
  return data
}

const makeOrder = (items, quotation) => {
  const id = Orders.length+1,
        createdAt = new Date(),
        // dolarRatio = quotation.usd,
        dolarRatio = 0.264145454545455,
        totalBRL = items.sum(),
        totalUSD = parseFloat((totalBRL*dolarRatio).toFixed(2)),
        newOrder = { id, createdAt, totalBRL, totalUSD }
  Orders.push(newOrder)
  return newOrder;
}

app.use(bodyParser.urlencoded({ extended: false }));

app.get('/api/brl-usd', (req, res) => {
  fethQuotation()
    .then(quote => formatQuotation(quote))
    .then(quote => res.json(quote))
    .catch(e => res.json(e))
})

app.post('/api/orders', (req, res) => {
  fethQuotation()
    .then(quote => makeOrder(req.body['items[]'], quote))
    .then(order => res.json(order))
    .catch(e => res.json(e))
})

app.get('/api/orders', (req, res) => {
  res.json(Orders)
})

app.listen(port);

console.log('API restfull do teste prático rodando na porta: ' + port);