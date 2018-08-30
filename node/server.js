# server.js
var express = require("express");
var app = express();

app.get("/", function(req, res){
   res.send("Hello World! \n")
});

app.listen(3000);
console.log("Application is running in http://localhost:3000");
