const express = require( 'express' )
const router  = express.Router(  )


router.get( '/brl-usd', require( './brl_usd' ) )
router.post( '/orders', require( './order-add' ) )
router.get( '/orders', require( './order-list' ) )

module.exports = router