<?php
include '../db_connect.php';

// APPROVE
if(isset($_GET['status'])){
    $id = $_GET['id'];
    $status = $_GET['status'];

    $conn->query("
        UPDATE appointments 
        SET status='$status', reason=NULL, new_date=NULL, new_time=NULL
        WHERE id='$id'
    ");

    header("Location: manage_appointments.php");
}

// REJECT
if(isset($_POST['reject'])){
    $id = $_POST['id'];
    $reason = $_POST['reason'];
    $new_date = $_POST['new_date'];
    $new_time = $_POST['new_time'];

    $conn->query("
        UPDATE appointments 
        SET status='Rejected',
            reason='$reason',
            new_date='$new_date',
            new_time='$new_time'
        WHERE id='$id'
    ");

    header("Location: manage_appointments.php");
}
?>