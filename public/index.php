<?php

require '../config.php';
$Session = new \App\Session();
if($Session->isLogged()==false){
    return header('Location: login.php');
}
?><!DOCTYPE html>
<html lang="en" ng-app="App">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config['app']['name']; ?>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/ApplicationController.js"></script>
    <script>
        <?php
        $servers_list = json_encode($config['servers_list']);
        echo "var server_list = ". $servers_list . ";\n";
        $server_commands = json_encode($config['server_commands']);
        echo "var server_commands = ". $server_commands . ";\n";
        ?>
    </script>
    <style>
        .labelServer {
            font-size:25px;
            line-height: 40px;
        }
    </style>
</head>
<body ng-controller="ApplicationController">
<div class="container" ng-init="loadContents()">

    <div class="row-fluid">
        <div class="pull-right">
            Hello, <b><?php echo $_SESSION['user_name']; ?></b> <small><a href="logout.php">Logout</a></small>
        </div>
        <h1><?php echo $config['app']['name']; ?></h1>
        <p><?php echo $config['app']['desc']; ?></p>

    </div>

        <div class="row">

            <div class="col-md-6">

                    <h2>Choose the Server - ({{ active_server }})</h2>

                        <ul class="list-group">
                            <li  class="list-group-item" ng-click="setServer(server.id)" ng-class="{'active':active_server==server.id}" ng-repeat="server in server_list">
                                <label class="labelServer">
                                    {{ server.name }}
                                </label>
                                <button class="btn btn-xs {{ download_button_css }} pull-right" ng-click="setServer(server.id);downloadLog()">
                                    {{ download_button }}<br>
                                    <small><span class="fa fa-time"> </span> Last Update: <span ng-if="!server.timestamp">loading...</span> {{ server.timestamp }}</small>
                                </button>
                            </li>
                        </ul>

            </div>
            <div class="col-md-6">
                    <h2>Choose the Command - ({{ active_command }})</h2>
                        <ul class="list-group" >
                            <li  class="list-group-item"  ng-click="setCommand(command.value)" ng-class="{'active':active_command==command.value}" ng-repeat="command in server_commands">
                                <label>
                                    {{ command.name }}
                                </label>
                            </li>
                        </ul>
                </div>

        </div>
        <div class="row-fluid">
            <div class="col-md-12">
                <button class="btn btn-default btn-lg btn-block" ng-click="showLog()" ng-disabled="active_server==null || active_command==null" >Show log</button>
                <br>
                <div ng-show="loading">
                    <img src="images/loading.gif"><br>
                    Loading
                </div>
                <div ng-show="results.server_log">

                    <div class="well well-sm">

                        <input class="form-control" ng-model="filter_list" class="form-control form-lg" placeholder="Filter">

                    </div>
                    <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Command
                                </th>
                                <th>
                                    Authors
                                </th>
                                <th>
                                    Content
                                </th>
                            </tr>
                            </thead>
                            <tr ng-repeat="item in results.server_log | filter:filter_list">
                                <td class="col-md-2">
                                    {{ item.date  }} <b>{{ item.hour }}</b>
                                </td>
                                <td class="col-md-1">
                                    <span class="text-{{ item.color }}">{{ item.command }}</span>
                                </td>
                                <td class="col-md-3">
                                    <b>'{{ item.players }}'</b>
                                </td>
                                <td>
                                    {{ item.content }}
                                </td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>

</div>


</body>
</html>