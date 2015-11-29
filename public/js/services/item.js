/* js/services/item.js */

(function() {

    'use strict';

    angular
        .module('itemContainer')
        .factory('item', item);

    function item($resource) {

        // ngResource call to our static data
        var Item = $resource('items/feed');

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
