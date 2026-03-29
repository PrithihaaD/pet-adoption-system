<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pet_system");

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    die("Please fill all fields");
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();   // ⭐ VERY IMPORTANT

    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['role'] = $row['role'];
    if($row['role']=='staff'){
    	header("Location: staff/dashboard.php");
    }else{
        header("Location:adopter/dashboard.php");
    }
    exit();

}else {
    echo "Invalid Login";
}
?>