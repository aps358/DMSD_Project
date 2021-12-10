<?php
// Defining variables
$login_type = $username = $password = "";
$utype = $upass = "";

include_once 'conf/conf.php';
global $db;
global $path;

// Checking for a POST request
if (isset($_POST['login'])) {

    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
    }

    if ($db) {
        $type = htmlspecialchars($_POST['login_type']);
        $type = mysqli_real_escape_string($db, $type);
        $user = htmlspecialchars($_POST['username']);
        $user = mysqli_real_escape_string($db, $user);
        $pass = htmlspecialchars($_POST['password']);
        $pass = mysqli_real_escape_string($db, $pass);

        if ($user == "" or $pass == "") {
            $msg = "Blank Data Not Allowed";
        } else {
            $q = "select * from login where type = '" . $type . "' and username ='" . $user . "'and password ='" . $pass . "';";
            // echo $q;
            $retrieve = $db->query($q) or die(mysqli_error($db));
            if ($retrieve) {
                while ($retrievedata = $retrieve->fetch_array()) {
                    $utype = $retrievedata['type'];
                    $uname = $retrievedata['username'];
                    $upass = $retrievedata['password'];
                }
                $retrieve->close();
                $db->next_result();
                if ($pass != $upass) {
                    $msg = "Wrong User Name / Password. Please Check";
                    echo "<script>alert('" . $msg . "')</script>";
                    session_start();
                } elseif ($type == "customer") {
                    session_start();
                    global $path;
                    header("Location: cust_welcome.php");
                } else {
                    session_start();
                    global $path;
                    header("Location: emp_welcome.php");
                }
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">

</head>
<body>

<div id="primary_container">

    <!--There is where the navigation will go-->
    <div id="navigation">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">CS-631 BANK</a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="aboutus.php">About Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!--There is where the body content will go-->
    <div id="content">
        <h1 class="h1 text-center">CS-631 BANK</h1>
        <br/>
        <hr class="container"/>
        <div class="div-center">
            <div class="col-md-12" id="index_jumbo">
                <div class="login-form">
                    <form method="post" autocomplete="off">
                        <h3 class="text-center">Log in</h3>
                        <div class="form-group text-center">
                            <input type="radio" id="employee" name="login_type" value="employee" checked>
                            <label for="huey">Employee</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" id="customer" name="login_type" value="customer">
                            <label for="huey">Customer</label>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username"
                                   required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                   required="required">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" value="Login" class="btn btn-primary btn-block">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!--There is where the footer will go-->
    <div id="footer">
        <footer class="sticky-footer container-fluid mt-auto">
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <span class="text-lead">&copy; Amey Sawant & Tejas Kenjale</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436720/particles.js"></script>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436735/app.js"></script>
<script src="js/myjavascript.js"></script>

</body>
</html>