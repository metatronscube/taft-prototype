(function() {
    'use strict';
    angular
        .module('itemContainer')
        .controller('ItemEntry', ItemEntry);

    function ItemEntry(item) {
        // vm is our capture variable
        var vm = this;

        vm.itementries = [];

        // Fetches the time entries from the static JSON file
        // and puts the results on the vm.timeentries array
        item.getItem().then(function(results) {
            vm.itementries = results;
            console.log(vm.itementries);
        }, function(error) { // Check for errors
            console.log(error);
        });
    }
})();
