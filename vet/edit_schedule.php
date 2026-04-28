<?php
include '../db_connect.php';

$id = $_GET['id'];

$data = $conn->query("
SELECT * FROM vet_schedule 
WHERE schedule_id='$id'
")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Schedule</title>
</head>

<body>

<h2>Edit Schedule</h2>

<form action="update_schedule.php" method="POST">

<input type="hidden" name="id" value="<?= $id ?>">

<input type="date" name="date" value="<?= $data['available_date'] ?>" required>

<input type="time" name="start" value="<?= $data['start_time'] ?>" required>

<input type="time" name="end" value="<?= $data['end_time'] ?>" required>

<button type="submit">Update</button>

</form>

</body>
</html>