var mongoose = require('mongoose');
var Schema = mongoose.Schema;

var schema = new Schema({
	item: {type: String, required: true},
	name: {type: String, index: { unique: true }, required: true},
	title: {type: String, index: { unique: true }, required: true},
	type: {type:String, index: true}, // Standard or Sinature (14pt. or 16pt.)
	option_finish: {type: String, index: true}, // Glossy or Matte
	option_size: {type: String, index: true}, 
	option_color: {type: String, index: true}, // Full Color Front, Blank Back; Full Color Front, Black Back, Full Color Both Sides
	option_coating: {type: String}, // UV front and AQ Back or UV Both Sides
});

module.exports = mongoose.model('SearchResults', schema);