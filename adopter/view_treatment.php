<?php
session_start();
include '../db_connect.php';

$user_id = $_SESSION['user_id'];

$result = $conn->query("
SELECT t.*, a.pet_name 
FROM treatment t
JOIN appointments a ON t.appointment_id = a.appointment_id
WHERE a.user_id='$user_id'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Treatment</title>
</head>

<body>

<h2>My Pet Treatment 🩺</h2>

<?php while($row = $result->fetch_assoc()) { ?>

<div style="border:1px solid #ccc; padding:15px; margin:10px;">

<p><b>Pet:</b> <?= $row['pet_name']; ?></p>
<p><b>Diagnosis:</b> <?= $row['diagnosis']; ?></p>
<p><b>Treatment:</b> <?= $row['treatment_id']; ?></p>
<p><b>Notes:</b> <?= $row['notes']; ?></p>

<h4>Medicines:</h4>

<?php
$med = $conn->query("SELECT * FROM medication WHERE treatment_id='".$row['id']."'");
while($m = $med->fetch_assoc()) {
    echo "<p>".$m['medicine_name']." - ".$m['dosage']." (".$m['duration'].")</p>";
}
?>

</div>

<?php } ?>

</body>
</html>