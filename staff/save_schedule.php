<?php
include '../db_connect.php';

$vet_id = $_POST['vet_id'];
$date = $_POST['date'];
$start = $_POST['start_time'];
$end = $_POST['end_time'];

$conn->query("
INSERT INTO vet_schedule (vet_id, available_date, start_time, end_time)
VALUES ('$vet_id','$date','$start','$end')
");

header("Location: manage_schedule.php");
?>