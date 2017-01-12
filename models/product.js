var mongoose = require('mongoose');
var Schema = mongoose.Schema;

var schema = new Schema({
	item: {type: String, required: true},
	imagePath: {type: String, required: true},
	name: {type: String, index: { unique: true }, required: true},
	price: {type: Number, required: true},
	qty: {type: Number, required: true},
		title: {type: String, index: { unique: true }, required: true},
		description: {type: String, required: true},
		full_description: {type: String, required: true},
		// Product Options Below
		type: {type:String, index: true}, // Standard or Sinature (14pt. or 16pt.)
		type_price_increase: {type: Number}, // $14.00 Increase for Signature 16pt.
		option_proof: {type:String},
		option_proof_price_increase: {type:Number},	// $8.00 PDF and $15.00 Hard Copy Proof
		option_finish: {type: String, index: true}, // Glossy or Matte
		option_finish_price_increase: {type: Number}, // $4.00 Increase for Matte
		option_size: {type: String, index: true}, 
		option_color: {type: String, index: true}, // Full Color Front, Blank Back; Full Color Front, Black Back, Full Color Both Sides
		option_color_price_increase: {type: Number}, // $10.00 Increase - Black Back and $15.00 Increase - Full Color
		option_coating: {type: String}, // UV front and AQ Back or UV Both Sides
		option_coating_price_increase: {type: String} // UV front and AQ Back $5.00 Increase; UV Both Sides $8.00 Increase
});

module.exports = mongoose.model('Product', schema);