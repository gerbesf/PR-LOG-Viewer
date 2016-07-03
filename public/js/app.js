
var Application = angular.module('App', []);
/*

 Application.controller('ApplicationController',['$scope','$http','$filter','configValue','$kookies','md5',function($scope,$http,$filter,configValue,$kookies,md5){

 // check user is logged
 if($kookies.get('user_id')==undefined){
 location.replace('#/Login');
 }

 // app name
 $scope.app = configValue.app;
 $scope.server_list = configValue.server_list;   // servers list
 $scope.command_list = configValue.command_list; // commands list

 // items for search
 $scope.active_server = null;
 $scope.active_command = null;

 /* watch example
 $scope.$watch("active_server", function(newValue, oldValue) {
 console.log("Server has Change " + $scope.active_server);
 });
 * /

// set server
$scope.setServer = function(server){
    $scope.active_server = server;
};

// set command
$scope.setCommand = function(command){
    $scope.active_command = command;
};

$scope.showLog = function(){

    var server = $filter('filter')(configValue.server_list,{id: $scope.active_server}, true);
    $http.get(server[0].directory).success(function(data){
        console.log(data);
    });
    console.log(server[0].directory);

}

}])

*/