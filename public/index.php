<?php

require '../config.php';
$Session = new \App\Session(); // sux session class and redirect
if($Session->isLogged()==false && $GLOBALS['config']['require_login']==true){
    return header('Location: login.php');
}
?><!DOCTYPE html>
<html lang="en" ng-app="App">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config['app_name']; ?></title>
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.5.7/angular-sanitize.js"></script>
    <script src="js/app.js"></script>
    <script src="js/ApplicationController.js?v=1.1"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>

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
        /*!* Label of name server *!
        .labelServer {
            font-size:25px;
            line-height: 40px;
            cursor: pointer;
        }

        !* no break line on author collum *!
        .authors_td {
            white-space: nowrap;
        }

        !* block padding fix *!
        .tab-block {
            padding:10px 0;
        }
        .divide-col {
            -moz-column-count: 2;  -moz-column-gap: 20px;    -webkit-column-count: 2;    -webkit-column-gap: 20px;    column-count: 2; column-gap: 20px;
        }
        table{
            font-size:12px
        }
        .footer { margin-top: 30px;}

        .modal-lg { width: 100%!important; }

        <?php if( $GLOBALS['config']['full_width'] == true ) { ?>
        .container { width: 98%!important; }
        <?php } ?>

        .pl-3 { padding-left:10px}*/

    </style>
</head>

<!-- Starting Angular Controller -->
<body ng-controller="ApplicationController">

<!-- load contents on angular js -->
<div class="" ng-init="loadContents()">

    <div class="shadow-sm">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-md-9">
                    <h1 class="m-2"><?php echo $config['app_name']; ?></h1>
                </div>
                <div class="col-md-3">

                    <div class="p-4">
                        <?php /* if login is required */ ?>
                        <?php if( $GLOBALS['config']['require_login'] == true ) { ?>
                            <div class="pull-right">
                                Hello, <b><?php echo $_SESSION['user_name']; ?></b> <small><a href="logout.php">Logout</a></small>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container p-4">
    <div class="row">

        <div class="col-md-12">
            <h5 class="mb-3">Choose the Server ( {{ selected_server.length }}  <span ng-if="selected_server.length==1">server</span> <span ng-if="selected_server.length>=2">servers</span> selected )</h5>
            <ul class="list-group cursor">
                <li  class="list-group-item py-1"  ng-click="toogleServer(server.id)" ng-class="{'bg-light':inArray(server.id)==true}" ng-repeat="server in server_list">
                    <div class="float-left p-1 font-weight-bold" >
                        {{ server.name }}
                    </div>
                    <button class="btn btn-link  float-right" ng-click="setServer(server);downloadLog(server);toogleServer(server.id)">
                        <div ng-show="server.loading">Loading</div>
                        <div ng-hide="server.loading">
                            <small><span class="fa fa-time"> </span> Updated on: <span ng-if="!server.timestamp">loading...</span> {{ server.timestamp }}</small>
                        </div>
                    </button>
                </li>
            </ul>
        </div>

            <div class="col-md-12" ng-hide="selected_server.length==0">
                <div style="height: 17px"></div>
                <!-- tabs -->

                <div class="row justify-content-center mb-2">
                    <div class="col-md-3 text-center">
                        <label ng-click="tab='default';results=[];results_hash=[]" >
                            <input type="radio" name="tab" ng-checked="tab=='default'" >
                            Admin Logs
                        </label>
                    </div>
                    <div class="col-md-3 text-center">
                        <label  ng-click="tab='player';results=[];results_hash=[]">
                            <input  type="radio"  name="tab"  ng-checked="tab=='player'" >
                            Player Logs
                        </label>
                    </div>
                </div>

                <div class="tab-block" ng-show="tab=='default'">
                    <div style="height: 300px; width: 100%; overflow-y: scroll">
                    <ul class="list-group divide-col" >
                        <li  class="list-group-item"   ng-click="setCommand(command.value)" ng-class="{'active':active_command==command.value}" ng-repeat="command in server_commands">
                            <label class="p-0 m-0">
                                {{ command.name }}
                            </label>
                        </li>
                    </ul>
                        <ul class="list-group mt-3" >
                            <li  class="list-group-item"   ng-click="setCommand('ALL')" ng-class="{'active':active_command=='ALL'}">
                                <label>
                                    ALL COMMANDS PER PLAYER
                                </label>
                            </li>
                        </ul>
                    </div>


                    <div ng-if="active_command=='ALL'">

                        <div class="input-group input-group-lg">
                            <input type="text" name="search_fall" id="search_fall" class="form-control"  ng-model="search_fall" placeholder="Search in all data">
                            <span class="input-group-btn">
                                <button class="btn btn-success btn-lg" ng-click="searchAllCommands()" ng-disabled="selected_server.length==0 || search_all.length==0"  type="button">Search</button>
                              </span>
                        </div><!-- /input-group -->
                        <br>

                    </div>

                    <div ng-if="active_command!='ALL'">
                        <button class="btn btn-success btn-lg btn-block" ng-click="showLog()" ng-disabled="selected_server.length==0 || active_command==null" >Show log</button>
                    </div>

                </div>
                <div class="tab-block" ng-show="tab=='player'">

                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group" >
                                <li  class="list-group-item" ng-click="group_by='nick';results_hash=[]"  ng-checked="group_by=='nick'" ng-class="{'active':group_by=='nick'}">
                                    <label>
                                        Organize by NickName
                                    </label>
                                </li>
                                <li  class="list-group-item" ng-click="group_by='hash';results_hash=[];"  ng-checked="group_by=='hash'" ng-class="{'active':group_by=='hash'}">
                                    <label>
                                        Organize by Hash
                                    </label>
                                </li>
                                <li  class="list-group-item" ng-click="group_by='data';results_hash=[]"  ng-checked="group_by=='data'" ng-class="{'active':group_by=='data'}">
                                    <label>
                                        Organize by Time
                                    </label>
                                </li>
                                <li  class="list-group-item" ng-click="group_by='ip';results_hash=[]"  ng-checked="group_by=='ip'" ng-class="{'active':group_by=='ip'}">
                                    <label>
                                        Organize by IP
                                    </label>
                                </li>
                            </ul>

                        </div>
                        <div class="col-md-6">
                            <ul class="list-group"   ng-init="hide_duplica='true'">

                                <li  class="list-group-item" ng-click="hide_duplica='true';results_hash=[]" ng-class="{'active':hide_duplica=='true'}">
                                    <label>
                                        Hide duplicate
                                    </label>
                                </li>
                                <li  class="list-group-item" ng-click="hide_duplica='false';results_hash=[]" ng-class="{'active':hide_duplica=='false'}">
                                    <label>
                                        Show duplicate
                                    </label>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <form ng-submit="searchHash()">

                        <div class="input-group input-group-lg mt-3" >
                            <input type="text" class="form-control" id="search"  ng-click="results_hash=[]" ng-model="search" placeholder="Search for...">
                            <span class="input-group-btn">
                        <button class="btn btn-success btn-lg" ng-click="searchHash()" ng-disabled="selected_server.length==0 || search.length==0"  type="button">Search!</button>
                      </span>
                        </div><!-- /input-group -->
                    </form>

                </div>

            </div>


    </div>
    </div>


    <div class="container p-4">
        <div class="row"  ng-hide="selected_server.length==0"  ng-show="tab=='default'">
            <div class="col-md-12">
                <div ng-show="loading">
                    <img src="images/loading.gif"><br>
                    Loading
                </div>
                <div ng-show="results.server_log">

                    <div class="well well-sm" ng-init="filter_list=''">
                        <input class="form-control" ng-model="filter_list" class="form-control form-lg" placeholder="Filter">

                    </div>
                    <table class="table table-hover table-sm small">
                        <thead>
                        <tr>
                            <th style="width: 100px">
                                Server
                            </th>
                            <th >
                                Date
                            </th>
                            <th >
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
                            <td >
                                {{ item.server }}
                            </td>
                            <td>
                                {{ item.date  }} <b>{{ item.hour }}</b>
                            </td>
                            <td >
                                <span class="text-{{ item.color }}">{{ item.command }}</span>
                            </td>
                            <td>
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
        <div   ng-show="results_hash.length!=0">
            <div  ng-show="tab=='player'" >

                <table class="table table-hover table-sm small">
                    <thead>
                    <tr>
                        <th>
                            Server
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Hash
                        </th>
                        <th>
                            State
                        </th>
                        <th>
                            Steam Level
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
                        <td colspan="7" style="background: #eeeeee">
                            <b ng-show="group_by=='nick'">Nick:</b>
                            <b ng-show="group_by=='hash'">Hash:</b>
                            <b ng-show="group_by=='data'">Data:</b>
                            <b ng-show="group_by=='ip'">IP:</b>
                            {{ keyGroup  }}
                        </td>
                    </tr>
                    <tr ng-repeat="line in lines">
                        <td>
                            {{ line.server }}
                        </td>
                        <td>
                            {{ line.data }}
                        </td>
                        <td>
                            <code>{{ line.hash  }}</code>
                        </td>
                        <td>
                            <div ng-if="line.tags.length==0"><span class="badge badge-warning">New Account</span></div>
                            <div ng-repeat="tag in  line.tags ">
                        <span class="badge badge-success" ng-if="tag==='LEGACY'">
                            Legacy
                        </span>
                                <div class="badge badge-danger"  ng-if="tag==='VAC BANNED'">
                                    Vac Banned
                                </div>
                            </div>
                        </td>
                        <td>
                        <span class="badge badge-danger" ng-if="line.steam_level==='0'">
                            High risk
                        </span>
                            <span class="badge badge-info" ng-if="line.steam_level==='1'">
                            Medium risk
                        </span>
                            <span class="badge badge-success" ng-if="line.steam_level==='2'">
                            Low risk
                        </span>
                        </td>
                        <td>
                            <a ng-click="getPlayerInfo(line.nick)" data-toggle="modal" data-target="#myModal" >{{ line.nick  }}</a>
                        </td>
                        <td>
                            <img style="width: 24px;" ng-src="./flag.php?ip={{ line.ip  }}">
                            {{ line.ip  }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="max-width: 100%!important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">History of: <b> {{ active_nickname }}</b></h4>
                </div>
                <div class="modal-body">
                    <div ng-show="result_player.server_log">
                        <div style="height: <?php echo $config['modal_height']; ?>; overflow-x: scroll">
                            <table class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        Server
                                    </th>
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
                                <tr ng-repeat="item in result_player.server_log">
                                    <td class="">
                                        {{ item.server }}
                                    </td>
                                    <td class="">
                                        {{ item.date  }} <b>{{ item.hour }}</b>
                                    </td>
                                    <td class="">
                                        <span class="text-{{ item.color }}">{{ item.command }}</span>
                                    </td>
                                    <td class="">
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

        </div>
    </div>


    <div  style="opacity: 0.4; padding-top: 35px;">
        <div class="text-center">
            <small class="text-muted pl-3">DIVSUL 2014-<?php echo date('Y'); ?></small>
        </div>
        <!--<a class="github-button" href="https://github.com/gerbesf/PR-LOG-Viewer" aria-label="Watch gerbesf/PR-LOG-Viewer on GitHub"></a>
        <a class="github-button" href="https://github.com/gerbesf/PR-LOG-Viewer/fork" data-icon="octicon-repo-forked" aria-label="Fork gerbesf/PR-LOG-Viewer on GitHub">Fork</a>
        <a class="github-button" href="https://github.com/gerbesf/PR-LOG-Viewer/issues" data-icon="octicon-issue-opened" aria-label="Issue gerbesf/PR-LOG-Viewer on GitHub">Issue</a>-->
    </div>

    <!--<script async defer src="https://buttons.github.io/buttons.js"></script>-->

</body>
</html>
