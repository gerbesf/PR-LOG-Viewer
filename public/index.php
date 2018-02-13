<?php

// config file
require '../config.php';

// sux session class and redirect
$Session = new \App\Session();
if($Session->isLogged()==false && $GLOBALS['config']['require_login']==true){
    return header('Location: login.php');
}
?><!DOCTYPE html>
<html lang="en" ng-app="App">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config['app']['name']; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/ApplicationController.js"></script>
    <script>
        <?php
        // servers lists
        $servers_list = json_encode($config['servers_list']);
        echo "var server_list = ". $servers_list . ";\n";

        // servers commands
        $server_commands = json_encode($config['server_commands']);
        echo "var server_commands = ". $server_commands . ";\n";
        ?>
    </script>
    <style>
        /* Label of name server */
        .labelServer {
            font-size:25px;
            line-height: 40px;
        }

        /* no break line on author collum */
        .authors_td {
            white-space: nowrap;
        }

        /* block padding fix */
        .tab-block {
            padding:10px 0;
        }
    </style>
</head>

<!-- Starting Angular Controller -->
<body ng-controller="ApplicationController">

<!-- load contents on angular js -->
<div class="container" ng-init="loadContents()">

    <div class="row-fluid">
        <?php /* if login is required */ ?>
        <?php if( $GLOBALS['config']['require_login'] == true ) { ?>

        <div class="pull-right">
            Hello, <b><?php echo $_SESSION['user_name']; ?></b> <small><a href="logout.php">Logout</a></small>
        </div>
        <?php } ?>

        <h1><?php echo $config['app']['name']; ?></h1>
        <p><?php echo $config['app']['desc']; ?></p>

    </div>

        <div class="row">

            <div class="col-md-6">

                <h3>Choose the Server</h3>

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
            <div class="col-md-6" ng-hide="active_server==null">

                <!-- tabs -->
                    <label ng-click="tab='default';results=[];results_hash=[]" >
                        <input type="radio" name="tab" ng-checked="tab=='default'" >
                        Choose the Command
                    </label>
                    <label  ng-click="tab='player';results=[];results_hash=[]">
                        <input  type="radio"  name="tab"  ng-checked="tab=='player'" >
                        Choose the Player
                    </label>

                <div class="tab-block" ng-show="tab=='default'">
                    <ul class="list-group" >
                        <li  class="list-group-item"  ng-click="setCommand(command.value)" ng-class="{'active':active_command==command.value}" ng-repeat="command in server_commands">
                            <label>
                                {{ command.name }}
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="tab-block" ng-show="tab=='player'">

                    <label  ng-click="group_by='nick'">
                        <input  type="radio"  name="group_by" ng-click="results_hash=[]" ng-checked="group_by=='nick'" >
                        Group by nickname
                    </label>


                    <label  ng-click="group_by='hash'">
                        <input  type="radio"  name="group_by" ng-click="results_hash=[]"  ng-checked="group_by=='hash'" >
                        Group by Hash
                    </label>


                    <label  ng-click="group_by='data'">
                        <input  type="radio"  name="group_by"  ng-click="results_hash=[]" ng-checked="group_by=='data'" >
                        Group by Date
                    </label>



                    <label  ng-click="group_by='ip'">
                        <input  type="radio"  name="group_by"  ng-click="results_hash=[]"  ng-checked="group_by=='ip'" >
                        Group by IP
                    </label>

                    <form ng-submit="searchHash()">
                       <p>Search anything on Hash log</p>
                       <div class="input-group input-group-lg">
                           <input type="text" class="form-control"  ng-click="results_hash=[]" ng-model="search" placeholder="Search for...">
                           <span class="input-group-btn">
                        <button class="btn btn-default" ng-click="searchHash()" ng-disabled="active_server==null || search.length==0"  type="button">Search!</button>
                      </span>
                       </div><!-- /input-group -->
                   </form>

                </div>

            </div>

        </div>
        <div class="row-fluid"  ng-hide="active_server==null"  ng-show="tab=='default'">
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
                                <td class="col-md-3 authors_td">
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

    <div ng-show="loading_hash">
        Searching...
    </div>
    <!--

     ng-show="results_hash.length!=0 || results_hash!=[]"
    -->
    <div   ng-show="results_hash.length!=0">
    <div  ng-show="tab=='player'" >

        <table class="table table-condensed table-hover">
            <thead>
            <tr>
                <th>
                    Date
                </th>
                <th>
                    Hash
                </th>
                <th>
                    Nickname
                </th>
                <th>
                    Ip Address
                </th>
            </tr>
            </thead>
            <tbody  ng-repeat="(keyGroup,lines) in results_hash">

            <tr>
                <td colspan="4" style="background: #ddd">
                    <b ng-show="group_by=='nick'">Nick:</b>
                    <b ng-show="group_by=='hash'">Hash:</b>
                    <b ng-show="group_by=='data'">Data:</b>
                    <b ng-show="group_by=='ip'">IP:</b>
                    {{ keyGroup  }}
                </td>
            </tr>
            <tr ng-repeat="line in lines">
                <td>
                    {{ line.data }}
                </td>
                <td>
                    {{ line.hash  }}
                </td>
                <td>
                    {{ line.nick  }}
                </td>
                <td>
                    <img style="width: 32px;" ng-src="./flag.php?ip={{ line.ip  }}">
                    {{ line.ip  }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
</div>


</body>
</html>
