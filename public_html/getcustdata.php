<?php
session_start();
include_once 'conf/conf.php';
global $db;
global $path;

$q = $_GET['q'];
//echo $q;
$flag = 'new';
$sql = "select ssn, acc_no, first_name, last_name, apt_no, street_no, city, zip_code, state, flag, acc_type from customer where flag='".$flag."' and acc_no = '" . $q . "';";
//echo $sql;
$cnt = 0;
$result = $db->query($sql) or die(mysqli_error($db));
if ($result) {
    $tt = 0;
    // Cycle through results
    while ($rowsys = $result->fetch_array()) {

        $user_arrsys[] = $rowsys;
        $tt++;
    }
    // Free result set
    $result->close();
    $db->next_result();
    if ($tt != 0) {

        foreach ($user_arrsys as $user_arrsys) {
            $mycustdata = $user_arrsys['ssn'] . "|" . $user_arrsys['acc_no'] . "|" . $user_arrsys['first_name'] . "|" . $user_arrsys['last_name'] . "|" . $user_arrsys['apt_no'] . "|" . $user_arrsys['street_no'] . "|" . $user_arrsys['city'] . "|" . $user_arrsys['zip_code'] . "|" . $user_arrsys['state']. "|" . $user_arrsys['acc_type'];
        }
    } else {
        $mycustdata = "N/A";
    }
    echo $mycustdata;
    mysqli_close($db);
}
?>
