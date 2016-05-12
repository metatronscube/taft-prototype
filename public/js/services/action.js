(function() {
    'use strict';
    angular
        .module('myApp')
        .factory('action', action);

    function action($resource) {
        // ngResource call to our static data
        var Action = $resource('actions/feed');

        function getAction() {
            // $promise.then allows us to intercept the results
            // which we will use later
            return Action.query().$promise.then(function(results) {
                return results;
            }, function(error) { // Check for errors
                console.log(error);
            });
        }

        return {
            getAction: getAction,
        }
    }

})();
