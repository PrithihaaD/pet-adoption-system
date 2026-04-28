<?php
session_start();
include '../db_connect.php';

if($_SESSION['role'] != 'vet'){
    header("Location: ../login.html");
}

$result = $conn->query("SELECT * FROM appointments WHERE status='Approved'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Appointments</title>

<style>
body { font-family: Arial; background:#f4f7fb; }

.card {
    background:white;
    margin:20px;
    padding:15px;
    border-radius:10px;
    box-shadow:0px 4px 10px rgba(0,0,0,0.1);
}
button {
    background:#00b894;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:5px;
}
</style>

</head>

<body>

<h2 style="text-align:center;">Approved Appointments</h2>

<?php while($row = $result->fetch_assoc()) { ?>

<div class="card">
    <p><b>Pet:</b> <?= $row['pet_name']; ?></p>
    <p><b>Date:</b> <?= $row['appointment_date']; ?></p>
    <p><b>Time:</b> <?= $row['appointment_time']; ?></p>

    <button onclick="location.href='add_treatment.php?appointment_id=<?= $row['id']; ?>'">
        Add Treatment
    </button>
</div>

<?php } ?>

</body>
</html>