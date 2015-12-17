angular.module("FinalApp")
.factory('SessionService', function(localStorageService){
		var toDoService = {};
		toDoService.key = "auth";
		if (localStorageService.get(toDoService.key)) {
			toDoService.registro = localStorageService.get(toDoService.key);
		} else {
			toDoService.registro = [];
		}
		toDoService.isSession = function() {
			if (localStorageService.get(toDoService.key)) {
				return true;
			} else {
				return false;
			}
		}

		toDoService.registrar = function(newReg) {
			toDoService.registro = newReg;
			toDoService.updaLocalStorage();
		}

		toDoService.updaLocalStorage = function() {
			localStorageService.set(toDoService.key, toDoService.registro);
		}	

		toDoService.getSession = function() {
			return toDoService.registro;
		}

		toDoService.cerrarSesion = function() {
			toDoService.registro =[];
			toDoService.updaLocalStorage();
			localStorageService.remove(toDoService.key);
		}


		return toDoService;
	})
	.service('fileUpload', ['$http', function ($http) {
	    this.uploadFileToUrl = function(file, uploadUrl){
	        var fd = new FormData();
	        fd.append('file', file);
	        $http.post(uploadUrl, fd, {
	            transformRequest: angular.identity,
	            headers: {'Content-Type': undefined}
	        })
	        .success(function(){
	        })
	        .error(function(){
	        });
	    }
	}]);