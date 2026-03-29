<?php
session_start();
include (__DIR__."/../db.php");

/* CHECK LOGIN */
if (!isset($_SESSION['user_id'])) {
    die("Please login first");
}

$pet_id = $_GET['pet_id'];
$user_id = $_SESSION['user_id'];

$conn->query("INSERT INTO adoption (adopter_id, pet_id, status)
VALUES ('$user_id', '$pet_id', 'Pending')");


echo "Request Sent";
?>