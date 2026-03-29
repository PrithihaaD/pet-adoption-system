<?php
include "../db.php";

$id = $_GET['id'];
$status = $_GET['status'];

if($status == "Approved"){
    $date = date('Y-m-d', strtotime('+1 day'));

    $conn->query("UPDATE adoption 
    SET status='Approved', collection_date='$date'
    WHERE adoption_id='$id'");
}
else{
    $conn->query("UPDATE adoption 
    SET status='Rejected'
    WHERE adoption_id='$id'");
}

header("Location: manage_requests.php");
exit();
?>