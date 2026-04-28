<?php
session_start();
include '../db_connect.php';

/* ONLY FETCH DATA - NO INSERT */
$schedule = $conn->query("
SELECT vs.*, u.username 
FROM vet_schedule vs
JOIN users u ON vs.vet_id = u.user_id
ORDER BY available_date DESC
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

/* NAVBAR */
.navbar {
    background:#00b894;
    color:white;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
}

.navbar a {
    color:white;
    text-decoration:none;
    margin-left:20px;
}

/* CONTAINER */
.container {
    width:80%;
    margin:40px auto;
}

/* CARD */
.card {
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

/* TABLE */
table {
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

th, td {
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

th {
    background:#00b894;
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

<!-- NAVBAR -->
<div class="navbar">
    <div>🐾 Staff Panel</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<!-- CONTENT -->
<div class="container">

<h2>📅 Vet Availability</h2>

<div class="card">

<table>
<tr>
    <th>Vet Name</th>
    <th>Date</th>
    <th>Time</th>
</tr>

<?php if($schedule->num_rows == 0){ ?>
<tr>
    <td colspan="3">No schedules available</td>
</tr>
<?php } ?>

<?php while($row = $schedule->fetch_assoc()) { ?>
<tr>
    <td><?= $row['username']; ?></td>
    <td><?= $row['available_date']; ?></td>
    <td><?= $row['start_time']; ?> - <?= $row['end_time']; ?></td>
</tr>
<?php } ?>

</table>

</div>

</div>

</body>
</html>