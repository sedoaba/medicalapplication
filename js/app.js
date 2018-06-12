var myApp = angular.module('myApp', ['ngRoute']);

myApp.config(function ($routeProvider) {
	$routeProvider


		.when("/login", {
			controller: 'LoginController',
			templateUrl: "templates/loginwindow.html"
		});
		

});


myApp.factory('dataService', ['$http', '$log', function ($http, $log) {

	var userdata = [];
	return {

		getuser: function () {
			return user;
		},
		setuser: function (userdata) {
			user = userdata;
		}


	};
}]);

myApp.filter('startFrom', function () {
	return function (input, start) {
		start = +start; //parse to int
		return input.slice(start);
	}
});

myApp.filter('unique', function () {
	// we will return a function which will take in a collection
	// and a keyname
	return function (collection, keyname) {
		// we define our output and keys array;
		var output = [],
			keys = [];

		// we utilize angular's foreach function
		// this takes in our original collection and an iterator function
		angular.forEach(collection, function (item) {
			// we check to see whether our object exists
			var key = item[keyname];
			// if it's not already part of our keys array
			if (keys.indexOf(key) === -1) {
				// add it to our keys array
				keys.push(key);
				// push this item to our final output array
				output.push(item);
			}
		});
		// return our array which should be devoid of
		// any duplicates
		return output;
	};
});






