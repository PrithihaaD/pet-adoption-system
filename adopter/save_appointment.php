<?php
session_start();
include '../db_connect.php';

$user_id = $_SESSION['user_id'];
$type = $_POST['type'];

$date = $_POST['appointment_date'];
$time = $_POST['appointment_time'];
$problem = $_POST['problem'];

if($type == "adopted"){

    $pet_id = $_POST['pet_id'];

    $sql = "INSERT INTO appointments 
    (user_id, pet_id, appointment_date, appointment_time, problem, is_external)
    VALUES ('$user_id', '$pet_id', '$date', '$time', '$problem', 0)";

} else {

    $pet_name = $_POST['pet_name'];
    $owner_name = $_POST['owner_name'];

    $sql = "INSERT INTO appointments 
    (user_id, pet_name, owner_name, appointment_date, appointment_time, problem, is_external)
    VALUES ('$user_id', '$pet_name', '$owner_name', '$date', '$time', '$problem', 1)";
}

if ($conn->query($sql)) {
    echo "<script>alert('Appointment Booked Successfully'); window.location='book_appointment.php';</script>";
} else {
    echo "Error: " . $conn->error;
}
?>