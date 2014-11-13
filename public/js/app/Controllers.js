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
	$scope.showErroUnique = false;

	var loadCorretores = (function() {
		$scope.loading = true;
		var corretores = Corretor.query(function () {
			$scope.loading = false;
			console.log(corretores);
			$scope.corretores = corretores.data;
		});
	})();

	$scope.areas = [
		{nome: 'DIRETORIA COMERCIAL'},
		{nome: 'EQUIPE OPERACIONAL SAÚDE / PME / EMPRESARIAL / ADESÃO / VIDA E PREVIDÊNCIA'},
		{nome: 'EQUIPE OPERACIONAL AUTO / R.E / TRANSPORTES'},
		{nome: 'EQUIPE COMERCIAL'},
		{nome: 'ADMINISTRATIVO'},
	];

	$scope.cargos = [
		{nome: 'Diretor Comercial'},
		{nome: 'Diretor Comercial'},
		{nome: 'Diretor de Unidade'},
		{nome: 'Diretor de Transportes / RE'},
		{nome: 'Saúde e Benefícios'},
		{nome: 'Atendimento Interno e Adesão'},
		{nome: 'Atendimento Interno'},
		{nome: 'Coordenadoria Vendas e Negócios'},
		{nome: 'Área Técnica / Operacional'},
		{nome: 'Comunicação e Marketing '},
		{nome: 'Assistência Jurídica'},
		{nome: 'Atendimento Interno'},
	];

	// 'telefone', 'celular', 'fax'
	$scope.tipos = [
		{nome: 'telefone'},
		{nome: 'celular'},
		{nome: 'fax'},
	];

	;$scope.filial = [
		{nome: 'Comercial Unidade'},
		{nome: 'Filial Centro'},
		{nome: 'Filial Leste'},
		{nome: 'Filial Santos'},
		{nome: 'Filial ABC'},
		{nome: 'Matriz'},
	];

	$scope.corretor = {};
	$scope.corretor.telefones = [];

	$scope.corretor.telefones[0] = {num: null, tipo: null};
	$scope.corretor.telefones[1] = {num: null, tipo: null};
	$scope.corretor.telefones[2] = {num: null, tipo: null};

	$scope.submit = function (isValid) {

		if (isValid) {
			Corretor.save( $scope.corretor );

			var data = Corretor.save($scope.corretor, function () {

				console.log(data);

			});
		}
		
	};
/*	var entries = Corretor.query(function () {
		$scope.loading = true;
		console.log(entries);
	});

	var entry = Corretor.get({ id: 1 }, function () {
		console.log(entry);
	});*/
	//Corretor.save({descricao: 'HAMMERFALL - Any Means Necessary', href: 'http://www.youtube.com/watch?v=FjV8SHjHvHk'});


}]);