<?php
$conn = new mysqli("localhost", "root", "", "pet_system");

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role=$_POST['role'];

/* INSERT INTO USERS */
$conn->query("INSERT INTO users (username, password, role, email)
VALUES ('$username', '$password', '$role','$email')");

/* GET LAST INSERTED USER ID */
$user_id = $conn->insert_id;

if($role=='adopter'){
	$conn->query("INSERT INTO adopter (adopter_id, name, email)
	VALUES ('$user_id', '$username', '$email')");
}
/* REDIRECT */
header("Location: login.html?success=1");
exit();
?>