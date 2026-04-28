<?php
include '../db_connect.php';

$treatment_id = $_POST['treatment_id'];
$medicine = $_POST['medicine_name'];
$dosage = $_POST['dosage'];
$duration = $_POST['duration'];

$conn->query("
INSERT INTO medication (treatment_id, medicine_name, dosage, duration)
VALUES ('$treatment_id','$medicine','$dosage','$duration')
");

echo "<script>alert('Medication Added'); window.location.href='view_appointments.php';</script>";
?>