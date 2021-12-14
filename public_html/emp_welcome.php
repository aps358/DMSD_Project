<?php

include_once 'conf/conf.php';
global $db;
global $path;

session_start();
if(isset($_SESSION['username'])){
    $uname = $_SESSION['username'];
}
else{
    $uname = "emp1";
}



$acc_no = $ssn = $first_name = $last_name = $apt_no = $street_no = $city = $zip_code = $state = "";

$new_acc = "";

function Fillcustomeracc()
{
    global $db, $new_acc;

    $q1 = "SELECT acc_no FROM customer WHERE flag='new' ORDER BY acc_no DESC LIMIT 1;";
    $result = $db->query($q1) or die(mysqli_error($db));
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $old_acc = $row["acc_no"];
            //echo "<script>alert(".$old_acc.")</script>";
        }
    } else {
        $old_acc = 0;
    }

    $new_acc = $old_acc + 1;
}


Fillcustomeracc();


//echo "<script> alert(" . $new_acc . ")</script>";

if (isset($_POST['insert'])) {
    $flag = 'new';
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

        $acc_type = mysqli_real_escape_string($db, htmlspecialchars($_POST['acc_type']));
        //echo "<script>alert(".$acc_type.")</script>";
        $int_rate = "";
        $myDate = date('m/d/Y');
        //echo "<script>alert('".$acc_type."')</script>";
        if ($ssn == "" or $acc_no == "") {
            $msg = "Blank Data Not Allowed";
        } else {

            $cust_uname = strtolower($first_name) . strtolower($last_name) . substr($ssn,-1,2);

            $q1 = "INSERT INTO customer " . "(ssn, acc_no, first_name, last_name, apt_no, street_no, city, zip_code, state, flag, uname, upass, acc_type) " . "VALUES('$ssn', '$new_acc', '$first_name', '$last_name', '$apt_no', '$street_no', '$city', '$zip_code', '$state', '$flag', '$cust_uname', '$cust_uname', '$acc_type');";
            $retrieve1 = $db->query($q1) or die(mysqli_error($db));
            //echo $retrieve1;

            if($acc_type == "sav_acc"){
                $int_rate = "0.5";
            }
            elseif($acc_type == "chk_acc"){
                $int_rate = "0.1";
            }
            elseif($acc_type == "mm_acc"){
                $int_rate = "0.3";
            }else{
                $int_rate = "0.2";
            }

            $q2 = "INSERT INTO account " . "(acc_no, acc_type, cust_id, last_transaction_date, balance, trans_no, int_rate, flag, uname) " . "VALUES('$new_acc', '$acc_type', '$ssn','$myDate', '500', '1', '$int_rate','$flag','$uname')";
            $retrieve2 = $db->query($q2) or die(mysqli_error($db));

            $q3 = "INSERT INTO login " . "(type, username, password) " . "VALUES('customer','$cust_uname', '$cust_uname');";
            $retrieve3 = $db->query($q3) or die(mysqli_error($db));
            if($retrieve1 and $retrieve2){
                echo "<script>alert('Insertion Successful !!!')</script>";
            }
            mysqli_close($db);
        }
    }
}

if (isset($_POST['update'])) {
    $flag = 'new';
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
        $acc_type = mysqli_real_escape_string($db, htmlspecialchars($_POST['acc_type']));


        if ($ssn == "" or $acc_no == "") {
            $msg = "Blank Data Not Allowed";
        } else {

            $q1 = "UPDATE customer SET ssn = '"."$ssn"."', first_name= '"."$first_name"."', last_name= '"."$last_name"."', apt_no= '"."$apt_no"."', street_no= '"."$street_no"."', city= '"."$city"."', zip_code= '"."$zip_code"."', state= '"."$state"."', flag= '"."$flag"."', acc_type= '"."$acc_type"."'WHERE acc_no='".$acc_no."';";
            $retrieve1 = $db->query($q1) or die(mysqli_error($db));

            //echo $retrieve1;

            if($retrieve1){
                echo "<script>alert('Updation Successful !!!')</script>";
            }
            mysqli_close($db);
        }
    }
}

if (isset($_POST['delete'])) {
    $flag = 'deleted';
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

            $q1 = "UPDATE customer SET flag= '"."$flag"."'WHERE acc_no='".$acc_no."';";
            $retrieve1 = $db->query($q1) or die(mysqli_error($db));

            $q2 = "UPDATE account SET flag= '"."$flag"."'WHERE acc_no='".$acc_no."';";
            $retrieve2 = $db->query($q2) or die(mysqli_error($db));

            //echo $retrieve1;

            if($retrieve1 and $retrieve2){
                echo "<script>alert('Deletion Successful !!!')</script>";
            }
            mysqli_close($db);
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
            <h3>Welcome <?php echo $uname ?></h3>
            <br/><br/>

            <form method="post" autocomplete="off" class="container" id="emp_form">
                <label for="SSN" class="col-sm-2 lb-lg">Account No:</label>
                <div class="col-md-10 col-xs-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="acc_no" id="acc_no" required="required"
                               value="<?php echo $new_acc; ?>" onblur="get_cust_data()">
                    </div>
                </div>

                <label for="Acc_type" class="col-sm-2 lb-lg">Acc Type:</label>
                <div class="col-md-10 col-xs-10">
                    <div class="form-group text-justify">

                        <label class="radio-inline">
                            <input type="radio" value="sav_acc" name="acc_type" checked>Saving
                        </label>
                        <label class="radio-inline">
                            <input type="radio" value="chk_acc" name="acc_type">Checking
                        </label>
                        <label class="radio-inline">
                            <input type="radio" value="mm_acc" name="acc_type">Money Market
                        </label>
                        <label class="radio-inline">
                            <input type="radio" value="loan_acc" name="acc_type">Loan
                        </label>

                    </div>
                </div>

                <label for="SSN" class="col-sm-2 lb-lg">SSN:</label>
                <div class="col-md-10 col-xs-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="ssn" id="ssn" placeholder="SSN"
                               required="required">
                    </div>
                </div>


                <label for="first_name" class="col-sm-2 lb-lg">First Name:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               placeholder="First Name"
                               required="required">
                    </div>
                </div>

                <label for="last_name" class="col-sm-2 lb-lg">Last Name:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"
                               required="required">
                    </div>
                </div>


                <label for="apt_no" class="col-sm-2 lb-lg">Apt. No.:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" id="apt_no" name="apt_no" placeholder="Apt No."
                               required="required">
                    </div>
                </div>


                <label for="street_no" class="col-sm-2 lb-lg">Street No.:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" id="street_no" name="street_no" placeholder="Street No."
                               required="required">
                    </div>
                </div>


                <label for="city" class="col-sm-2 lb-lg">City:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" id="city" name="city" placeholder="City"
                               required="required">
                    </div>
                </div>

                <label for="zip" class="col-sm-2 lb-lg">Zip:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code"
                               required="required">
                    </div>
                </div>

                <label for="state" class="col-sm-2 lb-lg">State:</label>
                <div class="col-md-10 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" id="state" name="state" placeholder="State"
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

<script type="text/javascript">
    window.onbeforeunload =
        function(){
            <?php Fillcustomeracc();?>
        };

    function get_cust_data() {
        var acc_no = document.getElementById('acc_no').value;
        //alert(acc_no);
        if (acc_no.value != "") {
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var value = xmlhttp.responseText;
                    //alert(value);
                    var ts = value.split('|');
                    if (ts.length > 1) {
                        var acc_no = ts[1];
                        var ssn = ts[0];
                        var first_name = ts[2];
                        var last_name = ts[3];
                        var apt_no = ts[4];
                        var street_no = ts[5];
                        var city = ts[6];
                        var zip_code = ts[7];
                        var state = ts[8];


                        document.getElementById("ssn").value = ssn;
                        document.getElementById("first_name").value = first_name;
                        document.getElementById("last_name").value = last_name;
                        document.getElementById("apt_no").value = apt_no;
                        document.getElementById("street_no").value = street_no;
                        document.getElementById("city").value = city;
                        document.getElementById("zip_code").value = zip_code;
                        document.getElementById("state").value = state;


                    }
                }
            }
            xmlhttp.open("GET", "getcustdata.php?q=" + acc_no, true);
            xmlhttp.send();
        }
    }

</script>

</body>
</html>
