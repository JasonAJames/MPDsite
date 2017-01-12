function bestfunctionever(el, direction) {
	// do something intersting
	if (true) {
		// Do this
	} else {
		//Do that
	}
}

$(function() {
	$('.portfolio-item').on('click', function(){
		var item_num = $(this).attr('data-portfolio-item');
		$('.portfolio-item-' + item_num).fadeIn();
	});
});

$(document).ready(function() {
	$('.image-swap').attr("src", $('#kitchen_color').val());
})

function change_image(){
	$('.image-swap').attr("src", $('kitchen_color').val());
}

function setImage(select){
	var image = document.getElementByName("image-swap")[0];
	image.src = select.options[select.selectedIndex].value;
}

$(document).ready(function() {
	if($("#commonly-asked-questions").css({"display": "none"})){
		    $("#common-questions-link").click(function(){
    	$("#commonly-asked-questions").css({"display": "block"});
    })
	} 
})

// AngularJS 

var app1 = angular.module('app1', []);

// Factory Function
app1.controller('ctrl1', function($scope) {
	$scope.first = 1;
	$scope.second = 1;
	
	$scope.updateValue = function() {
		$scope.calculation = $scope.first + ' + ' + $scope.second + " = " + (+$scope.first + +$scope.second);
	};
});

<!-- AngularJS Project Name input for PayPal Checkout -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
	<script>
	var customInterpolationApp = angular.module('MyApp', [])
  .controller("MyController", function($scope) {
  $scope.fontSize = "1em";
  $scope.bold = function() {
    $scope.myStyle = "bold";
  }
  
  $scope.underline = function() {
  	$scope.myStyle = "underline";
  }
  
  $scope.normal = function() {
    $scope.myStyle = "normal";
  }
  $scope.myStyle = "normal";  
}).config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('{[{');
    $interpolateProvider.endSymbol('}]}');
  });
</script>