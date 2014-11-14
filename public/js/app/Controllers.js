CmsApp.controller('RouteCtrl', ['$scope',  '$location', function ($scope, $location) {

	$scope.location = $location;

	$scope.$watch('location.path()', function(path) {

	  $scope.isContent = path.indexOf('content') > -1;
	  $scope.isUser = path.indexOf('users') > -1;
	  $scope.isAdmin = path.indexOf('admin') > -1;
	});
}]);

CmsApp.controller('CorretoresCtrl', ['$scope', 'Corretor', '$location', function ($scope, Corretor, $location) {
	$scope.corretores = [];

	$scope.showErroUnique = false;

	$scope.cadastronovo = {};

	$scope.setNova = true;

	$scope.corretor = {};
	$scope.corretor.telefones = [];

	$scope.corretor.telefones[0] = {num: null, tipo: null};
	$scope.corretor.telefones[1] = {num: null, tipo: null};
	$scope.corretor.telefones[2] = {num: null, tipo: null};

	$scope.enderecoFoto = '/img/corretores/sem-foto.png';

	var passFirstVC = false, passFirstVA = false;

	var resetCorretor = function () {
		$scope.showErroUnique = false;
		$scope.enviandoForm = false;

		$scope.corretor = {};
		$scope.corretor.telefones = [];

		$scope.corretor.telefones[0] = {num: null, tipo: null};
		$scope.corretor.telefones[1] = {num: null, tipo: null};
		$scope.corretor.telefones[2] = {num: null, tipo: null};

		passFirstVC = false, passFirstVA = false;
	}

	var resetForm = function() {
        $scope.myForm.$setPristine();
        resetCorretor();
    };

	/* Variaveis */
	$scope.loading = true;

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

	$scope.filial = [
		{nome: 'Comercial Unidade'},
		{nome: 'Filial Centro'},
		{nome: 'Filial Leste'},
		{nome: 'Filial Santos'},
		{nome: 'Filial ABC'},
		{nome: 'Matriz'},
	];

	/* Funcoes */

	var arrayObjectIndexOf = function(myArray, searchTerm, property) {
	    for(var i = 0, len = myArray.length; i < len; i++) {
	        if (myArray[i][property] === searchTerm) return i;
	    }
	    return -1;
	}

	var loadCorretores = (function() {
		$scope.loading = true;
		var corretores = Corretor.query(function () {
			$scope.loading = false;

			for ( key in corretores.data ) {
				$scope.corretores.push( corretores.data[key] );
			}
		});
	})();

	$scope.teste = function () {
		console.log($scope.corretores);

		console.log( arrayObjectIndexOf( $scope.corretores, 2, 'id') );
	}

	var validateCargo = function (scope) {

		if (passFirstVC) {
			if ( $scope.cargos.indexOf(scope) > -1 ) {
				$scope.myForm.cargo.$setValidity('required', true);
			} else {
				$scope.myForm.cargo.$setValidity('required', false);
			}
		}

		passFirstVC = true;
	};

	var validateArea = function (scope) {
		
		if (passFirstVA) {
			if ( $scope.areas.indexOf(scope) > -1 ) {
				$scope.myForm.area.$setValidity('required', true);
			} else {
				$scope.myForm.area.$setValidity('required', false);
			}
			
		}

		passFirstVA = true;
	}

	$scope.$watch('corretor.area', function (scope) {
		validateArea(scope);
	});

	$scope.$watch('corretor.cargo', function (scope) {
		validateCargo(scope);
	});

	$scope.$watch('corretor.foto', function (scope) {
		if ( scope.length !== 0 ) {
			$scope.setNova = false;
		}
	})

	$scope.$watch('showErroUnique', function (scope) {
		if (scope) {
			$scope.myForm.email.$setValidity('unique', true);
		} else {
			$scope.myForm.email.$setValidity('unique', false);
		}
	});

	$scope.createForm = function (isValid) {

		validateArea($scope.corretor.area);
		validateCargo($scope.corretor.cargo);

		if (isValid) {
			$(".btn-enviar-form" ).attr("disabled", 'disabled');
			$(".btn-enviar-form" ).text('Enviando Dados...Aguarde!');


			var data = Corretor.save($scope.corretor,
				// 200
				function () {

					console.log(data);

					if (data.data.success) {

						$scope.cadastronovo = data.data.corretor;
						$("#corretorCadastrado").show().delay(5000).fadeOut();
					}

					resetForm();
					$(".btn-enviar-form" ).removeAttr("disabled");
					$(".btn-enviar-form" ).text('Cadastrar');

				}, 
				// erro
				function () {

					console.log('ERRO ', data);
				});
		}
		
	};

	$scope.saveForm = function (isValid) {

		validateArea($scope.corretor.area);
		validateCargo($scope.corretor.cargo);

		if (isValid) {
			$(".btn-enviar-form" ).attr("disabled", 'disabled');
			$(".btn-enviar-form" ).text('Enviando Dados...Aguarde!');


			var data = Corretor.update({id: $scope.corretor.id} , $scope.corretor,
				// 200
				function () {

					console.log(data);

					if (data.data.success) {
						$scope.cadastronovo = data.data.corretor;
						$("#corretorCadastrado").show().delay(5000).fadeOut();
					}

					resetForm();
					$(".btn-enviar-form" ).removeAttr("disabled");
					$(".btn-enviar-form" ).text('Cadastrar');

				}, 
				// erro
				function () {

					console.log('ERRO ', data);
				});
		}
		
	};

	$scope.$watch('location.path()', function(path) {
		var splittedPath = path.split("/");
		var indexAction;

		if (path.indexOf('delete') > -1) {
			indexAction = splittedPath.lastIndexOf('delete');
			if ( indexAction > -1 ) {
				if ( splittedPath[indexAction + 1] !== undefined ) {
					console.log('ID ' + splittedPath[indexAction + 1]);


				}				
			}
		}

		if (path.indexOf('edit') > -1) {
			indexAction = splittedPath.lastIndexOf('edit');
			if ( indexAction > -1 ) {
				if ( splittedPath[indexAction + 1] !== undefined ) {
					 var idC = splittedPath[indexAction + 1];

					$.blockUI({ 
			            message: '<h3>Aguarde um momento, estou buscando o colaborador.</h3>',
			            css: { width: '300px' } 
			        }); 

					var data = Corretor.get( {id: splittedPath[indexAction + 1] }, 
						// 200
						function () {
							var dataC = data.data;

							console.log('200 ', data);

							setTimeout($.unblockUI, 1);

							$scope.corretor.id =  dataC.id;
							$scope.corretor.nome = dataC.nome;

							$scope.enderecoFoto = dataC.foto;

							if (dataC.foto == null) {
								$scope.enderecoFoto = '/img/corretores/sem-foto.png';
							} else {
								$scope.enderecoFoto = dataC.foto;
							}

							var idxArea = arrayObjectIndexOf( $scope.areas, dataC.area, 'nome' );
							$scope.corretor.area = $scope.areas[idxArea];

							var idxCargo = arrayObjectIndexOf( $scope.cargos, dataC.cargo, 'nome' );
							$scope.corretor.cargo = $scope.cargos[idxCargo];

							$scope.corretor.email = dataC.email;

							for (var i = 0; i < dataC.telefones.length; i += 1) {
								$scope.corretor.telefones[i] = dataC.telefones[i];
							}

							$('html,body').animate({scrollTop: 0}, 400);

						}, 
						// erro
						function () {

							console.log('ERRO ', data);
							setTimeout($.unblockUI, 1000);

						});

				}				
			}
		}

	});
/*	var entries = Corretor.query(function () {
		$scope.loading = true;
		console.log(entries);
	});

	var entry = Corretor.get({ id: 1 }, function () {
		console.log(entry);
	});*/
	//Corretor.save({descricao: 'HAMMERFALL - Any Means Necessary', href: 'http://www.youtube.com/watch?v=FjV8SHjHvHk'});


}]);