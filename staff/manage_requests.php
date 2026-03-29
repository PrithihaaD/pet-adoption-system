<?php
session_start();
include "../db.php";

$sql = "SELECT 
            adoption.adoption_id,
            adoption.status,
            adopter.name AS adopter_name,
            adopter.email,
            pet.name AS pet_name,
            pet.species,
            pet.breed,
            pet.age
        FROM adoption
        JOIN adopter ON adoption.adopter_id = adopter.adopter_id
        JOIN pet ON adoption.pet_id = pet.pet_id";

$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../style.css">

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">🐾 Staff Panel</div>
    <div class="nav-links">
        <a href="dashboard.php">Home</a>
        <a href="add_pet.php">Add Pet</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<!-- HERO -->
<div class="hero">
    <h1>Adoption Requests</h1>
</div>

<!-- ✅ IMPORTANT WRAPPER -->
<div class="request-container">

<?php while($row = $result->fetch_assoc()) { ?>

    <!-- ✅ ONE CARD -->
    <div class="request-card">

        <h3>👤 Adopter Details</h3>
        <p><b>Name:</b> <?= $row['adopter_name']; ?></p>
        <p><b>Email:</b> <?= $row['email']; ?></p>

        <hr>

        <h3>🐾 Pet Details</h3>
        <p><b>Name:</b> <?= $row['pet_name']; ?></p>
        <p><b>Species:</b> <?= $row['species']; ?></p>
        <p><b>Breed:</b> <?= $row['breed']; ?></p>
        <p><b>Age:</b> <?= $row['age']; ?></p>

        <hr>

        <h3>📄 Request Details</h3>
        <p><b>ID:</b> <?= $row['adoption_id']; ?></p>
        <p><b>Status:</b> <?= $row['status']; ?></p>

        <br>

        <div class="btn-group">
            <a href="update_status.php?id=<?= $row['adoption_id']; ?>&status=Approved">
                <button class="btn approve">Approve</button>
            </a>

            <a href="update_status.php?id=<?= $row['adoption_id']; ?>&status=Rejected">
                <button class="btn reject">Reject</button>
            </a>
        </div>

    </div>

<?php } ?>

</div>