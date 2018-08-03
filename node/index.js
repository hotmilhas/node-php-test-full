const express    = require( 'express' )
const bodyParser = require( 'body-parser' )
const morgan     = require( 'morgan' )
const app        = express(  )

app.use( bodyParser.urlencoded( { extended : false } ) )
app.use( bodyParser.json(  ) )
app.use( morgan( 'dev' ) )

require( './src/index' )( app )

app.listen( 9000, (  ) => { 
	console.log( 'Express has been started' )
} )