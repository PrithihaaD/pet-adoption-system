<?php
session_start();
include '../db_connect.php';

$user_id = $_SESSION['user_id'];

$treatment = $conn->query("
SELECT t.*, a.pet_name 
FROM treatment t
JOIN appointments a ON t.appointment_id = a.id
WHERE a.user_id='$user_id'
ORDER BY t.treatment_id DESC
LIMIT 3
");
if(!isset($_SESSION['username'])){
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">🐾 Pet Adoption System</div>

    <div class="nav-links">
        <a href="#">Home</a>
        <a href="view_status.php">View Status</a>
        <a href="book_appointment.php">Book Appointment</a>
        <a href="my_appointments.php">My Appointments</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<!-- HERO (FULL WIDTH GREEN) -->
<div class="hero">
    <h1>Find Your Perfect Companion</h1>
    <p>Adopt a pet and give them a loving home</p>
</div>

<!-- WELCOME -->
<div class="welcome">
  Welcome, 
  <?php 
  if(isset($_SESSION['username'])){
    echo $_SESSION['username'];
  }else{
    echo "User";
  }
  ?> 👋
</div>

<!-- CATEGORY SECTION (WHITE AREA) -->
<div class="category-section">

    <div class="category-container">

        <!-- DOG -->
        <div class="category-card">
            <a href="search_pets.php?type=Dog">
                <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1">
                <h3>Dogs 🐶</h3>
            </a>
        </div>

        <!-- CAT -->
        <div class="category-card">
            <a href="search_pets.php?type=Cat">
                <img src="https://images.unsplash.com/photo-1518791841217-8f162f1e1131">
                <h3>Cats 🐱</h3>
            </a>
        </div>

        <!-- BIRD -->
        <div class="category-card">
            <a href="search_pets.php?type=Bird">
                <img src="https://images.unsplash.com/photo-1444464666168-49d633b86797">
                <h3>Birds 🐦</h3>
            </a>
        </div>

    </div>
    <!-- APPOINTMENT SECTION -->
    <div style="text-align:center; margin-top:40px;">

    <h2>Veterinary Services 🩺</h2>

    <br>

    <a href="book_appointment.php">
        <button style="padding:12px 25px; background:#00c9a7; color:white; border:none; border-radius:6px;">
            📅 Book Appointment
        </button>
    </a>

    <br><br>

    <a href="my_appointments.php">
        <button style="padding:12px 25px; background:#ff7e5f; color:white; border:none; border-radius:6px;">
            📋 My Appointments
        </button>
    </a>

</div>

</div>
<div style="width:85%; margin:40px auto;">

<h2>🩺 Recent Treatments</h2>

<?php if($treatment->num_rows == 0){ ?>
    <p>No treatment available</p>
<?php } ?>

<?php while($row = $treatment->fetch_assoc()) { ?>

<div style="background:white; padding:15px; margin-bottom:15px; border-radius:10px; box-shadow:0px 4px 10px rgba(0,0,0,0.1);">

<p><b>Pet:</b> <?= $row['pet_name']; ?></p>
<p><b>Diagnosis:</b> <?= $row['diagnosis']; ?></p>
<p><b>Treatment:</b> <?= $row['treatment_id']; ?></p>

<h4>💊 Medicines:</h4>

<?php
$med = $conn->query("
SELECT * FROM medication 
WHERE treatment_id='".$row['treatment_id']."'
");

while($m = $med->fetch_assoc()){
?>
<p>
<?= $m['medicine_name']; ?> - <?= $m['dosage']; ?>
</p>
<?php } ?>

</div>

<?php } ?>

</div>

</body>
</html>