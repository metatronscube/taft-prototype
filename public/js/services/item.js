(function() {
    'use strict';
    angular
        .module('myApp')
        .factory('item', item);

    function item($resource) {
        // ngResource call to our static data
        var Item = $resource('items/feed'
        /*
                 = $resource('items/:id', {}, {
         update: {
         method: 'PUT'
         }
         });
         */
        );

        function getItem() {
            // $promise.then allows us to intercept the results
            // which we will use later
            return Item.query().$promise.then(function(results) {
                return results;
            }, function(error) { // Check for errors
                console.log(error);
            });
        }

        return {
            getItem: getItem,
        }
    }

})();
