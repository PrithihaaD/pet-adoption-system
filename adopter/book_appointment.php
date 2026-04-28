<?php  
session_start();  
include '../db_connect.php';  

$user_id = $_SESSION['user_id'];  

// Fetch ONLY adopted pets  
$pets = $conn->query("  
SELECT p.pet_id, p.name   
FROM pet p  
JOIN adoption a ON p.pet_id = a.pet_id  
WHERE a.adopter_id = '$user_id' AND a.status='Approved'  
");  
?>

<!DOCTYPE html>  
<html>  
<head>  
    <title>Book Appointment</title>  

<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f7fb;
    margin: 0;
}

/* NAVBAR */
.navbar {
    background: #00b894;
    padding: 15px 30px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 18px;
    font-weight: bold;
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

/* HEADER */
.header {
    background: linear-gradient(135deg, #00b894, #00cec9);
    color: white;
    text-align: center;
    padding: 25px;
    font-size: 24px;
    font-weight: bold;
}

/* CARD */
.container {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.card {
    background: white;
    padding: 30px;
    border-radius: 12px;
    width: 420px;
    box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    font-weight: bold;
}

select, input, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

textarea {
    resize: none;
}

button {
    width: 100%;
    padding: 12px;
    background: #00b894;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
}

button:hover {
    background: #019875;
}
</style>

</head>  

<body>  

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">🐾 Pet Adoption System</div>

    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="my_appointments.php">My Appointments</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<!-- HEADER -->
<div class="header">
    🩺 Book Appointment for Your Pet
</div>

<div class="container">  
<div class="card">  

<h2>Appointment Form</h2>  

<form action="save_appointment.php" method="POST">  

<label>Select Type:</label>  
<select name="type" onchange="toggleFields(this.value)">  
    <option value="adopted">Adopted Pet</option>  
    <option value="new">New Pet</option>  
</select>  

<!-- Adopted -->
<div id="adopted">  
    <label>Pet:</label>  
    <select name="pet_id">  
        <?php while($row = $pets->fetch_assoc()) { ?>  
            <option value="<?= $row['pet_id']; ?>">  
                <?= $row['name']; ?>  
            </option>  
        <?php } ?>  
    </select>  
</div>  

<!-- New -->
<div id="new" style="display:none;">  
    <label>Owner Name:</label>  
    <input type="text" name="owner_name">  

    <label>Pet Name:</label>  
    <input type="text" name="pet_name">  
</div>  

<label>Date:</label>  
<input type="date" name="appointment_date" required>  

<label>Time:</label>  
<input type="time" name="appointment_time" required>  

<label>Problem:</label>  
<textarea name="problem" rows="3" required></textarea>  

<button type="submit">Book Appointment</button>  

</form>  

</div>  
</div>  

<script>  
function toggleFields(val){  
    if(val === "new"){  
        document.getElementById("new").style.display = "block";  
        document.getElementById("adopted").style.display = "none";  
    } else {  
        document.getElementById("new").style.display = "none";  
        document.getElementById("adopted").style.display = "block";  
    }  
}  
</script>  

</body>  
</html>