myApp.controller('LoginController', function ($scope, $http, $window, $interval, $location, $filter, dataService) {

	$scope.login = function () {


		if ($scope.username == "" || $scope.username == undefined) {
			alert("Please enter Username");
			return;
		}

		try {


			$http({
				method: 'POST',
				url: "handler/login.php?username=" + $scope.username + "&password=" + $scope.password
			})

				.then(
					function successCallback(response) {

						if (response.data.userinfo == "nouserfound") {

							alert("Username and password don't match");
							return;

						}
						else {
							$scope.userdata = response.data.userinfo;
							dataService.setuser($scope.userdata);
							$location.path('menu');

						}

					},
					function errorCallback(response) {

						alert("" + response);
						return;
					}

				);
		}
		catch (error) {
			alert("" + error);

		}
	}


}); //end controller