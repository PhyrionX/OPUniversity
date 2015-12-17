angular.module("FinalApp")
	.controller('MainController', function($scope, SessionService, $http, $location){
		if (SessionService.isSession()) {
			$location.path("/dashboard");
		}

		$scope.usuario = {};
		$scope.login = {};
		$scope.dentro = false;
		$scope.error = {};

		//console.log(SessionService.isSession());
		$scope.registrar = function() {
			console.log($scope.usuario);
			if ($scope.usuario.pass == $scope.usuario.repass) {
			$http.post(
					'../opuniversity/services/api.php/registrar',
	            JSON.stringify($scope.usuario),
	            {
	                'Content-Type': 'application/json'
	            })
	            .success(function (data) {
	            	if (data[0] == "ok") {
                        console.log(data);
                        SessionService.registrar(data);
                       	$location.path("/dashboard");
                    } else {
                    	switch (data[1]) {
                    		case "uexiste": $scope.error.uexiste = true;
                    						$scope.error.correo = true;
                    						break;
                    		case "evalido": $scope.error.evalido = true;
                    						$scope.error.correo = true;
                    						break;
                    	}
                    }
                })
	        } else {
	        	$scope.error.samePass = true;
	        }
        }
    	$scope.login = function() {
    		//$scope.error = true;
    		
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
                   		$scope.error.login = true;
                   	}
                })
                .error(function(err) {
					$scope.error.login = true;
				});
	        }


	})
	.controller('DashboardController',  function($scope, $location,SessionService, $http){
		var datos = SessionService.getSession();
		$scope.datosLogin = datos[1];
		$scope.datosUsuario = datos[2];
		$scope.idMD5 = datos[3];

		/*$scope.uploadFile = function(id){
	        var file = $scope.myFile;
	        console.log('file is ' + JSON.stringify(file));
	        var uploadUrl = '../opuniversity/services/api.php/subirImagen/' + $scope.datosLogin.idUsuario;
	        fileUpload.uploadFileToUrl(file, uploadUrl);
	    };*/

		
		/*$http.get(
					'../opuniversity/services/api.php/getInfoUser/' + 1,
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
                    })*/
	        

	})
	.controller('BajaController', function($scope,$http, $routeParams, $location, SessionService){
		console.log($routeParams.id);


		$http.get('../opuniversity/services/api.php/baja/' + $routeParams.id)
            .success(function (data) {
                    console.log(data);
                    SessionService.cerrarSesion();
                   	$location.path("/");
                })

	})
	.controller('ApuntesController', function($scope,$http, $routeParams, $location, SessionService, fileUpload){
		var datos = SessionService.getSession();
		$scope.datosLogin = datos[1];
		$scope.datosUsuario = datos[2];
		$scope.idMD5 = datos[3];
		$scope.apunte = {};
		$scope.listaApuntes = {};
		var id = 0;
		$http.get('../opuniversity/services/api.php/getApuntesUser/' + datos[1].idUsuario)
		.success(function(data){
			$scope.listaApuntes = data;
		});

		$scope.subirDocumento = function(){
			$http.post(
					'../opuniversity/services/api.php/crearApunte/' + datos[1].idUsuario,
	            JSON.stringify($scope.apunte),
	            {
	                'Content-Type': 'application/json'
	            }).success(function (data){
	            	if (data[0] == "ok") {
						id = data[1];
						var file = $scope.myFile;
				        console.log('file is ' + JSON.stringify(file));
				        var uploadUrl = '../opuniversity/services/api.php/subirPDF/' + $scope.datosLogin.idUsuario + '/' + id;
				        fileUpload.uploadFileToUrl(file, uploadUrl);
				        document.location.reload(true);
	            	} else {

	            	}
	            	
	            })
		}

		$scope.borrar = function(id) {
			var datosB = {};
			datosB.idUser = datos[1].idUsuario;
			datosB.idApunte = id;
			$http.post(
					'../opuniversity/services/api.php/borrarApunte',
	            JSON.stringify(datosB),
	            {
	                'Content-Type': 'application/json'
	            }).success(function (data){
	            	if (data[0] == "ok") {
	            		document.location.reload(true);
	            	} else {

	            	}
	            	
	            })
		}

		$scope.modificarDocumento = function(documentos) {
			$http.post(
					'../opuniversity/services/api.php/modificarApunte',
	            JSON.stringify(documentos),
	            {
	                'Content-Type': 'application/json'
	            }).success(function (data){
	            	if (data[0] == "ok") {
	            		document.location.reload(true);
	            	} else {

	            	}
	            	
	            })
		}
	})
	.controller('PerfilController', function($scope,$http, $routeParams, $location, SessionService, fileUpload){
		//console.log($routeParams.id);
		var datos = SessionService.getSession();
		console.log(datos);
		$scope.datosLogin = datos[1];
		$scope.datosUsuario = datos[2];

		$scope.modificarInfo = function() {
			

			console.log($scope.datosUsuario);
			$http.post(
					'../opuniversity/services/api.php/modificarInformacion',
	            JSON.stringify($scope.datosUsuario),
	            {
	                'Content-Type': 'application/json'
	            })
	            .success(function (data) {
	            		if (data == "nok") {

	            		} else {
	            			datos[2] = data[1];
	            			SessionService.registrar(datos);
	            			$location.path("/dashboard");
	            		}
                        //console.log(data);
                        //SessionService.registrar(data);
                       	//$location.path("/posts/new");
                    })

            var file = $scope.myFile;
	        console.log('file is ' + JSON.stringify(file));
	        var uploadUrl = '../opuniversity/services/api.php/subirImagen/' + $scope.datosLogin.idUsuario;
	        fileUpload.uploadFileToUrl(file, uploadUrl);
		}


	}).controller('BuscadorController', function($scope,$http, $routeParams, $location, SessionService, fileUpload){
		//console.log($routeParams.id);
		var datos = SessionService.getSession();
		$scope.datosLogin = datos[1];
		$scope.datosUsuario = datos[2];
		$scope.busqueda = {};
		$scope.resultadosUsuarios = {};
		$scope.resultadosUniversidades = {};
		$scope.resultadosCarreras = {};
		$scope.resultadosApuntes = {};

		$scope.buscar = function(){
			//console.log($scope.busqueda);
			if ($scope.busqueda.nombre != null) { 
			$http.post(
					'../opuniversity/services/api.php/busqueda',
	            JSON.stringify($scope.busqueda),
	            {
	                'Content-Type': 'application/json'
	            }).success(function (data) {
	            	if (data[0] == "ok") {
	            		$scope.resultadosUniversidades = data[1];
	            		$scope.resultadosUsuarios = data[2];
	            		$scope.resultadosCarreras = data[3];
	            		$scope.resultadosApuntes = data[4];
	            	} else {
	            		
	            	};
	            	
	            })
	        }
		}

	})
	.controller('NavbarController', function($scope,$http, $routeParams, $location, SessionService){
		$scope.datosGuay = true;
		var datos = SessionService.getSession();
		$scope.perfil = datos[1];
		$scope.infoUser = datos[2];
		console.log($scope.perfil);

		if (!SessionService.isSession()) {
			$location.path("/");
		}

		$scope.close = function() {
			SessionService.cerrarSesion();
			$location.path("/");
		}
	});
