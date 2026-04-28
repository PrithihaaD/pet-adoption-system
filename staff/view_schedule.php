<?php
session_start();
include '../db_connect.php';

/* CHECK STAFF LOGIN */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: ../login.html");
    exit();
}

/* FETCH ONLY VET AVAILABILITY */
$schedule = $conn->query("
SELECT u.username, vs.available_date, vs.start_time, vs.end_time
FROM vet_schedule vs
JOIN users u ON vs.vet_id = u.user_id
WHERE u.role='vet'
ORDER BY vs.available_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Vet Availability</title>

<style>
body {
    font-family: Arial;
    background:#f4f6f9;
    margin:0;
}

/* HEADER */
.topbar {
    background:#2c7be5;
    color:white;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
}

/* CONTAINER */
.container {
    width:80%;
    margin:40px auto;
}

/* TABLE */
table {
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
}

th, td {
    padding:12px;
    border-bottom:1px solid #eee;
    text-align:center;
}

th {
    background:#2c7be5;
    color:white;
}

tr:hover {
    background:#f1f1f1;
}

h2 {
    text-align:center;
}
</style>

</head>

<body>

<div class="topbar">
    <h2>📅 Vet Availability</h2>
    <a href="dashboard.php" style="color:white;">⬅ Dashboard</a>
</div>

<div class="container">

<h2>Available Schedule</h2>

<table>
<tr>
    <th>Vet Name</th>
    <th>Date</th>
    <th>Time</th>
</tr>

<?php if($schedule->num_rows == 0){ ?>
<tr>
    <td colspan="3">No availability found</td>
</tr>
<?php } ?>

<?php while($row = $schedule->fetch_assoc()) { ?>
<tr>
    <td><?= $row['username'] ?></td>
    <td><?= $row['available_date'] ?></td>
    <td><?= $row['start_time'] ?> - <?= $row['end_time'] ?></td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>