<?php

require '../config.php';
$Session = new \App\Session();
if($Session->isLogged()!=false){
    return header('Location: index.php');
}
if(isset($_POST['username'])){
    foreach($config['auth'] as $auth){
        if($auth['username']==$_POST['username']){

            if($config['with_md5']==false){

                if($auth['password']==$_POST['password']){
                    $_SESSION['user_id']    = $auth['id'];
                    $_SESSION['user_name']  = $auth['name'];
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

    <title><?php echo $config['app']['name']; ?>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/app.js"></script>
    <script src="js/LoginController.js"></script>
    <link href='style/template.css' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

</head>
<body ng-controller="LoginController">
<div class="container">
    <div class="container" style="margin-top: 100px">
        <div class="row vertical-offset-100">
            <div class="col-md-4 col-md-offset-4">

                <form action="login.php" method="post" class="form-horizontal m-t-20" role='form' name='formLogin' novalidate="">

                    <h1><?php echo $config['app']['name']; ?></h1>
                    <p><?php echo $config['app']['desc']; ?></p>

                    <?php
                            if(isset($message)){
                                echo '<div class="alert alert-danger">'.$message.'</div>';
                            }
                    ?>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" name="username" type="text" ng-model="form_login.username" required placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" name="password" type="password" ng-model="form_login.password" required placeholder="Senha">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button class="btn btn-lg btn-primary btn-block"  ng-disabled="formLogin.$invalid" type="submit">Sign in</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    </div>


</body>
</html>