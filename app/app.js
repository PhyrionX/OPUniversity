angular.module("FinalApp",["ngRoute","LocalStorageModule","angularFileUpload"])
	.config(function($routeProvider) {
		$routeProvider
		.when("/", {
			controller: "MainController",
			templateUrl: "templates/home.html"
		})
		.when("/post/:id", {
			controller: "PostController",
			templateUrl: "templates/post.html"
		})
		.when("/dashboard", {
			controller: "DashboardController",
			templateUrl: "templates/dashboard.html"
		})
		.when("/posts/edit/:id", {
			controller: "PostController",
			templateUrl: "templates/post_form.html"
		})
		.when("/baja/:id",{
			controller: "BajaController",
			templateUrl: "templates/baja.html"
		})
		.when("/modificarPerfil",{
			controller: "PerfilController",
			templateUrl: "templates/perfil.html"
		})
		.when("/apuntes",{
			controller: "ApuntesController",
			templateUrl: "templates/apuntes.html"
		})
		.when("/buscador",{
			controller: "BuscadorController",
			templateUrl: "templates/buscador.html"
		})
	})