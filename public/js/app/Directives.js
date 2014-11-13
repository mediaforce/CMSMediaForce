CmsApp.directive('appFilereader', function(
    $q
){
    var slice = Array.prototype.slice;

    return {
        restrict: 'A'
        , require: '?ngModel'
        , link: function(scope, element, attrs, ngModel){
            if(!ngModel) return;

            ngModel.$render = function(){}

            element.bind('change', function(e){
                var element = e.target;

                $q.all(slice.call(element.files, 0).map(readFile))
                .then(function(values){
                    if(element.multiple) ngModel.$setViewValue(values);
                    else ngModel.$setViewValue(values.length ? values[0] : null);
                });

                function readFile(file) {
                    var deferred = $q.defer();

                    var reader = new FileReader()
                    reader.onload = function(e){
                        deferred.resolve(e.target.result);
                    }
                    reader.onerror = function(e) {
                        deferred.reject(e);
                    }
                    reader.readAsDataURL(file);

                    return deferred.promise;
                }

            });//change

        }//link

    };//return

})//appFilereader
;

CmsApp.directive('ensureUnique', ['$http', '$parse', function($http, $parse) {
  return {
    require: 'ngModel',
    link: function(scope, ele, attrs, c) {
      scope.$watch(attrs.ngModel, function() {
        scope.showErroUnique = false;
        $http({
          method: 'POST',
          url: '/api/checkemail',
          data: {'id': scope.corretor.id, 'email': scope.corretor.email}
        }).success(function(data, status, headers, cfg) {
            console.log(data)
          c.$setValidity('unique', data.isUnique);
          scope.showErroUnique = true;
        }).error(function(data, status, headers, cfg) {
            console.log(data)
          c.$setValidity('unique', false);
        });
      });
    }
  };
}]);