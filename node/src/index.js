module.exports = ( app ) => {
	
	app.use( '/', require( './routes/main/' ) )
	app.use( '/api', require( './routes/api/' ) )
	
}