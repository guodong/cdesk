var API = '/api/';
var sepcloud = angular.module("sepcloud", ['ngRoute'], function($interpolateProvider){
	$interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});
sepcloud.config(function($routeProvider) {
	$routeProvider.when('/dashboard', {
		controller: 'DashboardCtrl',
		templateUrl: 'tpl/dashboard.html',
		activetab: 'dashboard'
	}).when('/vm', {
		controller: 'VmCtrl',
		templateUrl: 'tpl/vms.html'
	}).when('/server', {
		controller: 'ServerCtrl',
		templateUrl: 'tpl/servers.html'
	}).when('/user', {
		controller: 'UserCtrl',
		templateUrl: 'tpl/users.html'
	}).otherwise({
		redirectTo: '/dashboard'
	});
}).controller('DashboardCtrl', function($scope, $route){
	$scope.activeTab = $route.current.activetab;
}).controller('UserCtrl', function(){
	
}).controller('VmCtrl', function($scope, $http){
	$http({
		url: API+'vm',
	}).success(function(d){
		$scope.vms = d;
	});
	$scope.save = function(){
		var data = $scope.vm;
		$http({
			method: 'POST',
			url: API+'vm',
			data: data
		}).success(function(d){
			$scope.vms.push(d);
			$('#compose-modal').modal('hide');
		});
	}
}).controller('ServerCtrl', function($scope, $http){
	$http({
		url: API+'server',
	}).success(function(d){
		$scope.servers = d;
	});
	$scope.save = function(){
		$http({
			method: 'POST',
			url: API+'server',
			data: $scope.server
		}).success(function(d){
			$scope.servers.push(d);
		});
	}
});
sepcloud.controller('MyCtrl', function($scope, $location) {
    $scope.isActive = function(route) {
        return route === $location.path();
    }
});