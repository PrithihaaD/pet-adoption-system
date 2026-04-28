<?php
session_start();
include '../db_connect.php';

if($_SESSION['role'] != 'vet'){
    header("Location: ../login.html");
}

$appointment_id = $_GET['appointment_id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Treatment</title>

<style>
body {
    margin:0;
    font-family: 'Segoe UI', Arial;
    background: linear-gradient(135deg, #2c7be5, #20c997);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* CONTAINER CARD */
.container {
    width:400px;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
    animation:fadeIn 0.5s ease-in-out;
}

/* TITLE */
h2 {
    text-align:center;
    margin-bottom:20px;
    color:#333;
}

/* INPUTS */
input, textarea {
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:8px;
    border:1px solid #ccc;
    outline:none;
    transition:0.3s;
    font-size:14px;
}

input:focus, textarea:focus {
    border-color:#20c997;
    box-shadow:0 0 6px rgba(32,201,151,0.5);
}

/* BUTTON */
button {
    width:100%;
    padding:12px;
    background: linear-gradient(135deg, #20c997, #28a745);
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

button:hover {
    transform:scale(1.03);
    box-shadow:0 6px 15px rgba(0,0,0,0.2);
}

/* ANIMATION */
@keyframes fadeIn {
    from {opacity:0; transform:translateY(20px);}
    to {opacity:1; transform:translateY(0);}
}
</style>
</head>

<body>

<div class="container">

<h2>Add Treatment 🩺</h2>

<form action="save_treatment.php" method="POST">

<input type="hidden" name="appointment_id" value="<?= $appointment_id ?>">

<input type="text" name="diagnosis" placeholder="Diagnosis" required>

<textarea name="treatment" placeholder="Treatment" required></textarea>

<textarea name="notes" placeholder="Notes"></textarea>

<button type="submit">Save Treatment</button>

</form>

</div>

</body>
</html>