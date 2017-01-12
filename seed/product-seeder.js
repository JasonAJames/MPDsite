var Product = require('../models/product');

var mongoose = require('mongoose'); 

mongoose.connect('localhost:27017/shopping');

var products = [
new Product({
	imagePath: '/public/images/busCard-preview.jpg',
	title: 'Standard Business Cards',
	description: '500 Qty. 14pt. full color front, blank back (glossy) business cards',
	price: 18.95
	}),
new Product({
	imagePath: '/public/images/busCard-preview.jpg',
	title: 'Standard Business Cards',
	description: '1000 Qty. 14pt. full color front, blank back (glossy) business cards',
	price: 36.95
	}),
new Product({
	imagePath: '/public/images/busCard-preview.jpg',
	title: 'Standard Business Cards',
	description: '1500 Qty. 14pt. full color front, blank back (glossy) business cards',
	price: 58.95
	}),
new Product({
	imagePath: '/public/images/busCard-preview.jpg',
	title: 'Standard Business Cards',
	description: '2000 Qty. 14pt. full color front, blank back (glossy) business cards',
	price: 70.95
	}),
new Product({
	imagePath: '/public/images/busCard-preview.jpg',
	title: 'Standard Business Cards',
	description: '2500 Qty. 14pt. full color front, blank back (glossy) business cards',
	price: 84.95
	}),
new Product({
	imagePath: '/public/images/busCard-preview.jpg',
	title: 'Standard Business Cards',
	description: '5000 Qty. 14pt. full color front, blank back (glossy) business cards',
	price: 154.95
	}),
new Product({
	imagePath: '/public/images/busCard-preview.jpg',
	title: 'Standard Business Cards',
	description: '10000 Qty. 14pt. full color front, blank back (glossy) business cards',
	price: 274.95
	})
];


var done = 0;
// Loop through products
for (var i = 0; i < products.length; i++) {
	products[i].save(function(err, result) {
		done++;
		if(done === products.length) {
			exit();
		}
	});
}

function exit() {
	mongoose.disconnect();
}



