var express = require('express');
var router = express.Router();

var Cart = require('../models/cart');
var Product = require('../models/product');
var Order = require('../models/order');

/* GET storefront page. */
router.get('/store', function(req, res, next) {
    var successMsg = req.flash('success')[0];
    Product.find(function(err, docs){
  	    var productChunks = [];
  	    var chunkSize = 3;
  	    for (var i = 0; i < docs.length; i+= chunkSize) {
  		    productChunks.push(docs.slice(i, i + chunkSize));
  	    }
  	res.render('shop/store', { title: 'MyPrintingDeals.com', products: productChunks, successMsg: successMsg, noMessage: !successMsg });
    }); 
});

/* GET details page. */
router.get('/details', function(req, res, next) {
    var successMsg = req.flash('success')[0];
    var details = Product.find();
    Product.find(function(err, docs){
  	    var productChunks = [];

  	    var chunkSize = 1;
  	    for (var i = 0; i < docs.length; i+= chunkSize) {
  		    productChunks.push(docs.slice(i, i + chunkSize));
  	    }
  	res.render('shop/details', { title: 'MyPrintingDeals.com', products: productChunks, successMsg: successMsg, noMessage: !successMsg });
    }); 
});

/* GET home page. */
// router.get('/', function(req, res, next) {
//   Product.find(function(err, docs){
//   	var productChunks = [];
//   	var chunkSize = 3;
//   	for (var i = 0; i < docs.length; i+= chunkSize) {
//   		productChunks.push(docs.slice(i, i + chunkSize));
//   	}
//   	res.render('homepage', { title: 'MyPrintingDeals.com', products: productChunks });
//   }); 
// });

/* GET sitedown page. */
router.get('/', function(req, res, next) {
  Product.find(function(err, docs){
  	var productChunks = [];
  	var chunkSize = 3;
  	for (var i = 0; i < docs.length; i+= chunkSize) {
  		productChunks.push(docs.slice(i, i + chunkSize));
  	}
  	res.render('sitedown', { title: 'MyPrintingDeals.com', products: productChunks });
  }); 
});

/* GET Locations page. */
router.get('/locations', function(req, res, next) {
  Product.find(function(err, docs){
    var productChunks = [];
    var chunkSize = 3;
    for (var i = 0; i < docs.length; i+= chunkSize) {
      productChunks.push(docs.slice(i, i + chunkSize));
    }
    res.render('ourLocations', { title: 'MyPrintingDeals.com - Locations', products: productChunks });
  }); 
});

/* GET products page. */
router.get('/printproducts', function(req, res, next) {
  Product.find(function(err, docs){
    var productChunks = [];
    var chunkSize = 3;
    for (var i = 0; i < docs.length; i+= chunkSize) {
      productChunks.push(docs.slice(i, i + chunkSize));
    }
    res.render('products', { title: 'MyPrintingDeals.com - Products', products: productChunks });
  }); 
});

/* GET promotions page. */
router.get('/promo', function(req, res, next) {
  Product.find(function(err, docs){
    var productChunks = [];
    var chunkSize = 3;
    for (var i = 0; i < docs.length; i+= chunkSize) {
      productChunks.push(docs.slice(i, i + chunkSize));
    }
    res.render('promotion', { title: 'MyPrintingDeals.com - Promos', products: productChunks });
  }); 
});

/* GET quote page */
router.get('/customquote', function(req, res, next) {
  Product.find(function(err, docs){
  	var productChunks = [];
  	var chunkSize = 3;
  	for (var i = 0; i < docs.length; i+= chunkSize) {
  		productChunks.push(docs.slice(i, i + chunkSize));
  	}
  	res.render('customQuote', { title: 'MyPrintingDeals.com - Custom Quote', products: productChunks });
  }); 
});

/* GET store-redirect page */
router.get('/order-printing-products', function(req, res, next) {
    res.render('shop/store-redirect', { title: 'MyPrintingDeals.com - Products'});
  });

/* GET contact page */
router.get('/contact', function(req, res, next) {
  res.render('shop/contact', { title: 'MyPrintingDeals.com - Contact'});
});

/* GET template download page */
router.get('/templatedownload', function(req, res, next) {
  res.render('shop/templatedownload', { title: 'MyPrintingDeals.com - Template Download'});
});

/* GET search results page */
router.get('/search?', function(req, res, next) {
    Product.find(function(err, docs) {
        var searchResults = [];
        var chunkSize = 1;
        for (var i = 0; i < docs.length; i += chunkSize) {
            searchResults.push(docs.slice(i, i + chunkSize))
        }
        res.render('shop/searchresults', { title: 'MyPrintingDeals.com - Search Results', searchresults: searchResults});
    });
});


/* Add-to-Cart route */
router.get('/add-to-cart/:id', function(req, res, next) {
	var productId = req.params.id;
	var cart = new Cart(req.session.cart ? req.session.cart : {});

	Product.findById(productId, function(err, product) {
		if(err) {
			return res.redirect('/');
		}
		cart.add(product, product.id);
		req.session.cart = cart;
		console.log(req.session.cart);
		res.redirect('/store');
	});
});

router.get('/reduce/:id', function(req, res, next) {
    var productId = req.params.id;
	var cart = new Cart(req.session.cart ? req.session.cart : {});
	
	cart.reduceByOne(productId);
	req.session.cart = cart;
	res.redirect('/shopping-cart');
});

router.get('/remove/:id', function(req, res, next) {
    var productId = req.params.id;
	var cart = new Cart(req.session.cart ? req.session.cart : {});
	
	cart.removeItem(productId);
	req.session.cart = cart;
	res.redirect('/shopping-cart');
});

/* PayPal Cart Update */
router.get('/paypal-reduce/:id', function(req, res, next) {
    var productId = req.params.id;
	var cart = new Cart(req.session.cart ? req.session.cart : {});
	
	cart.reduceByOne(productId);
	req.session.cart = cart;
	res.redirect('/paypal-checkout');
});

router.get('/paypal-remove/:id', function(req, res, next) {
    var productId = req.params.id;
	var cart = new Cart(req.session.cart ? req.session.cart : {});
	
	cart.removeItem(productId);
	req.session.cart = cart;
	res.redirect('/paypal-checkout');
});

/* Shopping Cart route */
router.get('/shopping-cart', function(req, res, next) {
    if(!req.session.cart) {
    	return res.render('shop/shopping-cart', {products: null});
    }
    var cart = new Cart(req.session.cart);
    res.render('shop/shopping-cart', {products: cart.generateArray(), totalPrice: cart.totalPrice.toFixed(2)});
});

router.get('/checkout', isLoggedIn, function(req, res, next) {
    if(!req.session.cart) {
   		return res.redirect('/shopping-cart');
    }
    var cart = new Cart(req.session.cart);
    var errMsg = req.flash('error')[0];
    res.render('shop/checkout', {totalPrice: cart.totalPrice.toFixed(2), errMsg: errMsg, noError: !errMsg});
});

router.post('/checkout', isLoggedIn, function(req, res, next) {
    if(!req.session.cart) {
   		return res.redirect('/shopping-cart');
    }
    
    var cart = new Cart(req.session.cart);
    
    var stripe = require("stripe")("sk_test_3IO8VpgXkonc4BJAheE2GwBf");
    
    var token = req.body.stripeToken;
    // var token = res.id;
    
    stripe.charges.create({
        amount: cart.totalPrice * 100, // Price needs to be in cents (by default), converting price from dollars to cents
        currency: "usd",
        source: token, // req.body.stripeToken,  obtained with Stripe.js
        description: "Charge for Printing Services",
        metadata: {'address': req.body.address,
        'email': req.user
        }
        }, function(err, charge) {
            if (err) {
                req.flash('error', err.message);
                return res.redirect('/checkout');
            }
            var order = new Order({
                user: req.user,
                email: req.user,
                cart: cart,
                address: req.body.address,
                name: req.body.name,
                paymentId: charge.id
            });
            order.save(function(err, result) {
                // if (err) {
                //     req.flash('error', err.message);
                //     return res.redirect('/checkout');
                // }
                req.flash('success', 'Payment Successful!');
                req.session.cart = null;
                res.redirect('/billing-section');
            });

    });
});

/* PayPal Checkout route */
router.get('/paypal-checkout', isLoggedIn, function(req, res, next) {
    if(!req.session.cart) {
   		return res.redirect('/shopping-cart');
    }
    var cart = new Cart(req.session.cart);
    var errMsg = req.flash('error')[0];
    res.render('shop/paypal-checkout', {total: cart.totalPrice, errMsg: errMsg, noError: !errMsg});
});

// router.post('/paypal-checkout', isLoggedIn, function(req, res, next) {
// if(!req.session.cart) {
//   		return res.redirect('/shopping-cart');
//     }
    
//     var cart = new Cart(req.session.cart);
    
//     function(err, charge) {
//                 if (err) {
//                     req.flash('error', err.message);
//                     return res.redirect('/checkout');
//                 }
//                 var order = new Order({
//                     user: req.user,
//                     email: req.user,
//                     cart: cart,
//                     address: req.body.address,
//                     name: req.body.name,
//                     paymentId: charge.id
//                 });
//                 order.save(function(err, result) {
//                     // if (err) {
//                     //     req.flash('error', err.message);
//                     //     return res.redirect('/checkout');
//                     // }
//                     req.flash('success', 'PayPal Payment Successful!');
//                     req.session.cart = null;
//                     res.redirect('/billing-section');
//                 });
    
//         });
            
// });

module.exports = router;

function isLoggedIn(req, res, next) {
	if(req.isAuthenticated()) {
		return next();
	}
	req.session.OldUrl = req.url;
	res.redirect('/user/signin');
}