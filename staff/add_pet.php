<?php
session_start();
include "../db.php";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $health_status=$_POST['health_status'];
    $shelter_id = $_POST['shelter_id'];

    $conn->query("INSERT INTO pet (name, species, breed, gender, age,health_status, shelter_id)
    VALUES ('$name','$species','$breed','$gender','$age','$health_status','$shelter_id')");

    $success = "Pet Added Successfully ✅";
}
?>

<link rel="stylesheet" href="../style.css">

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">🐾 Staff Panel</div>
    <div class="nav-links">
        <a href="dashboard.php">Home</a>
        <a href="manage_requests.php">Requests</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<!-- HERO -->
<div class="hero">
    <h1>Add New Pet</h1>
    <p>Enter pet details below</p>
</div>

<!-- FORM -->
<div class="container">
    <div class="card">

        <?php if(isset($success)) { ?>
            <div class="popup" style="display:block;">
                <?php echo $success; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <input type="text" name="name" placeholder="Pet Name" required>

            <input type="text" name="species" placeholder="Species (Dog/Cat,bird)" required>

            <input type="text" name="breed" placeholder="Breed" required>

            <input type="text" name="gender" placeholder="Gender (Male/Female)" required>

            <input type="number" name="age" placeholder="Age" required>
            <input type="text"  name="health_status" placeholder="health_status" required>

            <input type="number" name="shelter_id" placeholder="Shelter ID" required>

            <button name="submit">Add Pet</button>

        </form>

    </div>
</div>