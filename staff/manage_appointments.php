<?php
session_start();
include '../db_connect.php';

$result = $conn->query("SELECT * FROM appointments ORDER BY appointment_date DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Appointments</title>

<style>
body {
    font-family: Arial;
    margin: 0;
    background: #f4f7fb;
}

/* HEADER */
.header {
    background: linear-gradient(135deg, #00b894, #00cec9);
    color: white;
    text-align: center;
    padding: 25px;
    font-size: 22px;
    font-weight: bold;
}

/* CONTAINER */
.container {
    width: 85%;
    margin: 30px auto;
}

/* CARD */
.card {
    background: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
}

/* TEXT */
.card p {
    margin: 8px 0;
}

/* STATUS */
.status {
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 20px;
}

.rejected {
    background: #f8d7da;
    color: #721c24;
}

.approved {
    background: #d4edda;
    color: #155724;
}

.pending {
    background: #fff3cd;
    color: #856404;
}

/* BUTTONS */
.btn {
    padding: 8px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin-right: 10px;
}

.approve {
    background: #00b894;
    color: white;
}

.reject {
    background: #d63031;
    color: white;
}

.btn:hover {
    opacity: 0.8;
}

/* REJECT BOX */
#rejectBox {
    display: none;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
    position: fixed;
    top: 30%;
    left: 35%;
    width: 300px;
}

/* INPUTS */
textarea, input {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
.navbar {
    background: linear-gradient(135deg, #00b894, #00cec9);
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
}

.logo {
    font-weight: bold;
    font-size: 18px;
}

.nav-links a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
    font-weight: bold;
}

.nav-links a:hover {
    text-decoration: underline;
}
</style>

</head>

<body>
<div class="navbar">
        <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="header">
    🩺 Manage Appointments
</div>

<div class="container">

<?php while($row = $result->fetch_assoc()) { 
    $status = strtolower($row['status']);
?>

<div class="card">

    <p><b>Pet:</b> <?= $row['pet_name']; ?></p>
    <p><b>Date:</b> <?= $row['appointment_date']; ?></p>
    <p><b>Time:</b> <?= $row['appointment_time']; ?></p>
    <p><b>Problem:</b> <?= $row['problem']; ?></p>

    <p>
        <b>Status:</b> 
        <span class="status <?= $status ?>">
            <?= $row['status']; ?>
        </span>
    </p>

    <!-- BUTTONS -->
    <button class="btn approve"
        onclick="window.location.href='update_appointment.php?id=<?= $row['id']; ?>&status=Approved'">
        Approve
    </button>

    <button class="btn reject"
        onclick="openReject(<?= $row['id']; ?>)">
        Reject
    </button>

</div>

<?php } ?>

</div>

<!-- REJECT POPUP -->
<div id="rejectBox">
    <form method="POST" action="update_appointment.php">
        <input type="hidden" name="id" id="reject_id">

        <b>Reason:</b>
        <textarea name="reason" required></textarea>

        <b>New Date:</b>
        <input type="date" name="new_date" required>

        <b>New Time:</b>
        <input type="time" name="new_time" required>

        <button class="btn reject" type="submit" name="reject">Submit</button>
    </form>
</div>

<script>
function openReject(id){
    document.getElementById("rejectBox").style.display = "block";
    document.getElementById("reject_id").value = id;
}
</script>

</body>
</html>