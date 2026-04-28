<?php
session_start();
include '../db_connect.php';

$vet_id = $_SESSION['user_id'];

/* ADD SCHEDULE */
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $date = $_POST['date'];
    $start = $_POST['start_time'];
    $end = $_POST['end_time'];

    $conn->query("
    INSERT INTO vet_schedule (vet_id, available_date, start_time, end_time)
    VALUES ('$vet_id','$date','$start','$end')
    ");
}

/* GET SCHEDULE */
$schedule = $conn->query("
SELECT * FROM vet_schedule 
WHERE vet_id='$vet_id'
ORDER BY available_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Schedule</title>

<style>
body {
    font-family: Arial;
    margin: 0;
    background: #f4f6f9;
}

.navbar {
    background: #00bfa5;
    padding: 15px 30px;
    color: white;
    display: flex;
    justify-content: space-between;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
    font-weight: bold;
}

h2 {
    text-align: center;
    margin-top: 20px;
}

form {
    text-align: center;
    margin-bottom: 20px;
}

input, button {
    padding: 8px;
    margin: 5px;
}

table {
    margin: auto;
    border-collapse: collapse;
    background: white;
}

th {
    background: #00bfa5;
    color: white;
}

td, th {
    padding: 10px;
}
</style>

</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div>🩺 Vet Panel</div>
    <div>
        <a href="dashboard.php">Home</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<h2>📅 Manage My Availability</h2>

<!-- FORM -->
<form method="POST">
    <input type="date" name="date" required>
    <input type="time" name="start_time" required>
    <input type="time" name="end_time" required>
    <button type="submit">Add Schedule</button>
</form>

<!-- TABLE -->
<table border="1">
<tr>
    <th>Date</th>
    <th>Time</th>
    <th>Action</th>
</tr>

<?php while($row = $schedule->fetch_assoc()) { ?>
<tr>
    <td><?= $row['available_date'] ?></td>
    <td><?= $row['start_time'] ?> - <?= $row['end_time'] ?></td>
    <td>
        <a href="edit_schedule.php?id=<?= $row['schedule_id'] ?>">Edit</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>