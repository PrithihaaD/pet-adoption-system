<?php
include '../db_connect.php';

$appointment_id = $_POST['appointment_id'];
$diagnosis = $_POST['diagnosis'];
$treatment = $_POST['treatment'];
$notes = $_POST['notes'];

$conn->query("
INSERT INTO treatment (appointment_id, diagnosis, treatment, notes)
VALUES ('$appointment_id','$diagnosis','$treatment','$notes')
");

header("Location: add_medication.php?appointment_id=$appointment_id");
?>