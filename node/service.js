module.exports = function () {
    var clients = require('restify-clients');
    var client = clients.createJsonClient({
        url: "https://olinda.bcb.gov.br"
    });

    var requisicoes = {}

    requisicoes.cotacaoDolar = function(res, callback){
        client.get('/emitir-seguros/v0/additional-info/benefits', callback);
    }
    return requisicoes;
}