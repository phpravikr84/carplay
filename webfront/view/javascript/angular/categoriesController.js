frontendapp.controller("categoriesController", function($scope, $http) {
  $http.get("<?php echo site_url('angularjs/get_list'); ?>").
    success(function(data, status, headers, config) {
      $scope.posts = data;
    }).
    error(function(data, status, headers, config) {
      // log error
    });
});