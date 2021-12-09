<?php
include_once 'conf/conf.php';
global $db;
global $path;

// Defining variables
$login_type = $username = $password = "";

// Checking for a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_type = test_input($_POST["login_type"]);
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if (isset($_POST['login'])) {

    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
    }

    if ($db) {

        $user = htmlspecialchars($_POST['username']);
        $user = mysqli_real_escape_string($db, $user);
        $pass = htmlspecialchars($_POST['password']);
        $pass = mysqli_real_escape_string($db, $pass);
        if ($user == "" or $pass == "") {
            $msg = "Blank Data Not Allowed";
        } else {
            $q = "call get_user('" . $user . "','" . $pass . "');";
//            echo $q;
            $retrieve = $db->query($q) or die(mysqli_error($db));
            if (($retrieve)) {
                while ($retrievedata = $retrieve->fetch_array()) {
                    $chno = $retrievedata['emp_id'];
                    $fname = $retrievedata['em_fname'];
                    $lname = $retrievedata['em_lname'];
                    $Roleid = $retrievedata['role_id'];
                    $apass = $retrievedata['emp_pass'];
                }
                $retrieve->close();
                $db->next_result();
                if ($pass != $apass) {
                    $msg = "Wrong User Name / Password. Please Check";
                    echo "<script>alert('" . $msg . "')</script>";
                    session_start();
                    $_SESSION['username_profile'] = '';
                    $_SESSION['Roleid'] = '';
                } else if ($Roleid == "" or $Roleid == 0) {
                    session_start();
                    $_SESSION['Roleid'] = $Roleid;
                    $_SESSION['username_profile'] = '';
                    //$msg="You don't have permission to access this portal.Please Contact Administrator";
                    header("Location: logoutmessage.php");
                } else {
                    session_start();
                    global $path;
                    $fuser = $fname . " " . $lname;
                    $_SESSION['ChkNo'] = $chno;
                    $_SESSION['username_profile'] = $fuser;
                    $_SESSION['Roleid'] = $Roleid;
                    header("Location: welcome.php");
                }
            } else {
//                            echo 'in else';
//				$msg="Wrong Login Or Password.Please Check";
            }
        }
    }
} else {
    // echo "in else";
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
                            <input type="submit" name="login"  value="Login" class="btn btn-primary btn-block">
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