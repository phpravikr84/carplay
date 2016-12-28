var frontendApp = angular.module("frontendApp", []);

frontendApp.controller("categoriesController", function($scope, $http) {
  $http.get('index.php?route=common/home_category/get_list').success(function($data){ $scope.posts=$data; });
});

frontendApp.controller("subcategoriesController", function($scope, $http) {
  $http.get('index.php?route=common/home_category/get_sublist').success(function($data){ $scope.subcat=$data; });
});

frontendApp.controller("servicesController", function($scope, $http){
$http.get('index.php?route=common/home_services/get_services').success(function($data){ $scope.services=$data; });
});


 

frontendApp.controller("getMerchantListController", function($scope, $http){

	$scope.item = {};

	$scope.getCategory =  function(){
		console.log($scope.item);
		//var categoryData = $scope.item.category.split('_');
		//console.log(categoryData[1]);
		//var url = '/index.php?route=product/category&&path=18_23&sort=m.rating&filter_atmoshhpier=&filter_spokenlanguage=&filter_facilities=';
	
		if($scope.item.category!="")
			{
	var url = 'index.php?route=product/category/getMerchantByCategory&&path='+$scope.item.category+'&sort=m.rating&filter_atmoshhpier=&filter_spokenlanguage=&filter_facilities=';
			
			$http.get(url).success(function($data){ 
			$scope.getRecords=$data;
			});

			}

	 


	}

});