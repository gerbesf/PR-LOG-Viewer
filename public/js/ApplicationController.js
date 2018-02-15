
Application.controller('ApplicationController',['$scope','$filter','$http',function($scope,$filter,$http){

    $scope.server_list = 1;
    // items for search
    $scope.active_server = null;
    $scope.active_command = null;
    $scope.results_hash = [];
    $scope.group_by = 'nick';
    $scope.tab = 'default';
    $scope.filter_list = '';
    $scope.search = '';
    $scope.search_fall = '';
    $scope.hide_duplica = '';

    $scope.selected_server = [];

    $scope.toogleServer = function( server_id ) {

        var exists = _.contains($scope.selected_server, server_id);

        if( exists == true ){
            $scope.selected_server = _.without($scope.selected_server, server_id);
        }else{
            $scope.selected_server.push(server_id);
        }

        console.log(exists);

    }

    $scope.inArray = function(server_id) {
        return _.contains($scope.selected_server, server_id);
    }

    // Load content from html
    $scope.loadContents = function(){
        $scope.server_list = server_list;
        $scope.server_commands = server_commands;
    };

    // set server
    $scope.setServer = function(server) {
        server.loading = true;
        $scope.active_server = server.id;

        // gambis forever
        setTimeout(function(){
            server.loading = false;
        },3000);
    };

    // set command
    $scope.setCommand = function(command) {
        $scope.active_command = command;
    };



    // show log
    $scope.showLog = function() {

        $scope.loading = true;

        // request json data
        $http.get('get_log.php?server_id='+$scope.selected_server+',&command='+$scope.active_command).success(function(data){
            console.log(data);
            $scope.results = data;
            $scope.loading = false;
        }).error(function(data,status){
            console.log('Error: '+status);
        });

    }


    // show log
    $scope.searchAllCommands = function() {

        $scope.loading = true;

        var search_all = angular.element(document.getElementById('search_fall')).val();

        // request json data
        $http.get('get_log_all.php?server_id='+$scope.selected_server+',&search_all='+search_all).success(function(data){
            console.log(data);
            $scope.results = data;
            $scope.loading = false;
        }).error(function(data,status){
            console.log('Error: '+status);
        });

    }

    // search on hash
    $scope.searchHash = function() {

        $scope.loading_hash = true;

        var search = angular.element(document.getElementById('search')).val();
        console.log(search);

        // request json data
        $http.get('get_player.php?server_id='+$scope.selected_server+',&search='+search+'&group_by='+$scope.group_by+'&hide='+$scope.hide_duplica).success(function(data){

            console.log(data);
            $scope.results_hash = data;
            $scope.loading_hash = false;

        }).error(function(data,status){
            console.log('Error: '+status);
            console.log(data);
        });

    }


    $scope.getPlayerInfo = function(nickname) {

        $scope.loading_player = true;

        $scope.active_nickname = nickname;

        // request json data
        $http.get('get_log_all.php?server_id='+$scope.selected_server+',&search_all='+nickname).success(function(data){

            $scope.result_player = data;
            $scope.loading_player = false;

        }).error(function(data,status){
            console.log('Error: '+status);
            console.log(data);
        });

    }

    // timeout to set timestamp
    setTimeout( function () {
        $scope.timeStamp();
    },100);

    $scope.timeStamp = function() {
        // each servers to increment timestamp
        _.each( $scope.server_list , function( server ) {
            console.log('get_timestamp.php?server_id='+server.id);
            $http.get('get_timestamp.php?server_id='+server.id).success(function(data){
                    server.timestamp = data.timestamp;
            }).error(function(data,status){
                console.log('Error: '+status);
            });

        });
    }

    $scope.download_button_css = 'btn-default';
    $scope.download_button = 'Update Log';

    // execute download of log file
    $scope.downloadLog = function( id_server ){
        $scope.download_button = "Updating..";
        $scope.download_button_css = 'btn-warning';
        $http.get('download.php?server_id='+id_server).success(function(data){
            $scope.download_button = "Updated";
            $scope.download_button_css = 'btn-success';
            $scope.timeStamp();
        }).error(function(data,status){
            $scope.download_button = "Error";
            $scope.download_button_css = 'btn-danger';
            console.log('Error: '+status);
        });
    };




}]);