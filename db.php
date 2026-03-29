<?php
$conn = new mysqli("localhost", "root", "", "pet_system");

if ($conn->connect_error) {
    die("Connection failed");
}
?>