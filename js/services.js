angular.module("FinalApp")
.factory('PostResource',function($resource){
	return $resource("http://jsonplaceholder.typicode.com/posts/:id",{id:"@id"}, {update: {method: "PUT"}});
}).factory('SessionService', function(localStorageService){
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
		/*
		toDoService.add = function(newActv) {
			toDoService.activities.push(newActv);
			toDoService.updaLocalStorage();
		}

		toDoService.updaLocalStorage = function() {
			localStorageService.set(toDoService.key, toDoService.activities);
		}	

		toDoService.clean = function() {
			toDoService.activities =[];
			toDoService.updaLocalStorage();
			return toDoService.getAll();
		}	

		toDoService.getAll = function() {
			return toDoService.activities;
		}

		toDoService.removeItem = function(item) {
			toDoService.activities = toDoService.activities.filter(function(activity){
				return activity !== item;
			});
			toDoService.updaLocalStorage();
			return toDoService.getAll();
		}*/


		return toDoService;
	})