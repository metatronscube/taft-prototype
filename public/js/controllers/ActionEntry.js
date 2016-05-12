(function() {
    'use strict';
    angular
        .module('myApp')
        .controller('ActionEntry', ActionEntry);

    function ActionEntry(action) {
        // vm is our capture variable
        var vm = this;

        vm.actionentries = [];

        // Fetches the time entries from the static JSON file
        // and puts the results on the vm.timeentries array
        action.getAction().then(function(results) {
            vm.actionentries = results;
            console.log(vm.actionentries);
        }, function(error) { // Check for errors
            console.log(error);
        });
    }
})();
