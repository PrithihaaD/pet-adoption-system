<?php
include '../db_connect.php';

$appointment_id = $_GET['appointment_id'];

$t = $conn->query("SELECT treatment_id FROM treatment WHERE appointment_id='$appointment_id'")->fetch_assoc();
$treatment_id = $t['treatment_id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Medication</title>
</head>
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

/* CARD */
.container {
    width:350px;
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
input {
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:8px;
    border:1px solid #ccc;
    outline:none;
    transition:0.3s;
    font-size:14px;
}

input:focus {
    border-color:#20c997;
    box-shadow:0 0 6px rgba(32,201,151,0.5);
}

/* BUTTON */
button {
    width:100%;
    padding:12px;
    background: linear-gradient(135deg, #ff7e5f, #ff3f34);
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

button:hover {
    transform:scale(1.05);
    box-shadow:0 6px 15px rgba(0,0,0,0.2);
}

/* ANIMATION */
@keyframes fadeIn {
    from {opacity:0; transform:translateY(20px);}
    to {opacity:1; transform:translateY(0);}
}
</style>

<body>

<h2>Add Medication 💊</h2>

<form action="save_medication.php" method="POST">

<input type="hidden" name="treatment_id" value="<?= $treatment_id ?>">

<input type="text" name="medicine_name" placeholder="Medicine Name" required><br><br>

<input type="text" name="dosage" placeholder="Dosage" required><br><br>

<input type="text" name="duration" placeholder="Duration" required><br><br>

<button type="submit">Add Medicine</button>

</form>

</body>
</html>