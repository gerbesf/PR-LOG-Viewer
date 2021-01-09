
Application.controller('ApplicationController',['$scope','$filter','$http','$interval',function($scope,$filter,$http,$interval){

    // lol params
    $scope.server_list = 1;
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

    // Load content from html, commands and servers
    $scope.loadContents = function(){
        $scope.server_list = server_list;
        $scope.server_commands = server_commands;

        // after load server, each items to get timestamp
        _.each( $scope.server_list , function( server ) {
            $scope.timeStamp(server);
        });

    };

    // select/click server
    $scope.toogleServer = function( server_id ) {
        // has selected
        var selected = _.contains($scope.selected_server, server_id);
        if( selected == true ){
            // remove server from list
            $scope.selected_server = _.without($scope.selected_server, server_id);
        }else{
            // add server on list
            $scope.selected_server.push(server_id);
        }
    };

    // check server in array for active css
    $scope.inArray = function(server_id) {
        return _.contains($scope.selected_server, server_id);
    };

    // set command
    $scope.setCommand = function(command) {
        $scope.active_command = command;
    };

    // show log
    $scope.showLog = function() {

        $scope.results = [];
        $scope.loading = true;

        // Request Data
        $http.get('get_log.php?server_id='+$scope.selected_server+',&command='+$scope.active_command).success(function(data){

            $scope.results = data;
            $scope.loading = false;

        }).error(function(data,status){
            console.log('-- Error in Show Log');
            console.log(data,status);
        });

    }


    // show all log from keysearch
    $scope.searchAllCommands = function() {

        $scope.results = [];
        $scope.loading = true;

        // force get search input
        var search_all = angular.element(document.getElementById('search_fall')).val();

        // Request Data
        $http.get('get_log_all.php?server_id='+$scope.selected_server+',&search_all='+search_all).success(function(data){

            $scope.results = data;
            $scope.loading = false;

        }).error(function(data,status){
            console.log('-- Error in Search on All Commands');
            console.log(data,status);
        });

    }

    // search on hash
    $scope.searchHash = function() {

        $scope.results_hash = [];
        $scope.loading_hash = true;

        // force get search input
        var search = angular.element(document.getElementById('search')).val();

        // Request Data
        $http.get('get_player.php?server_id='+$scope.selected_server+',&search='+search+'&group_by='+$scope.group_by+'&hide='+$scope.hide_duplica).success(function(data){

            $scope.results_hash = data;
            $scope.loading_hash = false;

        }).error(function(data,status){
            console.log('-- Error in Search Hash');
            console.log(data,status);
        });

    }


    // Load Player History Commands
    $scope.getPlayerInfo = function(nickname) {

        $scope.result_player = [];
        $scope.loading_player = true;

        // active nickname
        $scope.active_nickname = nickname;

        // Request Data
        $http.get('get_log_all.php?server_id='+$scope.selected_server+',&search_all='+nickname).success(function(data){

            $scope.result_player = data;
            $scope.loading_player = false;

        }).error(function(data,status){
            console.log('-- Error in Player History');
            console.log(data,status);
        });

    }

    // search timestamps of servers loaded
    $scope.timeStamp = function(server) {

        // Request Timestamp
        $http.get('get_timestamp.php?server_id='+server.id).success(function(data){

            if( data.timestamp == "") {
                server.timestamp = 'never updated';
            }else{
                server.timestamp = data.timestamp;
            }
            server.loading = false;

        }).error(function(data,status){
            console.log('-- Error in Get Timestamp');
            console.log(data,status);
        });

    }


    // Execute download of log file
    $scope.downloadLog = function( server ){

        server.loading = true;

        console.log('Downloading '+server.id);

        // Execute download from request url
        $http.get('download.php?server_id='+server.id).success(function(data){

            if(data.success==false){
                alert(data.message);
            }else{

            }
            $scope.timeStamp(server);

        }).error(function(data,status){
            console.log('Error: '+status);
        });
    };

    // Check session
    $scope.checkSession = function() {
        // Check Session URI
        $http.get('get_session.php').success(function(data){
            if(data.status!=true){
                window.location = './logout.php';
            }
        }).error(function(data,status){
            window.location = './logout.php';
        });
    }

    // Interval to check Session
    $interval( function(){ $scope.checkSession(); }, 10000);

}]);