<?php
require '../config.php';
$Session = new \App\Session();
if($Session->isLogged()!=false or $GLOBALS['config']['require_login']==false){
    return header('Location: index.php');
}
if(isset($_POST['username'])){
    foreach($config['auth'] as $auth){
        if($auth['username']==$_POST['username']){

            if($config['with_md5']==false){

                if($auth['password']==$_POST['password']){
                    $_SESSION['user_id']    = $auth['id'];
                    $_SESSION['user_name']  = $auth['name'];
                    $_SESSION['expires']  = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + '. $config['expiration_time'] ?: '1 hour'));
                    echo header('Location: index.php');
                }else{
                    $message = 'User name or password incorrect.';
                }

            }else{

                if($auth['password']==md5($_POST['password'])){
                    $_SESSION['user_id']    = $auth['id'];
                    $_SESSION['user_name']  = $auth['name'];
                    echo header('Location: index.php');
                }else{
                    $message = 'User name or password incorrect.';
                }

            }

        }else{
            $message = 'User name or password incorrect.';
        }
    }
}

?><!DOCTYPE html>
<html lang="en" ng-app="App">
<head>
    <meta charset="UTF-8">

    <title><?php echo $config['app_name']; ?></title>
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.5.7/angular-sanitize.js"></script>

    <script src="js/app.js"></script>
    <script src="js/LoginController.js"></script>
    <link href='style/template.css' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

</head>
<body ng-controller="LoginController">
<div class="container">
    <div class="container" style="margin-top: 35vh">
        <div class="row vertical-offset-100">
            <div class="col-md-4 col-md-offset-4">

                <form action="login.php" method="post" class="form-horizontal m-t-20" role='form' name='formLogin' novalidate="">

                    <h1><?php echo $config['app_name']; ?></h1>

                    <?php
                            if(isset($message)){
                                echo '<div class="alert alert-danger">'.$message.'</div>';
                            }
                    ?>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control form-control-lg" name="username" type="text" ng-model="form_login.username" required placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control form-control-lg" name="password" type="password" ng-model="form_login.password" required placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button class="btn btn-lg btn-primary btn-block bgn-lg"  ng-disabled="formLogin.$invalid" type="submit">Sign in</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    </div>


</body>
</html>