angular.module("FinalApp")
	.controller('MainController', function($scope, $resource, SessionService, $http, $location){
		if (SessionService.isSession()) {
			$location.path("/posts/new");
		}

		$scope.usuario = {};
		$scope.login = {};
		$scope.dentro = false;

		console.log(SessionService.isSession());
		$scope.registrar = function() {
			console.log($scope.usuario);
			$http.post(
					'../opuniversity/services/api.php/registrar',
	            JSON.stringify($scope.usuario),
	            {
	                'Content-Type': 'application/json'
	            })
	            .success(function (data) {
                        console.log(data);
                        SessionService.registrar(data);
                       	$location.path("/posts/new");
                    })
	        }
    	$scope.login = function() {
    		$http.post(
					'../opuniversity/services/api.php/login',
	            JSON.stringify($scope.loginUser),
	            {
	                'Content-Type': 'application/json'
	            })
	            .success(function (data) {
	            		if (data[0] == "ok") {
	                        console.log(data);
	                        SessionService.registrar(data);
	                       	$location.path("/dashboard");
                       	} else {

                       	}
                    })
	        }


	})
	.controller('PostController',  function($scope, $routeParams, $location){
		 $scope.logout = function (){
            console.log("Op");
        }
	})
	.controller('DashboardController',  function($scope, $location,SessionService){
		var datos = SessionService.getSession();
		$scope.perfil = datos[1];
		console.log($scope.perfil);
		//$scope.dentro = true;
		if (!SessionService.isSession()) {
			$location.path("/");
		}
		$scope.post = {};
		$scope.title = "Crear Post";
		$scope.savePost = function(){
			PostResource.save({data: $scope.post}, function(data){
				console.log(data);
				$location.path("/");
			});
		}

		$scope.close = function() {
			SessionService.cerrarSesion();
			$location.path("/");
		}

		$scope.darseBaja = function(idUsuario) {
			console.log(idUsuario);
		}
	})
	.controller('BajaController', function($scope,$http, $routeParams, $location, SessionService){
		console.log($routeParams.id);


		$http.get('../opuniversity/services/api.php/baja/' + $routeParams.id)
            .success(function (data) {
                    console.log(data);
                    SessionService.cerrarSesion();
                   	$location.path("/");
                })

	});
