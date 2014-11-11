CmsApp.controller('RouteCtrl', ['$scope',  '$location', function ($scope, $location) {

	$scope.location = $location;

	$scope.$watch('location.path()', function(path) {

	  $scope.isContent = path.indexOf('content') > -1;
	  $scope.isUser = path.indexOf('users') > -1;
	  $scope.isAdmin = path.indexOf('admin') > -1;
	});
}]);

CmsApp.controller('CorretoresCtrl', ['$scope', 'Corretor', function ($scope, Corretor) {

	$scope.loading = true;

	var loadCorretores = (function() {
		$scope.loading = true;
		var corretores = Corretor.query(function () {
			$scope.loading = false;
			console.log(corretores);
			$scope.corretores = corretores.data;
		});
	})();
/*	var entries = Corretor.query(function () {
		$scope.loading = true;
		console.log(entries);
	});

	var entry = Corretor.get({ id: 1 }, function () {
		console.log(entry);
	});*/
	//Corretor.save({descricao: 'HAMMERFALL - Any Means Necessary', href: 'http://www.youtube.com/watch?v=FjV8SHjHvHk'});


}]);