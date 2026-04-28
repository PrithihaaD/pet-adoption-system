<?php
session_start();
include '../db_connect.php';

$user_id = $_SESSION['user_id'];

$result = $conn->query("
SELECT * FROM appointments 
WHERE user_id='$user_id'
ORDER BY appointment_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Appointments</title>

<style>
body {
    font-family: Arial;
    margin: 0;
    background: #f4f6f9;
}

/* NAVBAR */
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
}

/* CONTAINER */
.container {
    width: 85%;
    margin: 40px auto;
}

/* TITLE */
h2 {
    text-align: center;
    margin-bottom: 25px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
}

th {
    background: #00bfa5;
    color: white;
    padding: 12px;
}

td {
    padding: 12px;
    text-align: center;
}

tr:nth-child(even) {
    background: #f9f9f9;
}

/* STATUS COLORS */
.status {
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: bold;
}

.pending {
    background: #fff3cd;
    color: #856404;
}

.approved {
    background: #d4edda;
    color: #155724;
}

.rejected {
    background: #f8d7da;
    color: #721c24;
}
</style>

</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div>🐾 Pet Adoption System</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="book_appointment.php">Book Appointment</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<!-- CONTENT -->
<div class="container">

<h2>My Appointments 📋</h2>

<table>
<tr>
    <th>Pet Name</th>
    <th>Date</th>
    <th>Time</th>
    <th>Problem</th>
    <th>Status</th>
    <th>Reason for rejection</th>
    <th>Updated Date & Time</th>
</tr>

<?php while($row = $result->fetch_assoc()) { 
    $status = strtolower($row['status']);
?>

<tr>
    <td><?= $row['pet_name']; ?></td>
    <td><?= $row['appointment_date']; ?></td>
    <td><?= $row['appointment_time']; ?></td>
    <td><?= $row['problem']; ?></td>
    <td>
        <span class="status <?= $status ?>">
            <?= $row['status']; ?>
        </span>
    </td>
    <!-- REASON -->
    <td>
        <?php 
        if($row['status'] == 'Rejected'){
            echo $row['reason'] ? $row['reason'] : 'No reason';
        } else {
            echo '-';
        }
        ?>
    </td>

    <!-- RESCHEDULE -->
    <td>
        <?php 
        if($row['status'] == 'Rejected'){
            if($row['new_date']){
		echo $row['new_date'] . "<br>" . $row['new_time'];
	    } else {
		echo 'Not given';
	    } 
        }else {
            echo '-';
        }
        ?>
    </td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>