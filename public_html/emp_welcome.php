<?php
include_once 'conf/conf.php';
global $db;
global $path;

$acc_no = $ssn = $first_name = $last_name = $apt_no = $street_no = $city = $zip_code = $state = "";
$new_acc = "";

$q1 = "SELECT acc_no FROM customer ORDER BY acc_no DESC LIMIT 1;";
$result = $db->query($q1) or die(mysqli_error($db));
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $old_acc = $row["acc_no"];
        //echo "<script>alert(".$old_acc.")</script>";
    }
} else {
    echo "0 results";
}

$new_acc = $old_acc + 1;
echo "<script> alert(". $new_acc .")</script>";

if (isset($_POST['insert'])) {

    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
    }

    if ($db) {

        $ssn = mysqli_real_escape_string($db, htmlspecialchars($_POST['ssn']));
        $acc_no = mysqli_real_escape_string($db, htmlspecialchars($_POST['acc_no']));
        $first_name = mysqli_real_escape_string($db, htmlspecialchars($_POST['first_name']));
        $last_name = mysqli_real_escape_string($db, htmlspecialchars($_POST['last_name']));
        $apt_no = mysqli_real_escape_string($db, htmlspecialchars($_POST['apt_no']));
        $street_no = mysqli_real_escape_string($db, htmlspecialchars($_POST['street_no']));
        $city = mysqli_real_escape_string($db, htmlspecialchars($_POST['city']));
        $zip_code = mysqli_real_escape_string($db, htmlspecialchars($_POST['zip_code']));
        $state = mysqli_real_escape_string($db, htmlspecialchars($_POST['state']));

        if ($ssn == "" or $acc_no == "") {
            $msg = "Blank Data Not Allowed";
        } else {

            $q = "INSERT INTO customer " . "(ssn, acc_no, first_name, last_name, apt_no, street_no, city, zip_code, state) " . "VALUES('$ssn', '$new_acc', '$first_name', '$last_name', '$apt_no', '$street_no', '$city', '$zip_code', '$state')";
            $retrieve = $db->query($q) or die(mysqli_error($db));
            echo $retrieve;
        }
    }
}
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
            <br/>
            <h3>Welcome Employee_Name</h3>
            <br/><br/>

            <form method="post" autocomplete="off" class="container" id="emp_form">
                <label for="SSN" class="col-sm-2 lb-lg">Account No:</label>
                <div class="col-md-10 col-xs-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="acc_no" required="required" value="<?php $new_acc; ?>">
                    </div>
                </div>


                <label for="SSN" class="col-sm-2 lb-lg">SSN:</label>
                <div class="col-md-10 col-xs-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="ssn" placeholder="SSN"
                               required="required">
                    </div>
                </div>


                <label for="first_name" class="col-sm-2 lb-lg">First Name:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="first_name" placeholder="First Name"
                               required="required">
                    </div>
                </div>

                <label for="last_name" class="col-sm-2 lb-lg">Last Name:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                               required="required">
                    </div>
                </div>


                <label for="apt_no" class="col-sm-2 lb-lg">Apt. No.:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="apt_no" placeholder="Apt No."
                               required="required">
                    </div>
                </div>


                <label for="street_no" class="col-sm-2 lb-lg">Street No.:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="street_no" placeholder="Street No."
                               required="required">
                    </div>
                </div>


                <label for="city" class="col-sm-2 lb-lg">City:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="city" placeholder="City"
                               required="required">
                    </div>
                </div>

                <label for="zip" class="col-sm-2 lb-lg">Zip:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="zip_code" placeholder="Zip Code"
                               required="required">
                    </div>
                </div>

                <label for="state" class="col-sm-2 lb-lg">State:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="state" placeholder="State"
                               required="required">
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="submit" name="insert" value="Add" class="btn btn-success btn-block">
                        </div>
                        <div class="col-md-4">
                            <input type="submit" name="delete" value="Remove" class="btn btn-danger btn-block">
                        </div>
                        <div class="col-md-4">
                            <input type="submit" name="update" value="Modify" class="btn btn-warning btn-block">
                        </div>
                    </div>
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
