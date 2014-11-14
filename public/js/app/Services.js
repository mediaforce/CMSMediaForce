CmsApp.factory('Corretor', ['$resource', function ($resource) {
	return $resource('/api/corretores/:id', { id: '@_id'}, {
		update: {
			method: 'PUT',
            isArray: false,

		},
		get: {
            method:'GET',
        },
        delete: {
        	method: 'DELETE',
        },
        save: {
        	method: 'POST',
            isArray: false 
        },
        query: {
        	method: 'GET', 
        	isArray: false 
        }
	})
}])