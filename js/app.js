angular.module("FinalApp",["lumx","ngRoute","LocalStorageModule"])
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
	})