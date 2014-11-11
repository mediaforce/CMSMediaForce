CmsApp.factory('Corretor', ['$resource', function ($resource) {
	return $resource('/api/corretores/:id', { id: '@_id'}, {
		update: {
			method: 'PUT'
		},
		get: {
            method:'GET'
        },
        delete: {
        	method: 'DELETE'
        },
        save: {
        	method: 'POST'
        },
        query: {
        	method: 'GET', 
        	isArray: false 
        }
	})
}])