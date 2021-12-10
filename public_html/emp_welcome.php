<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome</title>
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
                        <li><a href="logout.php">Logout</a></li>
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
        <div class="text-center">
            <h3>Welcome Employee_Name</h3>

            <form method="post" autocomplete="off" class="container">
                <div class="row">

                    <label for="SSN" class="col-sm-1 text-lead">SSN&nbsp;:</label>
                    <div class="col-md-5 col-xs-11">
                        <div class="form-group">
                            <input type="text" class="form-control" name="SSN" placeholder="SSN"
                                   required="required">
                        </div>
                    </div>
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
