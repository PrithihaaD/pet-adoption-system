<?php
session_start();
include '../db_connect.php';

$appointments = $conn->query("
SELECT * FROM appointments 
WHERE status='Approved'
ORDER BY appointment_date DESC
");

$count = $appointments->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
<title>Vet Dashboard</title>

<style>
body {
    margin:0;
    font-family: Arial;
    background:#f4f6f9;
}

.topbar {
    background:#2c7be5;
    color:white;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
}

.container {
    padding:30px;
}

.cards {
    display:flex;
    gap:20px;
    margin-bottom:30px;
}

.card {
    flex:1;
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

table {
    width:100%;
    border-collapse:collapse;
    background:white;
    margin-top:10px;
    border-radius:10px;
    overflow:hidden;
}

th, td {
    padding:12px;
    border-bottom:1px solid #eee;
}

th {
    background:#2c7be5;
    color:white;
}

.btn {
    padding:8px 12px;
    border:none;
    border-radius:6px;
    color:white;
}

.btn-green { background:#28a745; }
.btn-blue { background:#007bff; }

h3 {
    margin-top:30px;
}
</style>
</head>

<body>

<div class="topbar">
    <h2>👨‍⚕️ Veterinarian Dashboard</h2>
    <a href="../logout.php" style="color:white;">Logout</a>
</div>

<div class="container">

<!-- CARDS -->
<div class="cards">
    <div class="card">
        <h3>Total Approved Appointments</h3>
        <h1><?= $count ?></h1>
    </div>

    <div class="card">
        <h3>Quick Action</h3>
        <p>Manage treatments easily</p>
    </div>
</div>

<!-- ================== MY AVAILABILITY ================== -->
<h3>📅 My Availability</h3>

<a href="manage_schedule.php">
    <button class="btn btn-blue">Manage Schedule</button>
</a>

<table>
<tr>
    <th>Date</th>
    <th>Time</th>
</tr>

<?php
$vet_id = $_SESSION['user_id'];

$schedule = $conn->query("
SELECT * FROM vet_schedule 
WHERE vet_id='$vet_id'
ORDER BY available_date DESC
LIMIT 5
");

while($row = $schedule->fetch_assoc()) {
?>
<tr>
    <td><?= $row['available_date'] ?></td>
    <td><?= $row['start_time'] ?> - <?= $row['end_time'] ?></td>
</tr>
<?php } ?>
</table>

<!-- ================== APPROVED APPOINTMENTS ================== -->
<h3>Approved Appointments</h3>

<table>
<tr>
    <th>Pet</th>
    <th>Date</th>
    <th>Time</th>
    <th>Problem</th>
    <th>Action</th>
</tr>

<?php while($row = $appointments->fetch_assoc()) { ?>
<tr>
    <td><?= $row['pet_name'] ?></td>
    <td><?= $row['appointment_date'] ?></td>
    <td><?= $row['appointment_time'] ?></td>
    <td><?= $row['problem'] ?></td>
    <td>
        <a href="add_treatment.php?appointment_id=<?= $row['id'] ?>">
            <button class="btn btn-green">Add Treatment</button>
        </a>
    </td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>