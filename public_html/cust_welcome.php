<?php

include_once 'conf/conf.php';
global $db;
global $path;
session_start();
//echo "<script>alert('".$_SESSION['username']."')</script>";
if (isset($_SESSION['username'])) {
    $uname = $_SESSION['username'];
} else {
    $uname = "ameysawant11";
}

$firstname = $lastname = $ssn = $acc_no = $getinfo = "";

//FUNCTION FOR GETUSER INFO 1ST BOX
function getuserinfo($uname, $db)
{
    $firstname = $lastname = $ssn = $acc_no = "";
    $getinfo = "select ssn, acc_no, first_name, last_name from customer where uname ='" . $uname . "';";
    $result = $db->query($getinfo) or die(mysqli_error($db));
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $firstname = $row['first_name'];
            $lastname = $row['last_name'];
            $ssn = $row['ssn'];
            $acc_no = $row['acc_no'];
        }
    }

    return [$firstname, $lastname, $ssn, $acc_no];
}

$arr = getuserinfo($uname, $db);
$firstname = $arr[0];
$lastname = $arr[1];
$ssn = $arr[2];
$acc_no = $arr[3];


if (isset($_POST['cheq_deposit'])) {
    $sen_acc = $_POST['send_acc_no'];
    $rec_acc = $_POST['rec_acc_no'];
    $amo = $_POST['amount'];
    $send_bal_q = "select balance from account where acc_no ='" . $sen_acc . "';";
    $result = $db->query($send_bal_q) or die(mysqli_error($db));
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $sen_bal = $row['balance'];
        }
    } else {
        echo "0 results";
    }
    //echo "<script>alert(". $sen_bal .")</script>";
    $rec_bal_q = "select balance from account where acc_no ='" . $rec_acc . "';";
    $result = $db->query($rec_bal_q) or die(mysqli_error($db));
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $rec_bal = $row['balance'];
        }
    } else {
        echo "0 results";
    }
    //echo "<script>alert(". $rec_bal .")</script>";
    if ($sen_bal > $amo) {
        $upd_sen_bal = $sen_bal - $amo;
        //echo "<script>alert(" . $upd_sen_bal . ")</script>";
        $upd_rec_bal = $rec_bal + $amo;
        echo "<script>alert(" . $upd_rec_bal . ")</script>";
        $upd_sen_bal_q = "UPDATE account SET balance = '" . $upd_sen_bal . "' WHERE acc_no = " . $sen_acc . ";";
        $result = $db->query($upd_sen_bal_q) or die(mysqli_error($db));
        $upd_rec_bal_q = "UPDATE account SET balance = '" . $upd_rec_bal . "' WHERE acc_no = " . $rec_acc . ";";
        $result = $db->query($upd_rec_bal_q) or die(mysqli_error($db));
    } else {
        echo '<script>alert("Cheque Bounced")</script>';
    }
}

if (isset($_POST['depo_amo'])) {

    $depo_bal = "select balance from account where uname ='" . $uname . "';";
    $result1 = $db->query($depo_bal) or die(mysqli_error($db));
    if ($result1->num_rows > 0) {
        // output data of each row
        while ($row = $result1->fetch_assoc()) {
            $depo_bal1 = $row['balance'];
        }
    } else {
        echo "0 results";
    }
    $amo1 = $_POST['dep_amount'];
    $upd_sen_bal1 = $depo_bal1 + $amo1;
    $upd_sen_bal_q1 = "UPDATE account SET balance = '" . $upd_sen_bal1 . "' WHERE uname = '" . $uname . "';";
    $result = $db->query($upd_sen_bal_q1) or die(mysqli_error($db));
    echo '<script>alert("Amount Deposited")</script>';

}

if (isset($_POST['with_amo'])) {

    $with_bal = "select balance from account where uname ='" . $uname . "';";
    $result1 = $db->query($with_bal) or die(mysqli_error($db));
    if ($result1->num_rows > 0) {
        // output data of each row
        while ($row = $result1->fetch_assoc()) {
            $with_bal1 = $row['balance'];
        }
    } else {
        echo "0 results";
    }
    $amo2 = $_POST['with_amount'];
    if ($with_bal1 > $amo2) {
        $upd_sen_bal2 = $with_bal1 - $amo2;
        $upd_sen_bal_q2 = "UPDATE account SET balance = '" . $upd_sen_bal2 . "' WHERE uname = '" . $uname . "';";
        $result = $db->query($upd_sen_bal_q2) or die(mysqli_error($db));
        echo '<script>alert("Amount withdrawn")</script>';
    } else {
        echo '<script>alert("Insufficient Balance and you have been charged 2 dollars")</script>';
        $amo3 = 2;
        $upd_sen_bal3 = $with_bal1 - $amo3;
        $upd_sen_bal_q3 = "UPDATE account SET balance = '" . $upd_sen_bal3 . "' WHERE uname = '" . $uname . "';";
        $result = $db->query($upd_sen_bal_q3) or die(mysqli_error($db));
    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Card</title>


    <link href="css/mystyle.css" rel="stylesheet">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            color: #588c7e;
            font-family: monospace;
            font-size: 15px;
            text-align: left;
        }

        th {
            background-color: #588c7e;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }
    </style>

</head>
<body>
<div id="primary_container">
    <!--FIRST BOX-->
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

    <div class="content">
        <div class="container-fluid">
            <br><br>
            <h2 align="center">Customer Welcome Page</h2><br><br>
            <div class="card-deck">
                <div class="card bg-light" style="height: 400px">
                    <div class="card-body">
                        <h3 align="center">Your Details</h3>
                        <br>
                        &nbsp;&nbsp;&nbsp;
                        <label for="account_no">Account No:</label>
                        <label for="account_no"><?php echo $acc_no; ?></label>
                        <br><br>

                        &nbsp;&nbsp;&nbsp;
                        <label for="SSN">SSN:</label>
                        <label for="SSN"><?php echo $ssn; ?></label>
                        <br><br>

                        &nbsp;&nbsp;&nbsp;
                        <label for="first_name">First Name:</label>
                        <label for="first_name"><?php echo $firstname; ?></label>
                        <br><br>

                        &nbsp;&nbsp;&nbsp;
                        <label for="last_name">Last Name:</label>
                        <label for="last_name"><?php echo $lastname; ?></label>
                        <br><br>
                    </div>
                </div>


                <!--SECOND BOX-->

                <div class="card bg-light">

                    <h3 align="center">Cheque Deposit</h3>
                    <div class="card-body">

                        <form method="post">
                            <label for="send_acc_no">Sender's Account No:</label>
                            <input type="text" class="form-control" name="send_acc_no" required="required"
                                   value="<?php $new_acc; ?>">

                            &nbsp;
                            <label for="rec_acc_no">Receiver's Account No:</label>
                            <input type="text" class="form-control" name="rec_acc_no" required="required"
                                   value="<?php $new_acc; ?>">

                            &nbsp;
                            <label for="amount">Amount:</label>
                            <input type="text" class="form-control" name="amount" required="required"
                                   value="<?php $new_acc; ?>">

                            &nbsp;
                            <label for="signature">Signature:</label>
                            <input type="text" class="form-control" name="signature" required="required">

                            <br>

                            <input type="submit" name="cheq_deposit" value="Deposit Cheque"
                                   class="btn btn-success btn-block">
                        </form>

                    </div>
                </div>
            </div>
            <br/>


            <!--THIRD BOX-->
            <div class="card-deck">

                <div class="card bg-light" style="height: 400px">
                    <div class="card-body text-center">
                        <form method="post">
                            <h3>Deposit/Withdraw Money</h3>
                            <label for="amount">Amount to be Deposited:</label>
                            <input type="text" class="form-control" name="dep_amount" value="<?php $new_acc; ?>"><br>
                            <input type="submit" class="btn btn-success" name="depo_amo" value="Deposit amount"><br><br>
                            <label for="amount">Amount to be Withdraw:</label>
                            <input type="text" class="form-control" name="with_amount" value="<?php $new_acc; ?>"><br>
                            <input type="submit" class="btn btn-success" name="with_amo" value="Withdraw amount">
                        </form>
                    </div>
                </div>


                <!--FOURTH BOX-->
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3>Print PassBook</h3>
                        <input type="submit" class="btn btn-success" name="submit" value="Print PassBook">
                        <br><br>
                        <div class="container" style="overflow: scroll">
                            <table class="table">
                                <tr>
                                    <th>Date</th>
                                    <th>Transaction Code</th>
                                    <th>Transaction Name</th>
                                    <th>Debits</th>
                                    <th>Credits</th>
                                    <th>Balance</th>
                                </tr>
                                <?php
                                // Check connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }
                                $sql = "SELECT trans_date, transaction_code,transaction_name, debits, credits, balance FROM transaction;";
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
// output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row["trans_date"] . "</td><td>" . $row["transaction_code"] . "</td><td>" . $row["transaction_name"] . "</td><td>"
                                            . $row["debits"] . "</td><td>" . $row["credits"] . "</td><td>" . $row["balance"] . "</td></tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "0 results";
                                }
                                $db->close();
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
    </div>

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
