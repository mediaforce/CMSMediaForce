var CmsApp = angular.module('CmsApp', ['ngResource', 'ngRoute']);

CmsApp.config(['$locationProvider', function ($locationProvider) {
	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});

}]);