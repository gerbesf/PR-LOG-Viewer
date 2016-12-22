
Application.controller('ApplicationController',['$scope','$filter','$http',function($scope,$filter,$http){

    $scope.server_list = 1;
    // items for search
    $scope.active_server = null;
    $scope.active_command = null;


    $scope.loadContents = function(){
        $scope.server_list = server_list;
        $scope.server_commands = server_commands;
    };

     // set server
     $scope.setServer = function(server){
        $scope.active_server = server;
     };

     // set command
     $scope.setCommand = function(command){
        $scope.active_command = command;
     };

     $scope.showLog = function(){

         $scope.loading = true;

         $http.get('get_log.php?server_id='+$scope.active_server+'&command='+$scope.active_command).success(function(data){
             console.log(data);
             $scope.results = data;
             $scope.loading = false;
         }).error(function(data,status){
             console.log('Error: '+status);
         });

     }
     
     $scope.download_button_css = 'btn-default';
     $scope.download_button = 'Update Log';
     $scope.downloadLog = function(){
         $scope.download_button = "Updating..";
        $scope.download_button_css = 'btn-warning';
         $http.get('download.php?server_id='+$scope.active_server).success(function(data){
            $scope.download_button = "Updated";
            $scope.download_button_css = 'btn-success';
         }).error(function(data,status){
            $scope.download_button = "Error";
            $scope.download_button_css = 'btn-danger';
             console.log('Error: '+status);
         });
     };

 }]);