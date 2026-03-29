<?php
session_start();
include "../db.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT 
    adoption.status,
    adoption.collection_date,

    pet.name,
    pet.breed,
    pet.age,

    shelter.name AS shelter_name,
    shelter.location

FROM adoption
JOIN pet ON adoption.pet_id = pet.pet_id
JOIN shelter ON pet.shelter_id = shelter.shelter_id
WHERE adoption.adopter_id = '$user_id'";

$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../style.css">

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">🐾 Pet Adoption</div>
    <div class="nav-links">
        <a href="dashboard.php">Home</a>
        <a href="search_pets.php">Search Pets</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<!-- HERO -->
<div class="hero">
    <h1>My Adoption Status</h1>
</div>

<!-- ✅ CARD CONTAINER -->
<div class="request-container">

<?php while($row = $result->fetch_assoc()) { ?>

    <!-- ✅ ONE CARD -->
    <div class="request-card">

        <h3>🐾 Pet Details</h3>
        <p><b>Name:</b> <?= $row['name']; ?></p>
        <p><b>Breed:</b> <?= $row['breed']; ?></p>
        <p><b>Age:</b> <?= $row['age']; ?></p>

        <hr>

        <h3>📍 Shelter</h3>
        <p><b>Name:</b> <?= $row['shelter_name']; ?></p>
        <p><b>Location:</b> <?= $row['location']; ?></p>

        <hr>

        <h3>📄 Status</h3>

        <p>
        <?php 
	if($row['status']=="Approved"){
    		echo "<span class='status approved'>Approved ✅</span>";
    		echo "<br><b>Collect Date:</b> ".$row['collection_date'];
	}
	elseif($row['status']=="Rejected"){
    		echo "<span class='status rejected'>Rejected ❌</span>";
    		echo "<br>Pet is out of stock";
	}
	else{
    		echo "<span class='status pending'>Pending ⏳</span>";
	}
	?>        
       </p>

    </div>

<?php } ?>

</div>