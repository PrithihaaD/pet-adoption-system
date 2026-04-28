<?php
include '../db_connect.php';

$id = $_POST['id'];
$date = $_POST['date'];
$start = $_POST['start'];
$end = $_POST['end'];

$conn->query("
UPDATE vet_schedule 
SET available_date='$date',
    start_time='$start',
    end_time='$end'
WHERE schedule_id='$id'
");

header("Location: manage_schedule.php");
exit();
?>