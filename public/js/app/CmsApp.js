var CmsApp = angular.module('CmsApp', ['ngResource']);

CmsApp.config(['$locationProvider', function ($locationProvider) {
	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});

}]);