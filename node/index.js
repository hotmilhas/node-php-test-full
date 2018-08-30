var express = require("express");
var app = express();

app.get("/", function(req, res){
 //  res.send("Hello World! \n")

 const request = require('request');
 const http = require('http');

var headersOpt = {  
    "content-type": "application/json",
};
var url = "https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao='07-20-2018'&$top=100&$format=json";

request(url,function(error, response, result){
        if(!error){
        var p = JSON.parse(result)
          res.send(p.value[0]);
        }
    });

});

app.listen(3000);
console.log("Application is running in http://localhost:3000");
